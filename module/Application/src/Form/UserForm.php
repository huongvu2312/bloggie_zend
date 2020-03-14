<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use User\Validator\UserExistsValidator;

class UserForm extends Form
{

    /**
     * Constructor.     
     */
    public function __construct($changePass)
    {
        // Define form name
        parent::__construct('user-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->changePass = $changePass;
        $this->addElements();
        $this->addInputFilter();
    }


    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {
        // Add "email" field
        $this->add([
            'type'  => 'email',
            'name' => 'email',
            'attributes' => [
                'id' => 'email'
            ],
            'options' => [
                'label' => 'Email',
            ],
        ]);

        // Add "old_password" field
        $this->add([
            'type'  => 'password',
            'name' => 'old_password',
            'attributes' => [
                'id' => 'old_password'
            ],
            'options' => [
                'label' => 'Old Password',
            ],
        ]);

        // Add "new_password" field
        $this->add([
            'type'  => 'password',
            'name' => 'new_password',
            'attributes' => [
                'id' => 'new_password'
            ],
            'options' => [
                'label' => 'New Password',
            ],
        ]);

        // Add "confirm_new_password" field
        $this->add([
            'type'  => 'password',
            'name' => 'confirm_new_password',
            'attributes' => [
                'id' => 'confirm_new_password'
            ],
            'options' => [
                'label' => 'Confirm new password',
            ],
        ]);

        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Change admin data'
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();

        // Add input for "email" field
        $inputFilter->add([
            'name'     => 'email',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 128
                    ],
                ],
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck'    => false,
                    ],
                ]
            ],
        ]);

        // Add input for "old_password" field
        $inputFilter->add([
            'name'     => 'old_password',
            'required' => true,
            'filters'  => [],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 6,
                        'max' => 64
                    ],
                ],
            ],
        ]);

        if ($this->changePass == true) {
            // Add input for "new_password" field
            $inputFilter->add([
                'name'     => 'new_password',
                'filters'  => [],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 6,
                            'max' => 64
                        ],
                    ],
                ],
            ]);

            // Add input for "confirm_new_password" field
            $inputFilter->add([
                'name'     => 'confirm_new_password',
                'filters'  => [],
                'validators' => [
                    [
                        'name'    => 'Identical',
                        'options' => [
                            'token' => 'new_password',
                        ],
                    ],
                ],
            ]);
        }
    }
}
