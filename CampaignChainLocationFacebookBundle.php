<?php

namespace CampaignChain\Location\FacebookBundle;

use CampaignChain\Location\FacebookBundle\DependencyInjection\CampaignChainLocationFacebookExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CampaignChainLocationFacebookBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CampaignChainLocationFacebookExtension();
    }
}
