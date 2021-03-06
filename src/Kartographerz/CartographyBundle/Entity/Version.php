<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 *
 * @ORM\Table(name="version")
 * @ORM\Entity
 */
class Version {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="current_id", type="integer", nullable=false)
     */
    private $currentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Cartography
     *
     * @ORM\ManyToOne(targetEntity="Cartography" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cartography_id", referencedColumnName="id")
     * })
     */
    private $cartography;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Version
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
     * Set cartography
     *
     * @param \Kartographerz\CartographyBundle\Entity\Cartography $cartography
     * @return Version
     */
    public function setCartography(\Kartographerz\CartographyBundle\Entity\Cartography $cartography = null) {
        $this->cartography = $cartography;

        return $this;
    }

    /**
     * Get cartography
     *
     * @return \Kartographerz\CartographyBundle\Entity\Cartography 
     */
    public function getCartography() {
        return $this->cartography;
    }

    /**
     * Set currentId
     *
     * @param integer $currentId
     *
     * @return Version
     */
    public function setCurrentId($currentId) {
        $this->currentId = $currentId;

        return $this;
    }

    /**
     * Get currentId
     *
     * @return integer
     */
    public function getCurrentId() {
        return $this->currentId;
    }

}
