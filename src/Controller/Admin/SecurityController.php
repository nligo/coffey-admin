<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function login(AuthenticationUtils $authenticationUtils)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {

            return $this->redirect('/');
        }

        $username = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('admin/login.html.twig', [
                'username' => $username,
                'error' => $error,
            ]
        );
    }

    public function logout()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }
}
