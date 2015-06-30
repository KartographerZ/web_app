<?php

namespace Kartographerz\CartographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kartographerz\CartographyBundle\Entity\ImageRepository")
 */
class Image {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=1000)
     */
    private $path;

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
     * @return Image
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
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    public function getUploadDir() {
        return "Bundles/Cartography/TypeElementImages/";
    }

    public function getUploadName() {
        $char = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $rand = str_shuffle($char);
        $rand = substr($rand, 0, 10);
        return $rand . ".png";
    }

    public function upload() {
        $n = $this->getUploadName();
        $this->name = $n;
        $this->path->move($this->getUploadDir(), $n);
        $this->path = $this->getUploadDir() . $n;
    }

}
