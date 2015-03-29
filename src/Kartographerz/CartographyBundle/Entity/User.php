<?php

namespace Kartographerz\CartographyBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="enterprise_id", columns={"enterprise_id"}) })
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
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    protected $login;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    protected $firstname;

    /**
     * @var \Enterprise
     *
     * @ORM\OneToOne(targetEntity="KartographerZ\CartographyBundle\Entity\Enterprise",  cascade={"persist"}))
     */
    protected $enterprise;

    /**
     * @var string
     *
     * @ORM\Column(name="typeUser", type="string", length=255, nullable=false)
     */
    protected $typeUser;

    function __construct($login, $password, $name, $firstname, $mail, $enterprise, $typeUser) {
        parent::__construct();
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->mail = $mail;
        $this->enterprise = $enterprise;
        $this->typeUser = $typeUser;
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
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail) {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail() {
        return $this->mail;
    }

    function getEnterprise() {
        return $this->enterprise;
    }

    function setEnterprise(\Enterprise $enterprise) {
        $this->enterprise = $enterprise;
    }

    function getTypeUser() {
        return $this->typeUser;
    }

    function setTypeUser($typeUser) {
        $this->typeUser = $typeUser;
    }

}
