<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 08:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\Orders;
use AppBundle\Entity\User;
use AppBundle\Form\OrderFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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


        /*** @var $paginator */
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
        $session = new Session();
        $userId = $this->getUser()->getId();
        $session->set('userId', $userId);

        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Orders')
            ->getFreeCar();

        return $this->render('taxopark/getFreeCar.html.twig', array(
            'get_cars' => $cars,
        ));

    }


    /**
     * @Route("/new_order/{carId}/{carName}", name="newOrder")
     */
    public function getFreeCarNewOrder(Request $request, $carId, $carName)
    {
        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        //============   Get choos Car Id AND Car Name =====
        $new_order = $em->getRepository('AppBundle:Car')
            ->findOneBy(['id' => $carId]);
        $order_car_name = $em->getRepository('AppBundle:Car')
            ->findOneBy(['car_name' => $carName]);

        //==================================================

        $userName = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $carId = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($carId);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Order created - you (%s) -  Successful', $this->getUser()->getEmail())
            );
            return $this->redirectToRoute('get_free_car');
        }

        return $this->render('taxopark/newOrder.html.twig', [
            'orderForm' => $form->createView(),
            'new_order' => $new_order,
            'order_car_name' => $order_car_name,
            'user_name' => $userName
        ]);

    }






}