<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 15:52
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Car;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class CarController extends Controller
{
    /**
     * @Route("car/new", name="car")
     *
     */
    public function newAction()
    {
        $car = new Car();
        $car->setName("BMW".rand(1,7));
        $car->setCarType('Universal');
        $car->setDriverId(rand(1,10));


        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return new Response('<html><body>Car created</body></html>');


    }

}