<?php

namespace LDI\ProjectHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * discussionPost
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LDI\ProjectHubBundle\Entity\discussionPostRepository")
 */
class DiscussionPost
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="discussionPosts")
     */
    private $postedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postedTimestamp", type="datetime")
     */
    private $postedTimestamp;

    /**
     * @var Project
     * 
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="discussionPosts")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

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
     * Set message
     *
     * @param string $message
     * @return DiscussionPost
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set postedTimestamp
     *
     * @param \DateTime $postedTimestamp
     * @return DiscussionPost
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
     * Set postedBy
     *
     * @param \LDI\ProjectHubBundle\Entity\User $postedBy
     * @return DiscussionPost
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

    /**
     * Set project
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $project
     * @return DiscussionPost
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
}
