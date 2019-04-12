<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 19:11
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Orders;
use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{

    public function getCar()
    {
        return $this->createQueryBuilder('car')
            ->leftJoin('car.car_id', 'carId')
            ->where('carId.status = :status')
            ->setParameter('status','finished')
            ->orderBy('car.car_name', 'ASC');
    }

}