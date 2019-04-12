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
        SELECT DISTINCT user.name, ord.car_id,  car.car_name,  ord.status, ord.id
            FROM orders ord
                JOIN car ON ord.car_id = car.id
                JOIN user ON user.id = car.driver_id
            WHERE ord.status = :status
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
        WHERE orders.driver_id = :uId
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['uId' => $userId]);


        // возвращает массив массивов (т.е. набор чистых данных)
        return $stmt->fetchAll();
    }

}











