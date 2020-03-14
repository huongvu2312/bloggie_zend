<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Post;

/**
 * Method to manipulate entity Post
 */
class PostRepository extends EntityRepository
{
    /**
     * Retrieves all posts in descending date order.
     * @return Query
     */
    public function findPosts()
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('p')
            ->from(Post::class, 'p')
            ->orderBy('p.dateCreated', 'DESC');

        return $queryBuilder->getQuery();
    }
}
