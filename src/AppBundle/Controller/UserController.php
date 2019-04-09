<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-02
 * Time: 21:19
 */

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @Security("is_granted('ROLE_ADMIN')")
 */
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
            $request->query->getInt('limit', 4));

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


    // ================== ADD Data in form =============

    /**
     * @Route("/add_user/new", name="user_new_create")
     */
    public function newAction(Request $request)
    {


        $form = $this->createForm(UserFormType::class);
        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                sprintf('User created - you (%s) - Your are amazing', $this->getUser()->getEmail())
            );
            return $this->redirectToRoute('all_users');
        }

        return $this->render('user/new.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    // ================== Update Data in form =============

    /**
     * @Route("/user/{id}/edit", name="user_edit")
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(UserFormType::class, $user);
        // only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User updated!');

            return $this->redirectToRoute('all_users');
        }

        return $this->render('user/edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    // ================ DELETE USER ================

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if (!$user) {
            return $this->redirectToRoute('all_users');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('all_users');
    }

}