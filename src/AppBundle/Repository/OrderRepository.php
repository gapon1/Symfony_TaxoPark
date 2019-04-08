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
    public function getFreeCar()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT  ord.status, car.id, car.car_name, user.name, ord.id
        FROM orders ord
        JOIN car ON car.id = ord.car_id
        JOIN user ON car.driver_id = user.id
        WHERE ord.status = :status AND  user.roles = \'["ROLE_ADMIN"]\'
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['status' => 'finished']);

        return $stmt->fetchAll();
    }



    public function findFreeOrder()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT  ord.status, ord.id, ord.from_address, ord.to_address
        FROM orders ord
        WHERE ord.status = :status
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['status' => 'call']);

        // возвращает массив массивов (т.е. набор чистых данных)
        return $stmt->fetchAll();
    }


    public function findDriverOrders()
    {

        $session = new Session();
        $userId = $session->get('userId');

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT   orders.id, orders.status, orders.from_address, orders.to_address, car.car_name 
        FROM orders
        JOIN user
        ON orders.user_id = user.id
        JOIN car
        ON orders.car_id = car.id
        WHERE orders.user_id = :uId
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['uId' => $userId]);



        // возвращает массив массивов (т.е. набор чистых данных)
        return $stmt->fetchAll();
    }

}











