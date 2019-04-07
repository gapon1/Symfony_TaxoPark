<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-06
 * Time: 15:50
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;


class OrderRepository extends EntityRepository
{

    public function getFreeCar()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT  ord.status, car.id, car.car_name, user.name
        FROM orders ord
        JOIN car ON car.id = ord.car_id
        JOIN user ON car.driver_id = user.id
        WHERE ord.status = :status AND user.roles = \'["ROLE_DRIVER"]\'
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['status' => 'finished']);

        // возвращает массив массивов (т.е. набор чистых данных)
        return $stmt->fetchAll();

    }
}











