<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-04
 * Time: 10:14
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Form\LoginForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            '_username' => $lastUsername
        ]);

        return $this->render(
            'authorizate/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $error
            ]
        );
    }

    /**
     * @Route("/logout", name="security_logout")
     *
     */
    public function logoutAction()
    {
        throw new \Exception('This should not be reached');
    }

}