<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Application\Entity\Post;
use Application\Entity\User;
use Application\Form\UserForm;
use Application\Form\PasswordChangeForm;
use Application\Form\PasswordResetForm;

/**
 * This controller is responsible for user management (adding, editing, 
 * viewing users and changing user's password).
 */
class UserController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * User manager.
     * @var User\Service\UserManager 
     */
    private $userManager;

    /**
     * Constructor. 
     */
    public function __construct($entityManager, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }

    public function adminAction()
    {
        $user = $this->entityManager->getRepository(User::class)
            ->find(1);
        $flashMessage = '';

        // Create user form
        if ($this->getRequest()->isPost() && !empty($this->params()->fromPost()['new_password'])) {
            $form = new UserForm(true);
        } else {
            $form = new UserForm(false);
        }

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {
            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid()) {

                // Get filtered and validated data
                $data = $form->getData();

                // Check if old password is correct
                if (!$this->userManager->validatePassword($user, $data['old_password'])) {
                    $flashMessage = '<div class="alert alert-warning">';
                    $flashMessage .= 'Sorry, your current password is incorrect.';
                    $flashMessage .= '</div>';
                } else {
                    // If new password is updated, set new password
                    if (!empty($data['new_password'])) {
                        $this->userManager->changePassword($user, $data);
                    }

                    // Update the user.
                    $this->userManager->updateUser($user, $data);
                    $flashMessage = '<div class="alert alert-success">';
                    $flashMessage .= 'Your data had been updated!';
                    $flashMessage .= '</div>';
                }
            }
        } else {
            $form->setData(array(
                'email' => $user->getEmail(),
            ));
        }

        return new ViewModel(array(
            'user' => $user,
            'form' => $form,
            'flashMessage' => $flashMessage
        ));
    }
}
