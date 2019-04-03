<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-02
 * Time: 21:19
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    /**
     * @Route("/all_users", name="all_users")
     */
    public function getAllUsers(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $get_users = $em->getRepository('AppBundle:User')
            ->findAll();


        /**
         * @var $paginator
         */
        $paginator = $this->get('knp_paginator');

        $result = $paginator->paginate(
            $get_users,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)

        );


        return $this->render('user/list.html.twig', [
            'all_users' => $result
        ]);

    }


    /**
     * @Route("user/{userName}", name="user_show")
     */
    public function showAction($userName)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')
            ->findOneBy(['name' => $userName]);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('user/show.html.twig', [
            'user' => $user
        ]);

    }

}