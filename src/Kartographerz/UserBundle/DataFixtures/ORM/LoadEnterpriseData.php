<?php
// src/Kartographerz/UserBundle/DataFixtures/ORM/LoadEnterpriseData.php
namespace Kartographerz\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;

/**
 * Description of LoadEnterpriseData
 *
 * @author franckmazzolo
 */
class LoadEnterpriseData implements FixtureInterface {

    //put your code here
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $enterprise = new \Kartographerz\CartographyBundle\Entity\Enterprise('Air Liquide');
        $manager->persist($enterprise);
        $enterprise = new \Kartographerz\CartographyBundle\Entity\Enterprise('BNP Paribas');

        $manager->persist($enterprise);
        $manager->flush();
    }

}
