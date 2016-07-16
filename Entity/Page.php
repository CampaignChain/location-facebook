<?php
/*
 * Copyright 2016 CampaignChain, Inc. <info@campaignchain.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace CampaignChain\Location\FacebookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Page extends LocationBase
{
    /**
     * @ORM\OneToMany(targetEntity="CampaignChain\Operation\FacebookBundle\Entity\PageStatus", mappedBy="page")
     */
    protected $pageStatuses;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="pages")
     * @ORM\JoinTable(name="campaignchain_location_facebook_user_page")
     **/
    protected $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * TODO: What is the max length defined by Facebook?
     */
    protected $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * TODO: What is the max length defined by Facebook?
     */
    protected $about;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $coverId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $coverSource;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $coverOffsetX;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $coverOffsetY;

    /**
     * @ORM\Column(type="string")
     */
    protected $link;

    /**
     * @ORM\Column(type="string")
     */
    protected $pictureUrl;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isPublished;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $canPost;

    /**
     * @ORM\Column(type="array")
     */
    protected $permissions;

    /**
     * Set name
     *
     * @param string $name
     * @return Page
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Page
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return Page
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set coverId
     *
     * @param string $coverId
     * @return Page
     */
    public function setCoverId($coverId)
    {
        $this->coverId = $coverId;

        return $this;
    }

    /**
     * Get coverId
     *
     * @return string 
     */
    public function getCoverId()
    {
        return $this->coverId;
    }

    /**
     * Set coverSource
     *
     * @param string $coverSource
     * @return Page
     */
    public function setCoverSource($coverSource)
    {
        $this->coverSource = $coverSource;

        return $this;
    }

    /**
     * Get coverSource
     *
     * @return string 
     */
    public function getCoverSource()
    {
        return $this->coverSource;
    }

    /**
     * Set coverOffsetX
     *
     * @param integer $coverOffsetX
     * @return Page
     */
    public function setCoverOffsetX($coverOffsetX)
    {
        $this->coverOffsetX = $coverOffsetX;

        return $this;
    }

    /**
     * Get coverOffsetX
     *
     * @return integer 
     */
    public function getCoverOffsetX()
    {
        return $this->coverOffsetX;
    }

    /**
     * Set coverOffsetY
     *
     * @param integer $coverOffsetY
     * @return Page
     */
    public function setCoverOffsetY($coverOffsetY)
    {
        $this->coverOffsetY = $coverOffsetY;

        return $this;
    }

    /**
     * Get coverOffsetY
     *
     * @return integer 
     */
    public function getCoverOffsetY()
    {
        return $this->coverOffsetY;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Page
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set pictureUrl
     *
     * @param string $pictureUrl
     * @return Page
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * Get pictureUrl
     *
     * @return string 
     */
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Page
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set canPost
     *
     * @param boolean $canPost
     * @return Page
     */
    public function setCanPost($canPost)
    {
        $this->canPost = $canPost;

        return $this;
    }

    /**
     * Get canPost
     *
     * @return boolean 
     */
    public function getCanPost()
    {
        return $this->canPost;
    }

    /**
     * Set permissions
     *
     * @param array $permissions
     * @return Page
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * Get permissions
     *
     * @return array 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \CampaignChain\Location\FacebookBundle\Entity\User $users
     * @return Page
     */
    public function addUser(\CampaignChain\Location\FacebookBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \CampaignChain\Location\FacebookBundle\Entity\User $users
     */
    public function removeUser(\CampaignChain\Location\FacebookBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
