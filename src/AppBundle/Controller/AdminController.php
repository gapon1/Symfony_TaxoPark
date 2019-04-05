<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 20:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Orders;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{



    /**
     * @Route("/add_car", name="get_free_car")
     */
    public function getAddCarAction()
    {

        $order = new Orders();
        $order->setStatus('sitDown');
        $order->setCarId(6);
        $order->setToAddress('Popova');
        $order->setFromAddress('perova');
        $order->setUserId(3);


        $car = new Car();
        $car->setDriverId(11);
        $car->setCarType('sport');
        $car->setCarImg('BMW-6.png');
        $car->setCarDiscript("text");
        $car->setName("BMW-X6");
        $car->setOrder($order);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        $entityManager->persist($car);
        $entityManager->flush();

        return new Response('<html><body>Genus created!</body></html>');

    }




}