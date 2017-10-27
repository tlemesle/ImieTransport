<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 26/10/17
 * Time: 14:04
 */

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity
 * ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="acceptCharte", type="boolean")
     *
     */
    protected $acceptCharte;

    /**
     * @return mixed
     */
    public function getAcceptCharte()
    {
        return $this->acceptCharte;
    }

    /**
     * @param mixed $acceptCharte
     */
    public function setAcceptCharte($acceptCharte)
    {
        $this->acceptCharte = $acceptCharte;
    }


}