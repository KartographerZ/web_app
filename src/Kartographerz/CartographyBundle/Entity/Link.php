<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Link
 *
 * @ORM\Table(name="link", indexes={@ORM\Index(name="element_1_id", columns={"element_1_id"}), @ORM\Index(name="element_2_id", columns={"element_2_id"})})
 * @ORM\Entity
 */
class Link {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Element
     *
     * @ORM\ManyToOne(targetEntity="Element")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="element_1_id", referencedColumnName="id")
     * })
     */
    
    /**

   * @ORM\ManyToOne(targetEntity="Kartographerz\CartographyBundle\Entity\VersionElement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="element_1_id", referencedColumnName="id")
     * })
   */
    private $element1;

   /**
   * @ORM\ManyToOne(targetEntity="Kartographerz\CartographyBundle\Entity\VersionElement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="element_2_id", referencedColumnName="id")
     * })
   */
    private $element2;

    /**
     * @var \Version
     *
     * @ORM\ManyToOne(targetEntity="Version")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="version_id", referencedColumnName="id")
     * })
     */
    private $versionCartography;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set element1
     *
     * @param \Kartographerz\CartographyBundle\Entity\Element $element1
     * @return Link
     */
    public function setElement1(\Kartographerz\CartographyBundle\Entity\Element $element1 = null) {
        $this->element1 = $element1;

        return $this;
    }

    /**
     * Get element1
     *
     * @return \Kartographerz\CartographyBundle\Entity\Element 
     */
    public function getElement1() {
        return $this->element1;
    }

    /**
     * Set element2
     *
     * @param \Kartographerz\CartographyBundle\Entity\Element $element2
     * @return Link
     */
    public function setElement2(\Kartographerz\CartographyBundle\Entity\Element $element2 = null) {
        $this->element2 = $element2;

        return $this;
    }

    /**
     * Get element2
     *
     * @return \Kartographerz\CartographyBundle\Entity\Element 
     */
    public function getElement2() {
        return $this->element2;
    }

    function getVersionCartography() {
        return $this->versionCartography;
    }

    function setVersionCartography(\Version $versionCartography = null) {
        $this->versionCartography = $versionCartography;
    }

}
