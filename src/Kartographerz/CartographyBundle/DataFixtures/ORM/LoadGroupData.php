<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadUserGroup
 *
 * @author franckmazzolo
 */
class LoadVersionData extends \Doctrine\Common\DataFixtures\AbstractFixture implements \Doctrine\Common\DataFixtures\FixtureInterface, \Doctrine\Common\DataFixtures\OrderedFixtureInterface {

    public function load(\Doctrine\Common\Persistence\ObjectManager $manager) {
        $adminsGroup = new Kartographerz\CartographyBundle\Entity\Version('administration');
        $adminsGroup->addRole('ROLE_ADMIN');
        $manager->persist($adminsGroup);

        $manager->flush();

        $this->addReference('admin-group', $adminsGroup);
    }

    public function getOrder() {
        return 1;
    }

//put your code here
}
