<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 19:11
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function findAllPublishedOrderBySize()
    {
        return $this->createQueryBuilder('car')
            ->andWhere('car.driver_id = :driver_id')
            ->setParameter('driver_id', 903)
            ->getQuery()
            ->execute();

    }

}