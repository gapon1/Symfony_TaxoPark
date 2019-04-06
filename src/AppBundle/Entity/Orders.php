<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 20:26
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Car;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Car", inversedBy="orders")
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id")
     */
    private $cars;

    /**
     * @return mixed
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param mixed $cars
     */
    public function setCars($cars)
    {
        $this->cars = $cars;
    }





    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    /**
     * @ORM\Column(type="string")
     */
    private $fromAddress;

    /**
     * @ORM\Column(type="string")
     */
    private $toAddress;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @return mixed
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param mixed $fromAddress
     */
    public function setFromAddress($fromAddress)
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * @return mixed
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * @param mixed $toAddress
     */
    public function setToAddress($toAddress)
    {
        $this->toAddress = $toAddress;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }




}