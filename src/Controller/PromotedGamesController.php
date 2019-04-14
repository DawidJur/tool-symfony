<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PromotedGamesImportType;
use Symfony\Component\HttpFoundation\Request;
use App\Services\PromotedGamesCSVManagement;
use App\Services\PromotedGamesView;
use App\Entity\PromotedGames;
use App\Repository\PromotedGamesRepository;
use App\Form\GamesListMonthSelectType;
use App\Repository\PromotedGamesProfilesRepository;
use App\Services\PromotedGamesProfilesManagement;
use App\Entity\PromotedGamesProfiles;
use App\Form\PromotedGamesProfilesType;

class PromotedGamesController extends AbstractController
{
    /**
     * @Route("/games/upload", name="promoted_games_upload")
     */
    public function upload(Request $request)
    {
    	$form = $this->createForm(PromotedGamesImportType::class, [
            'action' => $this->generateUrl('promoted_games_upload'),
            'method' => 'POST'
        ]);
        $feedback = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = fopen($request->files->get('promoted_games_import')['file']->getRealPath(), 'r');
			$em = $this->getDoctrine()->getManager();
    		$csv = new PromotedGamesCSVManagement($file, $em);
            $feedback = $csv->feedback;
    	}

        return $this->render('promoted_games/upload.html.twig', [
            'form' => $form->createView(),
            'feedback' => $feedback
        ]);
    }
    /**
     * @Route("/games", name="promoted_games_news_form")
     */
    public function printGamesListForm(Request $request)
    {
        $form = $this->createForm(GamesListMonthSelectType::class, [
            'action' => $this->generateUrl('promoted_games_news_form'),
            'method' => 'POST'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = $request->request->get('games_list_month_select')['raport_date'];
            $year = $date['year'];
            $month = $date['month'];
            
            return $this->redirectToRoute('promoted_games_news', ['month' => $month, 'year' => $year]);
        }

        return $this->render('promoted_games/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/games/{year}/{month}", name="promoted_games_news")
     */
    public function printGamesListInMonth(PromotedGamesRepository $PromotedGamesRepository, Request $request, $year, $month)
    {
    	$games = $PromotedGamesRepository->returnGamesListInMonth($year, $month);

    	$view = new PromotedGamesView($games);

    	return $this->render('promoted_games/news.html.twig', [
            'games_table' => $view->printGames()
        ]);
    }

    /**
     * @Route("/games/profiles", name="promoted_games_profiles_form")
     */
    public function printGamesProfilesForm(Request $request, PromotedGamesProfilesRepository $pgpRepo)
    {
            
        return $this->render('promoted_games/profiles.html.twig');
    }
}
