<?php

namespace Kartographerz\CartographyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CartographyType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', "text", array('required' => true))
                ->add("typeVisibility", "choice", array("choices" =>
                    array(\Kartographerz\CartographyBundle\Entity\TypeVisibility::publicUsers =>
                        \Kartographerz\CartographyBundle\Entity\TypeVisibility::publicUsers,
                        \Kartographerz\CartographyBundle\Entity\TypeVisibility::privateUsers => \Kartographerz\CartographyBundle\Entity\TypeVisibility::privateUsers
            )))
                ->add('submit', 'submit')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kartographerz\CartographyBundle\Entity\Cartography'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'kartographerz_cartographybundle_cartography';
    }

}
