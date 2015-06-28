<?php

namespace Kartographerz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->buildUserForm($builder, $options);

        $builder->add('current_password', 'password', array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword(),
        ));
    }

    public function buildUserForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('name', null, array('label' => 'form.name', 'translation_domain' => 'FOSUserBundle'))
                ->add('firstname', null, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'))
                ->add('enterprise', null, array('label' => 'form.enterprise', 'translation_domain' => 'FOSUserBundle'));
    }

    public function getParent() {
        return 'fos_user_profile';
    }

    public function getName() {
        return 'kartographerz_user_profile';
    }

}
