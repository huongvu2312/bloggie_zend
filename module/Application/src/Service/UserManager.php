<?php

namespace Application\Service;

use Zend\Crypt\Password\Bcrypt;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class UserManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This method updates data of an existing user.
     */
    public function updateUser($user, $data)
    {
        $user->setEmail($data['email']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    /**
     * Checks that the given password is correct.
     */
    public function validatePassword($user, $password)
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }

        return false;
    }

    /**
     * This method is used to change the password for the admin.
     */
    public function changePassword($user, $data)
    {
        $newPassword = $data['new_password'];

        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);

        // Apply changes
        $this->entityManager->flush();

        return true;
    }
}
