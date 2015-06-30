<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionElement
 *
 * @ORM\Table(name="version_element")
 * @ORM\Entity
 */
class VersionElement
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
     * @var \Version
     *
     * @ORM\ManyToOne(targetEntity="Version" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="version_id", referencedColumnName="id")
     * })
     */
    private $version;

    /**
     * @var \Element
     *
     * @ORM\ManyToOne(targetEntity="Element")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="element_id", referencedColumnName="id")
     * })
     */
    private $element;



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
     * Set version
     *
     * @param \Kartographerz\CartographyBundle\Entity\Version $version
     * @return VersionElement
     */
    public function setVersion(\Kartographerz\CartographyBundle\Entity\Version $version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \Kartographerz\CartographyBundle\Entity\Version 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set element
     *
     * @param \Kartographerz\CartographyBundle\Entity\Element $element
     * @return VersionElement
     */
    public function setElement(\Kartographerz\CartographyBundle\Entity\Element $element = null)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return \Kartographerz\CartographyBundle\Entity\Element 
     */
    public function getElement()
    {
        return $this->element;
    }
}
