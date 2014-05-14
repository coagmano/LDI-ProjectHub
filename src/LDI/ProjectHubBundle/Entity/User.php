<?php

namespace LDI\ProjectHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LDI\ProjectHubBundle\Entity\UserRepository")
 */
class User
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
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     * AKA Bio
     *
     * @ORM\Column(name="blurb", type="text")
     */
    private $blurb;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var simple_array
     *
     * @ORM\Column(name="tags", type="simple_array")
     */
    private $tags;


    /**
     * @var string
     *
     * @ORM\Column(type="blob")
     */
    private $profilePicUrl;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="createdBy")
     */
    private $createdProjects;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="collaborators")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $joinedProjects;

    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="postedBy"))
     */
    private $blogPosts;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="postedBy"))
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="DiscussionPost", mappedBy="postedBy"))
     */
    private $discussionPosts;



    public function __construct()
    {
        $this->createdProjects = new ArrayCollection();
        $this->joinedProjects = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->discussionPosts = new ArrayCollection();
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
     * Set blurb
     *
     * @param string $blurb
     * @return User
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb;

        return $this;
    }

    /**
     * Get blurb
     *
     * @return string 
     */
    public function getBlurb()
    {
        return $this->blurb;
    }

    /**
     * Set tags
     *
     * @param array $tags
     * @return User
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
     * Set profilePicUrl
     *
     * @param string $profilePicUrl
     * @return User
     */
    public function setProfilePicUrl($profilePicUrl)
    {
        $this->profilePicUrl = $profilePicUrl;

        return $this;
    }

    /**
     * Get profilePicUrl
     *
     * @return string 
     */
    public function getProfilePicUrl()
    {
        return $this->profilePicUrl;
    }

    /**
     * Add createdProjects
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $createdProjects
     * @return User
     */
    public function addCreatedProject(\LDI\ProjectHubBundle\Entity\Project $createdProjects)
    {
        $this->createdProjects[] = $createdProjects;

        return $this;
    }

    /**
     * Remove createdProjects
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $createdProjects
     */
    public function removeCreatedProject(\LDI\ProjectHubBundle\Entity\Project $createdProjects)
    {
        $this->createdProjects->removeElement($createdProjects);
    }

    /**
     * Get createdProjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedProjects()
    {
        return $this->createdProjects;
    }

    /**
     * Add joinedProjects
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $joinedProjects
     * @return User
     */
    public function addJoinedProject(\LDI\ProjectHubBundle\Entity\Project $joinedProjects)
    {
        $this->joinedProjects[] = $joinedProjects;

        return $this;
    }

    /**
     * Remove joinedProjects
     *
     * @param \LDI\ProjectHubBundle\Entity\Project $joinedProjects
     */
    public function removeJoinedProject(\LDI\ProjectHubBundle\Entity\Project $joinedProjects)
    {
        $this->joinedProjects->removeElement($joinedProjects);
    }

    /**
     * Get joinedProjects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJoinedProjects()
    {
        return $this->joinedProjects;
    }

    /**
     * Add blogPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\BlogPost $blogPosts
     * @return User
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
     * Add comments
     *
     * @param \LDI\ProjectHubBundle\Entity\Comment $comments
     * @return User
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

    /**
     * Add discussionPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\DiscussionPost $discussionPosts
     * @return User
     */
    public function addDiscussionPost(\LDI\ProjectHubBundle\Entity\DiscussionPost $discussionPosts)
    {
        $this->discussionPosts[] = $discussionPosts;

        return $this;
    }

    /**
     * Remove discussionPosts
     *
     * @param \LDI\ProjectHubBundle\Entity\DiscussionPost $discussionPosts
     */
    public function removeDiscussionPost(\LDI\ProjectHubBundle\Entity\DiscussionPost $discussionPosts)
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
}
