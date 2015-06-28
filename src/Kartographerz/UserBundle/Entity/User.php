<?php

namespace Kartographerz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\GroupInterface;

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
     * @var string
     *
     * @ORM\Column(name="enterprise", type="string", length=255, nullable=true)
     */
    private $enterprise;

    /**
     * @ORM\ManyToMany(targetEntity="Kartographerz\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

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

    function setEnterprise($enterprise) {
        $this->enterprise = $enterprise;
    }

    function getGroups() {
        return $this->groups;
    }

    function setGroups($groups) {
        $groups2 = new ArrayCollection();
        $groups2.add();
        $this->groups = $groups2;
    }

    public function addGroup(GroupInterface $groups) {
        parent::addGroup($groups);
        $this->groups[] = $groups;

        return $this;
    }

    public function removeGroup(GroupInterface $groups) {
        $this->groups->removeElement($groups);
    }

    function __construct() {
        parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
