<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Right
 *
 * @ORM\Table(name="right", indexes={@ORM\Index(name="type_right_id", columns={"type_right_id"}), @ORM\Index(name="cartography_id", columns={"cartography_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Right
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
     * @var \TypeRight
     *
     * @ORM\ManyToOne(targetEntity="TypeRight")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_right_id", referencedColumnName="id")
     * })
     */
    private $typeRight;

    /**
     * @var \Cartography
     *
     * @ORM\ManyToOne(targetEntity="Cartography")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cartography_id", referencedColumnName="id")
     * })
     */
    private $cartography;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set typeRight
     *
     * @param \Kartographerz\CartographyBundle\Entity\TypeRight $typeRight
     * @return Right
     */
    public function setTypeRight(\Kartographerz\CartographyBundle\Entity\TypeRight $typeRight = null)
    {
        $this->typeRight = $typeRight;

        return $this;
    }

    /**
     * Get typeRight
     *
     * @return \Kartographerz\CartographyBundle\Entity\TypeRight 
     */
    public function getTypeRight()
    {
        return $this->typeRight;
    }

    /**
     * Set cartography
     *
     * @param \Kartographerz\CartographyBundle\Entity\Cartography $cartography
     * @return Right
     */
    public function setCartography(\Kartographerz\CartographyBundle\Entity\Cartography $cartography = null)
    {
        $this->cartography = $cartography;

        return $this;
    }

    /**
     * Get cartography
     *
     * @return \Kartographerz\CartographyBundle\Entity\Cartography 
     */
    public function getCartography()
    {
        return $this->cartography;
    }

    /**
     * Set user
     *
     * @param \Kartographerz\CartographyBundle\Entity\User $user
     * @return Right
     */
    public function setUser(\Kartographerz\CartographyBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Kartographerz\CartographyBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
