<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 19:11
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use AppBundle\Entity\Orders;
use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{

    public function getFreeCar()
    {

    }

}