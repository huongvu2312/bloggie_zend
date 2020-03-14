<?php

namespace Application\Service;

use Application\Entity\Post;
use Application\Entity\Comment;

/**
 * The PostManager service is responsible for adding new posts, updating existing
 * posts, adding tags to post, etc.
 */
class PostManager
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new post.
     */
    public function addNewPost($data)
    {
        // Create new Post entity.
        $post = new Post();
        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setDraft($data['draft']);
        $currentDate = date('Y-m-d H:i:s');
        $post->setDateCreated($currentDate);

        // Add the entity to entity manager.
        $this->entityManager->persist($post);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * This method allows to update data of a single post.
     */
    public function updatePost($post, $data)
    {
        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setDraft($data['draft']);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * Returns count of comments for given post as properly formatted string.
     */
    public function getCommentCountStr($post)
    {
        $commentCount = count($post->getComments());
        if ($commentCount == 0)
            return 'No comments';
        else if ($commentCount == 1)
            return '1 comment';
        else
            return $commentCount . ' comments';
    }


    /**
     * This method adds a new comment to post.
     */
    public function addCommentToPost($post, $data)
    {
        // Create new Comment entity.
        $comment = new Comment();
        $comment->setPost($post);
        $comment->setUser($data['user']);
        $comment->setContent($data['comment']);
        $currentDate = date('Y-m-d H:i:s');
        $comment->setDateCreated($currentDate);

        // Add the entity to entity manager.
        $this->entityManager->persist($comment);

        // Apply changes.
        $this->entityManager->flush();
    }

    /**
     * Removes post and all associated comments.
     */
    public function removePost($post)
    {
        // Remove associated comments
        $comments = $post->getComments();
        foreach ($comments as $comment) {
            $this->entityManager->remove($comment);
        }

        $this->entityManager->remove($post);

        $this->entityManager->flush();
    }
}
