<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 24/10/17
 * Time: 23:36
 */

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use ImieTransportBundle\Entity\Rayon;

class LoadRayonDatas extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $r1 = new Rayon();
        $r1->setLibelle("Traiteur LS");
        $manager->persist($r1);
        $this->addReference("r1",$r1);

        $r2 = new Rayon();
        $r2->setLibelle("Cremerie");
        $manager->persist($r2);
        $this->addReference("r2",$r2);

        $r3 = new Rayon();
        $r3->setLibelle("Snacking");
        $manager->persist($r3);
        $this->addReference("r3",$r3);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}