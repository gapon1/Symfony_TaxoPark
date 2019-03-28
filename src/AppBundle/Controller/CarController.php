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
        $random = rand(1, 7);

        $car = new Car();
        $car->setName("BMW" . $random);
        $car->setCarType('Universal');
        $car->setDriverId(rand(1, 10));
        $car->setCarDiscript('Some Descriptions');
        $car->setCarImg('BMW-' . $random . '.png');

        $em = $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();

        return new Response('<html><body>Car created</body></html>');
    }


    /**
     * @Route("/car_list")
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Car')
            ->findAllPublishedOrderBySize();

        return $this->render('taxopark/carList.html.twig', [
            'cars' => $cars
        ]);
    }


    /**
     * @Route("car/{carName}", name="car_show")
     */
    public function showAction($carName)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('AppBundle:Car')
            ->findOneBy(['name' => $carName]);

        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }

        return $this->render('taxopark/show.html.twig', [
            'car' => $car
        ]);

    }

}