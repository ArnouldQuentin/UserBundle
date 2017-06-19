<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Play\CoreBundle\Model\CustomerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $yves = new User();
        $quentin = new User();
        $john = new User();
        $jane = new User();
        $darkPirate = new User();

        $yves->setFirstname('Yves');
        $yves->setLastname('Arnould');
        $yves->setUsername('yves.around');
        $yves->setBirthday(new \DateTime('1946-08-28'));
        $yves->setFacebookId('10155036883407068');
        $yves->setEmail('yves.arnould@hotmail.com');
        $yves->setEnabled(true);
        $yves->setGender(CustomerInterface::GENDER_MALE);
        $yves->setPlainPassword('1234');
        $yves->setSuperAdmin(true);

        $quentin->setFirstname('Quentin');
        $quentin->setLastname('Arnould');
        $quentin->setUsername('quentin.arnould');
        $quentin->setBirthday(new \DateTime('1990-01-20'));
        $quentin->setFacebookId(null);
        $quentin->setEmail('quentin.arnould@yahoo.fr');
        $quentin->setEnabled(true);
        $quentin->setGender(CustomerInterface::GENDER_MALE);
        $quentin->setPlainPassword('1234');
        $quentin->setSuperAdmin(true);

        $john->setFirstname('John');
        $john->setLastname('Doe');
        $john->setUsername('john.doe');
        $john->setBirthday(new \DateTime('2000-03-21'));
        $john->setEmail('john.doe@play-along.com');
        $john->setEnabled(true);
        $john->setGender(CustomerInterface::GENDER_MALE);
        $john->setPlainPassword('1234');
        $john->addRole('ROLE_USER');

        $jane->setFirstname('Jane');
        $jane->setLastname('Doe');
        $jane->setUsername('jane.doe');
        $jane->setBirthday(new \DateTime('1980-09-01'));
        $jane->setEmail('jane.doe@play-along.com');
        $jane->setEnabled(true);
        $jane->setGender(CustomerInterface::GENDER_FEMALE);
        $jane->setPlainPassword('1234');
        $jane->addRole('ROLE_ADMIN');

        $darkPirate->setFirstname('Pirate');
        $darkPirate->setLastname('Dark');
        $darkPirate->setUsername('dark.pirate');
        $darkPirate->setBirthday(new \DateTime('1960-09-01'));
        $darkPirate->setEmail('pirate.dark@play-along.com');
        $darkPirate->setEnabled(false);
        $darkPirate->setGender(CustomerInterface::GENDER_FEMALE);
        $darkPirate->setPlainPassword('1234');
        $darkPirate->addRole('ROLE_USER');

        $this->addReference('yves', $yves);
        $this->addReference('quentin', $quentin);
        $this->addReference('john', $john);
        $this->addReference('jane', $jane);
        $this->addReference('darkPirate', $darkPirate);

        $manager->persist($yves);
        $manager->persist($quentin);
        $manager->persist($john);
        $manager->persist($jane);
        $manager->persist($darkPirate);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}