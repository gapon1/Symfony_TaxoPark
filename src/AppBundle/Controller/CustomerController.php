<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 20:36
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CustomerController extends Controller
{
    /**
     * @Route("/get_car", name="get_free_car")
     */
    public function getFreeCar()
    {
        $var = "text1";

//        $em = $this->getDoctrine()->getManager();
//        $cars = $em->getRepository('AppBundle:Car')
//            ->findAllPublishedOrderBySize();

        return $this->render('taxopark/getFreeCar.html.twig', [
            'get_cars' => $var
        ]);


    }


}