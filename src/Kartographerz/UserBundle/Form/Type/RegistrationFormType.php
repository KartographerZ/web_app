<?php

namespace Kartographerz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // add your custom field
        $builder->add('name');
        $builder->add('firstname');
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'kartographerz_user_registration';
    }

}
