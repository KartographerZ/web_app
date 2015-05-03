<?php

namespace Kartographerz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var \Enterprise
     *
     * @ORM\OneToOne(targetEntity="Kartographerz\CartographyBundle\Entity\Enterprise",  cascade={"persist"}))
     */
    private $enterprise;

    function __construct() {
        parent::__construct();
    }
    
    function getName() {
        return $this->name;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getEnterprise() {
        return $this->enterprise;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setEnterprise(\Enterprise $enterprise) {
        $this->enterprise = $enterprise;
    }



}