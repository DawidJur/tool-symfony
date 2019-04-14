<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
    	$user = $this->get('security.token_storage')->getToken()->getUser();
        $username = $user != 'anon.' ? $user->getUsername() : null;

        return $this->render('index.html.twig', [
            'username' => $username,
        ]);
    }
}
