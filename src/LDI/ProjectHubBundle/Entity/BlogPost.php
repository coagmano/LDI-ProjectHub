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
     * @ORM\Column(name="datePosted", type="datetime")
     */
    private $datePosted;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="blogPosts")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $projects;


    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="blogPosts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $createdBy;

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
     * Set datePosted
     *
     * @param \DateTime $datePosted
     * @return BlogPost
     */
    public function setDatePosted($datePosted)
    {
        $this->datePosted = $datePosted;

        return $this;
    }

    /**
     * Get datePosted
     *
     * @return \DateTime 
     */
    public function getDatePosted()
    {
        return $this->datePosted;
    }
}
