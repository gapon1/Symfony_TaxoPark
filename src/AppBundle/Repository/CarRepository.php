<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 19:11
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{

    public function getFreeCar()
    {
        /**
         * @return Car[]
         */
        return $this->createQueryBuilder('car')
            ->andWhere('car.name = :carName')
            ->setParameter('carName', 'kihn.dee - BMW-3')
            ->getQuery()
            ->execute();

    }

}