<?php

namespace Application\Service;

use Application\Entity\Post;

/**
 * The AuthManager service is responsible for user's login/logout and simple access 
 * filtering. The access filtering feature checks whether the current visitor 
 * is allowed to see the given page or not.  
 */
class AuthManager
{
    /**
     * Authentication service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    /**
     * Session manager.
     * @var Zend\Session\SessionManager
     */
    private $sessionManager;

    /**
     * Contents of the 'access_filter' config key.
     * @var array 
     */
    private $config;

    /**
     * Constructs the service.
     */
    public function __construct($authService, $sessionManager, $config, $entityManager)
    {
        $this->authService = $authService;
        $this->sessionManager = $sessionManager;
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    /**
     * Performs a login attempt.
     */
    public function login($email, $password)
    {
        // Authenticate with login/password.
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setEmail($email);
        $authAdapter->setPassword($password);
        $result = $this->authService->authenticate();
        return $result;
    }

    /**
     * Performs user logout.
     */
    public function logout()
    {
        // Allow to log out only when user is logged in.
        if ($this->authService->getIdentity() == null) {
            throw new \Exception('The user is not logged in');
        }

        // Remove identity from session.
        $this->authService->clearIdentity();
    }

    /**
     * This is a simple access control filter. It is able to restrict unauthorized
     * users to visit certain pages.
     * 
     * This method uses the 'access_filter' key in the config file and determines
     * whenther the current visitor is allowed to access the given controller action
     * or not. It returns true if allowed; otherwise false.
     */
    public function filterAccess($controllerName, $actionName, $idName)
    {
        // Determine mode - 'restrictive' (default) or 'permissive'. In restrictive
        // mode all controller actions must be explicitly listed under the 'access_filter'
        // config key, and access is denied to any not listed action for unauthorized users. 
        // In permissive mode, if an action is not listed under the 'access_filter' key, 
        // access to it is permitted to anyone (even for not logged in users.
        // Restrictive mode is more secure and recommended to use.

        // Get id from posts which haven't been published
        $draftIdList = [];
        $drafts = $this->entityManager->getRepository(Post::class)
            ->findBy(['draft' => 1], ['id' => 'DESC']);
        foreach ($drafts as $draft) {
            array_push($draftIdList, $draft->getId());
        }

        $mode = isset($this->config['options']['mode']) ? $this->config['options']['mode'] : 'restrictive';
        if ($mode != 'restrictive' && $mode != 'permissive')
            throw new \Exception('Invalid access filter mode (expected either restrictive or permissive mode');

        if (isset($this->config['controllers'][$controllerName])) {
            $items = $this->config['controllers'][$controllerName];
            foreach ($items as $item) {
                $actionList = $item['actions'];
                $allow = $item['allow'];

                // Set restricted mode if page contained draft post
                if (is_array($draftIdList) && in_array($idName, $draftIdList)) {
                    $allow = '@';
                }

                if (
                    is_array($actionList) && in_array($actionName, $actionList) ||
                    $actionList == '*'
                ) {
                    if ($allow == '*') {
                        return true; // Anyone is allowed to see the page.
                    } else if ($allow == '@' && $this->authService->hasIdentity()) {
                        return true; // Only authenticated user is allowed to see the page.
                    } else {
                        return false; // Access denied.
                    }
                }
            }
        }

        // In restrictive mode, access is forbid for unauthorized users to any 
        // action not listed under 'access_filter' key (for security reasons).
        if ($mode == 'restrictive' && !$this->authService->hasIdentity())
            return false;

        // Permit access to this page.
        return true;
    }
}
