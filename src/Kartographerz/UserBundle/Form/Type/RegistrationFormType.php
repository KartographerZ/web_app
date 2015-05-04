<?php

namespace Kartographerz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // add your custom field
        $builder->add('name', null, array('label' => 'form.name', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('groups',  'entity', array('class' => 'KartographerzUserBundle:Group'));
        $builder->add('enterprise', 'entity', array(
            'class' => 'KartographerzCartographyBundle:Enterprise',
            'property' => 'name',
            'placeholder' => 'Choose an option',
            'label' => 'form.enterprise', 'translation_domain' => 'FOSUserBundle'
        ));
    }

    public function getParent() {
        return 'fos_user_registration';
    }

    public function getName() {
        return 'kartographerz_user_registration';
    }

}
