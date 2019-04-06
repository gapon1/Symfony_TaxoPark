<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-06
 * Time: 15:50
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Orders;
use Doctrine\ORM\EntityRepository;


class OrderRepository extends EntityRepository
{

    public function getFreeCar()
    {

        return $this->createQueryBuilder('orders')
            ->where('orders.status = :status')
            ->setParameter('status', 'finished')
            ->orderBy('orders.status', 'ASC')
            ->getQuery()
            ->execute();

    }
}