<?php

namespace Kartographerz\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Kartographerz\UserBundle\Entity\Group;

/**
 * Description of LoadUserGroup
 *
 * @author franckmazzolo
 */
class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $adminsGroup = new Group('administration');
        $adminsGroup->addRole('ROLE_ADMIN');

        $modelisateurGroup = new Group('modelisateur');
        $modelisateurGroup->addRole('ROLE_MODELISATEUR');

        $manager->persist($adminsGroup);
        $manager->persist($modelisateurGroup);
        $manager->flush();

        $this->addReference('admin-group', $adminsGroup);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 1;
    }

}
