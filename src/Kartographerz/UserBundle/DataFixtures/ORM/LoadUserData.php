<?php

namespace Kartographerz\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Description of LoadUserData
 *
 * @author franckmazzolo
 */
class LoadUserData extends \Doctrine\Common\DataFixtures\AbstractFixture implements OrderedFixtureInterface, FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user = $userManager->createUser();

        $user->setUsername('admin');
        $user->setEmail('email@domain.com');
        $user->setName('admin');
        $user->setFirstname('admin');
        $user->setEnabled(true);

        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user)
        ;
        $user->setPassword($encoder->encodePassword('admin', $user->getSalt()));

        $adminGroup = $this->getReference('admin-group');
        $user->setGroups($adminGroup);

        // Update the user
        $userManager->updateUser($user, true);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2;
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

}
