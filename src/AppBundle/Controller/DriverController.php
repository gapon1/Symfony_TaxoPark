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

class DriverController extends Controller
{

    /**
     * @Route("/freeOrder", name="ordersForDriver")
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Orders')
            ->findFreeOrder();



        return $this->render('driver/orderList.html.twig', [
            'orders' => $orders
        ]);

    }



}