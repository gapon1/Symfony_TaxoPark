<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 20:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Form\DriverForType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class DriverController
 * @package AppBundle\Controller
 */
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

        $driver_orders = $em->getRepository('AppBundle:Orders')
            ->findDriverOrders();

        return $this->render('driver/orderList.html.twig', [
            'orders' => $orders,
            'driver_orders' => $driver_orders,
        ]);
    }


    /**
     * @Route("/take_order/{id}", name="take_order")
     */
    public function takeOrder($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $id]);

        $change_status = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $id]);
        $change_status->setStatus('waiting');
        $change_status->setDriverIdOrd($this->getUser()->getId());

        $this->addFlash('success', 'You took this order to work!');

        $em->persist($change_status);
        $em->flush();

        if (!$orders) {
            throw $this->createNotFoundException("No found Line");
        }

        return $this->render('driver/takenOrder.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/change_status/{id}", name="shangeStatus")
     */
    public function changeStatus(Request $request, $id, Orders $orders)
    {
        $form = $this->createForm(DriverForType::class, $orders);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $orders = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($orders);
            $em->flush();

            $this->addFlash('success', 'Status updated!');
            return $this->redirectToRoute('ordersForDriver');

        }

        $em = $this->getDoctrine()->getManager();
        $orders_status = $em->getRepository('AppBundle:Orders')
            ->findOneBy(['id' => $id]);

        if (!$orders_status) {
            throw $this->createNotFoundException("No found Line");
        }

        return $this->render('driver/changeStatus.html.twig', [
            'orders_status' => $orders_status,
            'orderStatus' => $form->createView()
        ]);
    }


}