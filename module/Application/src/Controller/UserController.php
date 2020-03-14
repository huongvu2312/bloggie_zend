<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;
use Application\Form\UserForm;

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

    /**
     * This "admin" action displays the Manage User page.
     * The admin can changed email and password used for login,
     * as long as they put the old password correctly.
     * The password had been encrypted.
     */
    public function adminAction()
    {
        // Use the CurrentUser controller plugin to get the current user.
        $user = $this->currentUser();
        $flashMessage = '';

        // Create user form
        if ($this->getRequest()->isPost()) {
            if (
                !empty($this->params()->fromPost()['new_password'])
                || !empty($this->params()->fromPost()['confirm_new_password'])
            ) {
                // Set $changePass = true when "new_password" or "confirm_new_password" input is not empty
                $form = new UserForm(true);
            }
        } else {
            // else set it = false
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
