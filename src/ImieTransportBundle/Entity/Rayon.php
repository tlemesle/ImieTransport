<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 24/10/17
 * Time: 21:34
 */

namespace ImieTransportBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="rayon")
 */
class Rayon
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="libelle", type="string", nullable=false)
     */
    protected $libelle;

    /**
     * @ORM\OneToMany(targetEntity="ImieTransportBundle\Entity\Produit", mappedBy="rayon", cascade={"persist"})
     */
    private $produits;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * @param mixed $produits
     */
    public function setProduits($produits)
    {
        $this->produits = $produits;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->libelle;
    }


}