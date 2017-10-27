<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 24/10/17
 * Time: 23:32
 */

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use ImieTransportBundle\Entity\Produit;

class LoadProduitDatas extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $rayon1 = $this->getReference("r1");
        $rayon2 = $this->getReference("r2");
        $rayon3 = $this->getReference("r3");

        $p = new Produit();
        $p->setLibelle("1/2 Jambonneau de porc 250g ");
        $p->setDescription("Jambonneau de marque Fleury Michon");
        $p->setStock(20);
        $p->setLimiteStock(5);
        $p->setAlertMail(true);
        $p->setRayon($rayon1);
        $manager->persist($p);

        $p1 = new Produit();
        $p1->setLibelle("Crème Epaisse Entière 33cl ");
        $p1->setDescription("Creme fraiche de marque Elle & Vire");
        $p1->setStock(17);
        $p1->setLimiteStock(8);
        $p1->setAlertMail(true);
        $p1->setRayon($rayon2);
        $manager->persist($p1);

        $p2 = new Produit();
        $p2->setLibelle("Curly Maxi St 200g ");
        $p2->setDescription("Gateau apéro de marque Vico");
        $p2->setStock(80);
        $p2->setLimiteStock(20);
        $p2->setAlertMail(true);
        $p2->setRayon($rayon3);
        $manager->persist($p2);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}