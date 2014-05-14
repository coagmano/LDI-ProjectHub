<?php

namespace LDI\ProjectHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(name="featureImageUrl", type="string")
     */
    private $featureImageUrl;

    /**
     * @var string
     * 
     * @ORM\Column(name="status", type="string", length=255)
     *
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
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="User", inversedBy="joinedProjects")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $collaborators;

    /**
     * @var User
     * 
     * @ORM\ManytoOne(targetEntity="User", inversedBy="createdProjects")
     */
    private $createdBy;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="project"))
     */
    private $blogPosts;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="discussionPost", mappedBy="project")
     */
    private $discussionPosts;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="project")
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    public function __construct()
    {
        $this->collaborators = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
        $this->discussionPosts = new ArrayCollection();
        $this->comments = new ArrayCollection();
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
     * Set featureImageUrl
     *
     * @param string $featureImageUrl
     * @return Project
     */
    public function setFeatureImageUrl($featureImageUrl)
    {
        $this->featureImageUrl = $featureImageUrl;

        return $this;
    }

    /**
     * Get featureImageUrl
     *
     * @return string 
     */
    public function getFeatureImageUrl()
    {
        return $this->featureImageUrl;
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

    /**
     * Set location
     *
     * @param string $location
     * @return Project
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add collaborators
     *
     * @param \LDI\ProjectHubBundle\Entity\User $collaborators
     * @return Project
     */
    public function addCollaborator(\LDI\ProjectHubBundle\Entity\User $collaborators)
    {
        $this->collaborators[] = $collaborators;

        return $this;
    }

    /**
     * Remove collaborators
     *
     * @param \LDI\ProjectHubBundle\Entity\User $collaborators
     */
    public function removeCollaborator(\LDI\ProjectHubBundle\Entity\User $collaborators)
    {
        $this->collaborators->removeElement($collaborators);
    }

    /**
     * Get collaborators
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCollaborators()
    {
        return $this->collaborators;
    }

    /**
     * Set createdBy
     *
     * @param \LDI\ProjectHubBundle\Entity\User $createdBy
     * @return Project
     */
    public function setCreatedBy(\LDI\ProjectHubBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \LDI\ProjectHubBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Add blogPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\BlogPost $blogPosts
     * @return Project
     */
    public function addBlogPost(\LDI\ProjectHubBundle\Entity\BlogPost $blogPosts)
    {
        $this->blogPosts[] = $blogPosts;

        return $this;
    }

    /**
     * Remove blogPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\BlogPost $blogPosts
     */
    public function removeBlogPost(\LDI\ProjectHubBundle\Entity\BlogPost $blogPosts)
    {
        $this->blogPosts->removeElement($blogPosts);
    }

    /**
     * Get blogPosts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlogPosts()
    {
        return $this->blogPosts;
    }

    /**
     * Add discussionPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\discussionPost $discussionPosts
     * @return Project
     */
    public function addDiscussionPost(\LDI\ProjectHubBundle\Entity\discussionPost $discussionPosts)
    {
        $this->discussionPosts[] = $discussionPosts;

        return $this;
    }

    /**
     * Remove discussionPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\discussionPost $discussionPosts
     */
    public function removeDiscussionPost(\LDI\ProjectHubBundle\Entity\discussionPost $discussionPosts)
    {
        $this->discussionPosts->removeElement($discussionPosts);
    }

    /**
     * Get discussionPosts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiscussionPosts()
    {
        return $this->discussionPosts;
    }

    /**
     * Add comments
     *
     * @param \LDI\ProjectHubBundle\Entity\Comment $comments
     * @return Project
     */
    public function addComment(\LDI\ProjectHubBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \LDI\ProjectHubBundle\Entity\Comment $comments
     */
    public function removeComment(\LDI\ProjectHubBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
