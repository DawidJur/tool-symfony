<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) 
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {
    	$error = $utils->getLastAuthenticationError();

    	$lastUsername = $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
    * @Route("/logout", name="logout") 
    */
    public function logout()
    {

    }

    /**
    * @Route("/registration", name="registration") 
    */
    public function register(Request $request)
    {
        $user = new User();
        
        $form = $this->createForm(RegistrationType::class, $user, [
            'action' => $this->generateUrl('registration'),
            'method' => 'POST'
        ]);

        $error = null;

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->encoder->encodePassword($user, $form->getData()->getPassword())
            );

            $em = $this->getDoctrine()->getManager();
            $isUser = count($this->getDoctrine()->getRepository(User::class)->findBy(['username' => $form->getData()->getUsername()]));
            if($isUser == 0) {
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('login');
            } else {
                $error = "This user already exists";
            }
        }

        return $this->render('security/registration.html.twig', [
            'registration_form' => $form->createView(),
            'error' => $error
        ]);
    }
}
