<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Element
 *
 * @ORM\Table(name="element", indexes={@ORM\Index(name="type_element_id", columns={"type_element_id"})})
 * @ORM\Entity
 */
class Element
{
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \TypeElement
     *
     * @ORM\ManyToOne(targetEntity="TypeElement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_element_id", referencedColumnName="id")
     * })
     */
    private $typeElement;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Element
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set typeElement
     *
     * @param \Kartographerz\CartographyBundle\Entity\TypeElement $typeElement
     * @return Element
     */
    public function setTypeElement(\Kartographerz\CartographyBundle\Entity\TypeElement $typeElement = null)
    {
        $this->typeElement = $typeElement;

        return $this;
    }

    /**
     * Get typeElement
     *
     * @return \Kartographerz\CartographyBundle\Entity\TypeElement 
     */
    public function getTypeElement()
    {
        return $this->typeElement;
    }
}