<?php

namespace Kartographerz\CartographyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Kartographerz\CartographyBundle\Entity\Image;

class TypeElementType extends AbstractType {

    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('label', "text", array('required' => true))
                ->add("image", new ImageType())
                ->add('submit', 'submit')

        ;
    }
    
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kartographerz\CartographyBundle\Entity\TypeElement'
        ));
    }
    
     /**
     * @return string
     */
    public function getName() {
        return 'kartographerz_cartographybundle_typeElement';
    }
    
}





    
   


