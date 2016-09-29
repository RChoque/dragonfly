<?php

namespace Dragonfly\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Retrieve one random item of given class from ORM repository.
     *
     * @param string $class The class name to retrieve items from
     * @return object
     */
    private function _getRandomDoctrineItem($class)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $counter = (int) $em->createQuery(
            'SELECT COUNT(c) FROM '. $class .' c'
        )->getSingleScalarResult();
        if ($counter === 0) {
            return null;
        }
        return $em
            ->createQuery('SELECT c FROM ' . $class .' c ORDER BY c.id ASC')
            ->setMaxResults(1)
            ->setFirstResult(mt_rand(0, $counter - 1))
            ->getSingleResult()
            ;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        /*
         * COMPTE ADMIN
         */

        $userManager = $this->container->get('fos_user.user_manager');
        
        $administrateur = $userManager->createUser();
        // $administrateur->setNom('Admin');
        // $administrateur->setPrenom('Prenom');
        // $administrateur->setCivilite(1);
        $administrateur->setUsername('admin');
        $administrateur->setEmail('admin@mail.com');
        $administrateur->setPlainPassword('mazedia');
        $administrateur->setEnabled(true);
        $administrateur->addRole('ROLE_ADMIN');
        $userManager->updateUser($administrateur, true);

        /** @var Particulier $particulier */
        $personne = $userManager->createUser();
        // $personne->setNom('Nom');
        // $personne->setPrenom('Prenom');
        // $personne->setCivilite(1);
        $personne->setUsername('personne');
        $personne->setEmail('personne@mail.com');
        $personne->setPlainPassword('123456');
        $personne->setEnabled(true);
        $personne->addRole('ROLE_USER');
        $userManager->updateUser($personne, true);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }

}