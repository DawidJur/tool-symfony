<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MenuType;
use App\Entity\Menu;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;


class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function printMenuList(UserInterface $user)
    {
        $menu = new Menu();       
        $form = $this->createForm(MenuType::class, $menu, [
            'action' => $this->generateUrl('MenuFormAddRecordsToDB'),
            'method' => 'POST'
        ]);
        
        $menu_records = $this->getDoctrine()->getRepository(Menu::class)->findBy(['UserId' => $user->getId()], ['MenuOrder' => 'ASC']);

        return $this->render('menu/index.html.twig', [
            'form' => $form->createView(),
            'menu_records' => $menu_records
        ]);
    }

    /**
     * @Route("/menu/add", name="MenuFormAddRecordsToDB")
     */
    public function addRecordsToDatabase(Request $request, UserInterface $user)
    {
    	$menu = new Menu();
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(MenuType::class, $menu);

    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid()) {
            $menu->setUserId($user->getId());
    		
    		$em->persist($menu);
    		$em->flush();
    	}

        return $this->redirectToRoute('menu');
    }

    /**
     * @Route("/menu/edit/{id}", name="editMenuRecord")
     */
    public function editMenu(Request $request, UserInterface $user, $id)
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);

        $form = $this->createForm(MenuType::class, $menu);
        $form->get('MenuLink')->setData($menu->getMenuLink());
        $form->get('MenuName')->setData($menu->getMenuName());
        $form->get('MenuOrder')->setData($menu->getMenuOrder());


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('menu');
        }

        return $this->render('menu/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }    

    /**
     * @Route("/menu/delete/{id}", name="deleteMenuRecord")
     */
    public function deleteMenu(Request $request, UserInterface $user, $id)
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($menu);
        $em->flush();

        return $this->redirectToRoute('menu');
    }

    /**
     * @Route("/menu/{nickname}", name="MenuFeedback")
     */
    public function printMenuFeedback($nickname)
    {
        $userID = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $nickname])->getId();
        $menu = $this->getDoctrine()->getRepository(Menu::class)->findBy(['UserId' => $userID]);
        $html = '<ul class="nav navbar-sidebar nav-list">';
        foreach ($menu as $row) {
            $html .= '<li><a href="'.$row->getMenuLink().'">'.$row->getMenuName().'</a></li>';
          }
          $html .= "</ul>";
        return new Response($html);
    }
}
