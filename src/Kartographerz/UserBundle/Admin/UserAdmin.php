<?php

namespace Kartographerz\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin {

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('name', 'text', array('label' => 'Name'))
                ->add('firstname')
                ->add('email')
                ->add('password')
                ->add('username')
                ->add('groups', "entity", array('class' => "KartographerzUserBundle:Group"))
                ->add('enterprise')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('name')
                ->add('enterprise')
                ->add('groups')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('email')
                ->addIdentifier('name')
                ->addIdentifier('firstname')
                ->addIdentifier('enterprise')
                ->addIdentifier('groups')
        ;
    }

}
