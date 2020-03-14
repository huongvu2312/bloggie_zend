<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Application\Entity\Post;
use Zend\Form\Element;

/**
 * This form is used to collect post data.
 */
class PostForm extends Form
{
    /**
     * Constructor.     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('post-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {

        // Add "title" field
        $this->add([
            'type'  => 'text',
            'name' => 'title',
            'attributes' => [
                'id' => 'title'
            ],
            'options' => [
                'label' => 'Title',
            ],
        ]);

        // Add "description" field
        $this->add([
            'type'  => 'textarea',
            'name' => 'description',
            'attributes' => [
                'id' => 'description'
            ],
            'options' => [
                'label' => 'Description',
            ],
        ]);

        // Add "draft" field
        $this->add([
            'type'  => 'checkbox',
            'name' => 'draft',
            'attributes' => [
                'id' => 'draft',
            ],
            'options' => [
                'label' => 'Draft',
                'checked_value' => 1,
                'unchecked_value' => 0
            ],
        ]);

        // Add the submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'id' => 'submitbutton',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'title',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 1024
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'     => 'description',
            'required' => true,
            'filters'  => [
                ['name' => 'StripTags'],
            ],
            'validators' => [[
                'name'    => 'StringLength',
                'options' => [
                    'min' => 1,
                    'max' => 4096
                ],
            ],],
        ]);
    }
}
