<?php

namespace Application\View\Helper\Factory;

use Zend\Form\View\Helper\FormElementErrors;

class FormElementErrorsFactory
{
    public function __invoke()
    {
        $helper = new FormElementErrors();
        $helper->setMessageOpenFormat('<div class="alert alert-danger">');
        $helper->setMessageSeparatorString('</div>
        <div class="alert alert-danger">');
        $helper->setMessageCloseString('</div>');
        return $helper;
    }
}
