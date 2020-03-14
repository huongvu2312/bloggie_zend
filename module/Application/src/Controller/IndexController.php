<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Application\Entity\Post;

class IndexController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    /**
     * Post manager.
     * @var Application\Service\PostManager 
     */
    private $postManager;

    /**
     * Constructor
     */
    public function __construct($entityManager, $postManager)
    {
        $this->entityManager = $entityManager;
        $this->postManager = $postManager;
    }

    /**
     * Homepage
     */
    public function indexAction()
    {
        $page = $this->params()->fromQuery('page', 1);

        // Get recent posts
        $query = $this->entityManager->getRepository(Post::class)
            ->findPosts();

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);

        // Render the view template.
        return new ViewModel([
            'posts' => $paginator,
            'postManager' => $this->postManager,
        ]);
    }
}
