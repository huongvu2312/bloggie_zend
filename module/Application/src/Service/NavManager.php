<?php

namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;

    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;

    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper)
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
    }

    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems()
    {
        $url = $this->urlHelper;
        $items = [];
        $items[] = [
            'side' => 'left',
            [
                'id' => 'home',
                'label' => 'Home',
                'link' => $url('home')
            ]
        ];

        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        if (!$this->authService->hasIdentity()) {
            // no user
            $items[] = [
                'side' => 'right',
                [
                    'id' => 'login',
                    'label' => 'Login',
                    'link' => $url('login'),
                ]
            ];
        } else {
            // admin
            $items[] = [
                'side' => 'right',
                [
                    'id' => 'logout',
                    'label' => 'Logout',
                    'link' => $url('logout'),
                ]
            ];
            $items[0][] = [
                'id' => 'admin',
                'label' => 'Admin',
                'dropdown' => [
                    [
                        'id' => 'postManagement',
                        'label' => 'Manage post',
                        'link' => $url('posts', ['action' => 'admin'])
                    ],
                    [
                        'id' => 'userManagement',
                        'label' => 'Manage user',
                        'link' => $url('user', ['action' => 'admin'])
                    ],
                ]
            ];
        }

        return $items;
    }
}
