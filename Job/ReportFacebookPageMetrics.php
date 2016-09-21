<?php
/**
 * This file is part of the CampaignChain package.
 *
 * (c) CampaignChain, Inc. <info@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\FacebookBundle\Job;

use CampaignChain\Channel\FacebookBundle\REST\FacebookClient;
use CampaignChain\CoreBundle\Entity\SchedulerReportLocation;
use CampaignChain\CoreBundle\EntityService\FactService;
use CampaignChain\CoreBundle\Job\JobReportInterface;
use CampaignChain\Location\FacebookBundle\Entity\LocationBase;
use CampaignChain\Location\FacebookBundle\Entity\Page;
use Doctrine\ORM\EntityManager;
use CampaignChain\CoreBundle\Exception\ExternalApiException;

class ReportFacebookPageMetrics implements JobReportInterface
{
    const BUNDLE_NAME = 'campaignchain/location-facebook';
    const METRIC_LIKES = 'Likes';
    const METRIC_FANS = 'Fans';
    const METRIC_FRIENDS = 'Friends';

    protected $em;
    protected $container;

    protected $message;

    public function __construct(EntityManager $em, $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function schedule($location, $facts = null)
    {
        $scheduler = new SchedulerReportLocation();
        $scheduler->setLocation($location);
        $scheduler->setInterval('1 hour');
        $this->em->persist($scheduler);

        $facts[self::METRIC_LIKES] = 0;

        $factService = $this->container->get('campaignchain.core.fact');
        $factService->addLocationFacts(self::BUNDLE_NAME, $location, $facts);
    }

    public function execute($locationId)
    {
        /** @var LocationBase $facebookLocation */
        $facebookLocation = $this->em->getRepository('CampaignChainLocationFacebookBundle:LocationBase')
            ->findOneByLocation($locationId);

        /** @var FacebookClient $client */
        $client = $this->container->get('campaignchain.channel.facebook.rest.client');
        $connection = $client->connectByLocation($facebookLocation->getLocation());

        if ($connection) {
            $facts = array();
            $this->message = 'Added to report:';
            $baseUri = '/'.$facebookLocation->getIdentifier();
            try {
                if ($facebookLocation instanceof Page) {
                    // Collect stats for Facebook Page Location.
                    $response = $connection->api($baseUri, 'GET');
                    $facts[self::METRIC_FANS] = $response['likes'];
                    $this->message .= ' '.self::METRIC_FANS.' = '.$facts[self::METRIC_FANS];
                } else {
                    // Collect stats for Facebook User Location.
                    $params = [
                        'summary' => 'true',
                    ];
                    $response = $connection->api($baseUri . '/friends', 'GET', $params);
                    $facts[self::METRIC_FRIENDS] = $response['summary']['total_count'];
                    $this->message .= ' '.self::METRIC_FRIENDS.' = '.$facts[self::METRIC_FRIENDS];
                }

                $connection->destroySession();
            } catch (\Exception $e) {
                throw new ExternalApiException($e->getMessage(), $e->getCode(), $e);
            }
        } else {
            return self::STATUS_ERROR;
        }

        if(count($facts)) {
            /** @var FactService $factService */
            $factService = $this->container->get('campaignchain.core.fact');
            $factService->addLocationFacts(self::BUNDLE_NAME, $facebookLocation->getLocation(), $facts);
        }

        return self::STATUS_OK;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
