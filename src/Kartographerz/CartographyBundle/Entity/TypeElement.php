<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeElement
 *
 * @ORM\Table(name="type_element")
 * @ORM\Entity
 */
class TypeElement {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var \image
     *
     * @ORM\OneToOne(targetEntity="Kartographerz\CartographyBundle\Entity\Image" ,  cascade={"persist"}))
     */
    private $image;
    
   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return TypeElement
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel() {
        return $this->label;
    }
    
    function getImage() {
        return $this->image;
    }

    function setImage(Image $image) {
        $this->image = $image;
    }



}
