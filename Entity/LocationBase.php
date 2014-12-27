<?php
/*
 * This file is part of the CampaignChain package.
 *
 * (c) Sandro Groganz <sandro@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\FacebookBundle\Entity;

use CampaignChain\Operation\FacebookBundle\Entity\StatusBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="campaignchain_location_facebook")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap( { "user" = "User", "page" = "Page" } )
 */
abstract class LocationBase
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="CampaignChain\CoreBundle\Entity\Location", cascade={"persist"})
     */
    protected $location;

    /**
     * @ORM\OneToMany(targetEntity="CampaignChain\Operation\FacebookBundle\Entity\StatusBase", mappedBy="facebookLocation")
     */
    protected $statuses;

    /**
     * @ORM\ManyToMany(targetEntity="Page", mappedBy="users")
     **/
    protected $pages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="text", nullable=true)
     * TODO: What is the max length defined by Facebook?
     */
    protected $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->statuses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return LocationBase
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return LocationBase
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return LocationBase
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Status $status
     * @return $this
     */
    public function addStatus(StatusBase $status)
    {
        $this->statuses[] = $status;

        return $this;
    }

    /**
     * @param Status $status
     */
    public function removeStatus(StatusBase $status)
    {
        $this->statuses->removeElement($status);
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
}
