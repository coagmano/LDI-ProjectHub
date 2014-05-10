<?php

namespace LDI\ProjectHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LDI\ProjectHubBundle\Entity\ProjectRepository")
 */
class Project
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="simple_array")
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="featureImage", type="blob")
     */
    private $featureImage;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdTimestamp", type="datetime")
     */
    private $createdTimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="videoUrl", type="string", length=255)
     */
    private $videoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="fileShareUrl", type="string", length=255)
     */
    private $fileShareUrl;


    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="project"))
     */
    private $blogPosts;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Project
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
     * Set tags
     *
     * @param array $tags
     * @return Project
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set featureImage
     *
     * @param string $featureImage
     * @return Project
     */
    public function setFeatureImage($featureImage)
    {
        $this->featureImage = $featureImage;

        return $this;
    }

    /**
     * Get featureImage
     *
     * @return string 
     */
    public function getFeatureImage()
    {
        return $this->featureImage;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Project
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime 
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }

    /**
     * Set videoUrl
     *
     * @param string $videoUrl
     * @return Project
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * Get videoUrl
     *
     * @return string 
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * Set fileShareUrl
     *
     * @param string $fileShareUrl
     * @return Project
     */
    public function setFileShareUrl($fileShareUrl)
    {
        $this->fileShareUrl = $fileShareUrl;

        return $this;
    }

    /**
     * Get fileShareUrl
     *
     * @return string 
     */
    public function getFileShareUrl()
    {
        return $this->fileShareUrl;
    }
}
