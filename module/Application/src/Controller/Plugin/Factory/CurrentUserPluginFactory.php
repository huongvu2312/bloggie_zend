<?php

namespace Application\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\Plugin\CurrentUserPlugin;

class CurrentUserPluginFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);

        return new CurrentUserPlugin($entityManager, $authService);
    }
}
