<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 15:45
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 * @ORM\Table(name="car")
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="driver_id", referencedColumnName="id")
     */
    private $driver_id;

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->driver_id;
    }

    /**
     * @param mixed $driver_id
     */
    public function setDriverId($driver_id)
    {
        $this->driver_id = $driver_id;
    }





    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Orders", mappedBy="car")
     *
     */
    private $car_id;



    public function __construct()
    {
        $this->car_id = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getCarId()
    {
        return $this->car_id;
    }

    /**
     * @param mixed $car_id
     */
    public function setCarId($car_id)
    {
        $this->car_id = $car_id;
    }




    /**
     * @ORM\Column(type="string")
     */
    private $car_name;




    /**
     * @ORM\Column(type="string")
     */
    private $car_type;


    /**
     * @ORM\Column(type="string")
     */
    private $carDiscript;

    /**
     * @ORM\Column(type="string")
     */
    private $carImg;


    /**
     * @return mixed
     */
    public function getCarImg()
    {
        return $this->carImg;
    }

    /**
     * @param mixed $carImg
     */
    public function setCarImg($carImg)
    {
        $this->carImg = $carImg;
    }

    /**
     * @return mixed
     */
    public function getCarDiscript()
    {
        return $this->carDiscript;
    }

    /**
     * @param mixed $carDiscript
     */
    public function setCarDiscript($carDiscript)
    {
        $this->carDiscript = $carDiscript;
    }

    /**
     * @return mixed
     */
    public function getCarType()
    {
        return $this->car_type;
    }

    /**
     * @param mixed $car_type
     */
    public function setCarType($car_type)
    {
        $this->car_type = $car_type;
    }


    /**
     * @return mixed
     */
    public function getCarName()
    {
        return $this->car_name;
    }

    /**
     * @param mixed $car_name
     */
    public function setCarName($car_name)
    {
        $this->car_name = $car_name;
    }


    public function __toString()
    {
        return $this->getCarName();
    }



    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0,100). 'days');

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }






}