<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartography
 *
 * @ORM\Table(name="cartography", indexes={@ORM\Index(name="typeVisibiliteId", columns={"type_visibility_id"})})
 * @ORM\Entity
 */
class Cartography
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \TypeVisibility
     *
     * @ORM\ManyToOne(targetEntity="TypeVisibility")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_visibility_id", referencedColumnName="id")
     * })
     */
    private $typeVisibility;



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
     * @return Cartography
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
     * Set date
     *
     * @param \DateTime $date
     * @return Cartography
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set typeVisibility
     *
     * @param \Kartographerz\CartographyBundle\Entity\TypeVisibility $typeVisibility
     * @return Cartography
     */
    public function setTypeVisibility(\Kartographerz\CartographyBundle\Entity\TypeVisibility $typeVisibility = null)
    {
        $this->typeVisibility = $typeVisibility;

        return $this;
    }

    /**
     * Get typeVisibility
     *
     * @return \Kartographerz\CartographyBundle\Entity\TypeVisibility 
     */
    public function getTypeVisibility()
    {
        return $this->typeVisibility;
    }
}
