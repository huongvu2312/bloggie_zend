<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="\Application\Repository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="title")  
     */
    protected $title;

    /** 
     * @ORM\Column(name="description")  
     */
    protected $description;

    /** 
     * @ORM\Column(name="draft")  
     */
    protected $draft;

    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Comment", mappedBy="post")
     * @ORM\JoinColumn(name="id", referencedColumnName="post_id")
     */
    protected $comments;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * Returns ID of this post.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets ID of this post.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns title.
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets title.
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns post description.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets post description.
     * @param type $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns draft status.
     */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Sets draft status.
     * @param type $draft
     */
    public function setDraft($draft)
    {
        $this->draft = $draft;
    }

    /**
     * Returns the date when this post was created.
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets the date when this post was created.
     * @param string $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * Returns comments for this post.
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Adds a new comment to this post.
     * @param $comment
     */
    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }
}
