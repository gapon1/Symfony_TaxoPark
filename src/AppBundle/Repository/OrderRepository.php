<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-06
 * Time: 15:50
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;


class OrderRepository extends EntityRepository
{

    public function findFreeOrder()
    {
        return $this->createQueryBuilder('orders')
            ->select('orders.status', 'orders.id', 'orders.fromAddress', 'orders.toAddress')
            ->where('orders.status = :status')
            ->setParameter('status', 'call')
            ->orderBy('orders.id', 'ASC')
            ->getQuery()
            ->execute();
    }


    public function findDriverOrders()
    {
        $session = new Session();
        $userId = $session->get('userId');

        return $this->createQueryBuilder('orders')
            ->select('orders.status', 'car.car_name', 'orders.id', 'orders.fromAddress', 'orders.toAddress')
            ->join('orders.user_order', 'user')
            ->join('orders.car', 'car')
            ->where('orders.driver_id = :uId')
            ->setParameter('uId', $userId)
            ->orderBy('orders.id', 'ASC')
            ->getQuery()
            ->execute();
    }

}











