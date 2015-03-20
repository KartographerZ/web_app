<?php

namespace Kartographerz\CartographyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElementType extends AbstractType {
    
    private $choiceType;
            
    function __construct($choicesType) {
        $this->choiceType = $choicesType;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', "text", array('required' => true))
                ->add("typeElement", "choice" , array("choices" => $this->choiceType))
                ->add('submit', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kartographerz\CartographyBundle\Entity\Element'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'kartographerz_cartographybundle_element';
    }

}
