<?php

namespace LDI\ProjectHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPost
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LDI\ProjectHubBundle\Entity\BlogPostRepository")
 */
class BlogPost
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postedTimestamp", type="datetime")
     */
    private $postedTimestamp;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="blogPosts")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="blogPosts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $postedBy;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->projects = new ArrayCollection();
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
     * @return BlogPost
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
     * Set content
     *
     * @param string $content
     * @return BlogPost
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set postedTimestamp
     *
     * @param \DateTime $postedTimestamp
     * @return BlogPost
     */
    public function setPostedTimestamp($postedTimestamp)
    {
        $this->postedTimestamp = $postedTimestamp;

        return $this;
    }

    /**
     * Get postedTimestamp
     *
     * @return \DateTime 
     */
    public function getPostedTimestamp()
    {
        return $this->postedTimestamp;
    }

    /**
     * Set project
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $project
     * @return BlogPost
     */
    public function setProject(\LDI\ProjectHubBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \LDI\ProjectHubBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set postedBy
     *
     * @param \LDI\ProjectHubBundle\Entity\User $postedBy
     * @return BlogPost
     */
    public function setPostedBy(\LDI\ProjectHubBundle\Entity\User $postedBy = null)
    {
        $this->postedBy = $postedBy;

        return $this;
    }

    /**
     * Get postedBy
     *
     * @return \LDI\ProjectHubBundle\Entity\User 
     */
    public function getPostedBy()
    {
        return $this->postedBy;
    }
}
