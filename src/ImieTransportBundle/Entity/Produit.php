<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 24/10/17
 * Time: 21:39
 */

namespace ImieTransportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="produit")
 */
class Produit
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
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    protected $stock;

    /**
     * @ORM\Column(name="limite_stock", type="integer", nullable=false)
     */
    protected $limiteStock;

    /**
     * @ORM\Column(name="alert_mail", type="boolean")
     */
    protected $alertMail;

    /**
     * @ORM\ManyToOne(targetEntity="ImieTransportBundle\Entity\Rayon", inversedBy="produits")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="rayon_id",referencedColumnName="id", nullable=true, onDelete="CASCADE")
     * })
     */
    private $rayon;

    /**
     * @ORM\OneToMany(targetEntity="ImieTransportBundle\Entity\SortieProduit", mappedBy="produit", cascade={"persist"})
     */
    private $sorties;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getLimiteStock()
    {
        return $this->limiteStock;
    }

    /**
     * @param mixed $limiteStock
     */
    public function setLimiteStock($limiteStock)
    {
        $this->limiteStock = $limiteStock;
    }

    /**
     * @return mixed
     */
    public function getAlertMail()
    {
        return $this->alertMail;
    }

    /**
     * @param mixed $alertMail
     */
    public function setAlertMail($alertMail)
    {
        $this->alertMail = $alertMail;
    }

    /**
     * @return mixed
     */
    public function getRayon()
    {
        return $this->rayon;
    }

    /**
     * @param mixed $rayon
     */
    public function setRayon($rayon)
    {
        $this->rayon = $rayon;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return mixed
     */
    public function getSorties()
    {
        return $this->sorties;
    }

    /**
     * @param mixed $sorties
     */
    public function setSorties($sorties)
    {
        $this->sorties = $sorties;
    }


}