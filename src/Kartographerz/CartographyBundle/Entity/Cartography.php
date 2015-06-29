<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartography
 *
 * @ORM\Table(name="cartography")
 * @ORM\Entity
 */
class Cartography {

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
     *
     * @ORM\Column(name="typeVisibility", type="string", length=255, nullable=false)
     * 
     */
    private $typeVisibility;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Kartographerz\UserBundle\Entity\User",  cascade={"persist"})
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     * 
     */
    private $author;

    function __construct() {
        $this->date = new \DateTime;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Cartography
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Cartography
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Get name
     *
     * @return string 
     */
    function getTypeVisibility() {
        return $this->typeVisibility;
    }

    function setTypeVisibility($typeVisibility) {
        $this->typeVisibility = $typeVisibility;
    }

    function getAuthor() {
        return $this->author;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

}
