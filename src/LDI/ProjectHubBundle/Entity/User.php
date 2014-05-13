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
    private $profilePic;

    /**
     * @ORM\ManyToMany(targetEntity="Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="user"))
     */
    private $blogPosts;



    public function __construct()
    {
        $this->projects = new ArrayCollection();
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
     * Set username
     *
     * @param string $username
     * @return User
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Set profilePic
     *
     * @param string $profilePic
     * @return User
     */
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;

        return $this;
    }

    /**
     * Get profilePic
     *
     * @return string 
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }
}
