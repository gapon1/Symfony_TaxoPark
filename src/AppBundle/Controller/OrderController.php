<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 08:19
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/orders", name="show_orders")
     */
    public function getOrderAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Orders')
            ->findAll();

        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $orders,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('taxopark/orderList.html.twig', [
            'orders' => $result
        ]);

    }


    /**
     * @Route("order/{orderId}", name="order_show")
     */
    public function showAction($orderId)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $orderId]);

        if (!$order) {
            throw $this->createNotFoundException('Order not found');
        }

        return $this->render('taxopark/showOrder.html.twig', [
            'order' => $order
        ]);

    }





    /**
     * @Route("/get_car", name="get_free_car")
     */
    public function getFreeCar()
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Car')
            ->getFreeCar();



        return $this->render('taxopark/getFreeCar.html.twig', array(
            'get_cars' => $cars
        ));

    }






}