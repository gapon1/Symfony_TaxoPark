<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-03-28
 * Time: 15:52
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Form\CarFormType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarController extends Controller
{
    /**
     * @Route("/car_list", name="car_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Car')
            ->findAll();

        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $cars,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('taxopark/carList.html.twig', [
            'cars' => $result
        ]);
    }

    /**
     * @Route("car/{carName}", name="car_show")
     */
    public function showAction($carName)
    {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('AppBundle:Car')
            ->findOneBy(['car_name' => $carName]);

        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }
        return $this->render('taxopark/show.html.twig', [
            'car' => $car
        ]);
    }

    /**
     * @Route("/car/{id}/edit", name="car_edit")
     */
    public function editAction(Request $request, Car $users)
    {
        $form = $this->createForm(CarFormType::class, $users);
        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();

            $this->addFlash('success', 'Car updated!');

            return $this->redirectToRoute('car_list');
        }

        return $this->render('car/edit.html.twig', [
            'carForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete_car/{id}", name="delete_car")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Car')->find($id);
        if (!$user) {
            return $this->redirectToRoute('car_list');
        }
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('car_list');
    }

}

