<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ScreensDelay;
use Symfony\Component\HttpFoundation\Response;
use App\Services\GamekitScreenApi;
use App\Repository\ScreensDelayRepository;

class ScreensDelayController extends AbstractController
{
    /**
     * @Route("/screens", name="screens_delay_log")
     */
    public function index()
    {

        return $this->render('screens_delay/index.html.twig', [
            'controller_name' => 'ScreensDelayController',
        ]);
    }

    /**
     * @Route("/screens/avg", name="screens_delay_avg")
     */
    public function avgScreenDelay(ScreensDelayRepository $ScreensDelayRepository)
    {
        $delay['daily'] = $ScreensDelayRepository->returnAvgDelayDaily();
        $delay['monthly'] = $ScreensDelayRepository->returnAvgDelayMonthly();
        return $this->render('screens_delay/avg.html.twig', [
            'delay' => $delay,
            'controller_name' => 'ScreensDelayController',
        ]);
    }

    /**
     * @Route("/screens/api", name="screens_delay_api")
     */

    public function insertDelayToDatabase()
    {
    	$ApiFeedback = new GamekitScreenApi;

    	$records = new ScreensDelay();
    	$records->setDGScreens($ApiFeedback->DogryNumberOfScreens);
    	$records->setDGTime($ApiFeedback->DogryDateDelay);
    	$records->setGKScreens($ApiFeedback->GamekitNumberOfScreens);
    	$records->setGKTime($ApiFeedback->GamekitDateDelay);
    	$records->setTimeStat($ApiFeedback->dateNow);

    	$em = $this->getDoctrine()->getManager();
    	$em->persist($records);
    	$em->flush();

    	return new Response();
    }
}
