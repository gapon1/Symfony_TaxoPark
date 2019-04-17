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

    public function getFreeCar()
    {
        return $this->createQueryBuilder('car')
            ->select('car.car_name', 'carId.status', 'user.name', 'carId.id')
            ->join('car.driver_id', 'user')
            ->leftJoin('car.car_id', 'carId')
            ->where('carId.status = :status')
            ->setParameter('status', 'finished')
            ->orderBy('car.car_name', 'ASC')
            ->getQuery()
            ->execute();
    }

    public function getCar()
    {
        return $this->createQueryBuilder('car')
            ->leftJoin('car.car_id', 'carId')
            ->where('carId.status = :status')
            ->setParameter('status', 'finished')
            ->orderBy('car.car_name', 'ASC');
    }

}