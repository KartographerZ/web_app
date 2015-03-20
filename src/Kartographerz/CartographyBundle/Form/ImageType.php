<?php

namespace Kartographerz\CartographyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('path', "file" , array(
                'data_class' => null , "label" => false
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kartographerz\CartographyBundle\Entity\Image'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'kartographerz_cartographybundle_image';
    }

}
