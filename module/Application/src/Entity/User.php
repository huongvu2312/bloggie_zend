<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="email")  
     */
    protected $email;

    /** 
     * @ORM\Column(name="password")  
     */
    protected $password;

    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns email.     
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets email.     
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns password.
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets password.     
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the date of user creation.
     * @return string     
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets the date when this user was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}
