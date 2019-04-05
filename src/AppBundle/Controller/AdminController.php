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
     * @Route("/add_cars", name="add_free_car")
     */
    public function newAction()
    {


        $car = new Car();
        $car->setName('AquaWeaver');
        $car->setCarType('ryan.jpeg');
        $car->setCarDiscript('I counted 8 legs... as they wrapped around me');
        $car->setCarImg('-1 month');
        $car->setDriverId(rand(1, 100));

        $order = new Orders();
        $order->setUserId(rand(1, 100));
        $order->setFromAddress('Octopodinae');
        $order->setToAddress('Octopodinae TO');
        $order->setStatus('free');
        $order->setCars($car);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->persist($car);
        $em->flush();

        return new Response('<html><body>Genus created!</body></html>');
    }




}