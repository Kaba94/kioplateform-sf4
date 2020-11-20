<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CalendarRepository;
use App\Repository\PlateformRepository;
use App\Repository\ShootRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ShootRepository $repository): Response
    {
        $events = $repository->findAll();

        foreach($events as $event){

            $shoot[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'plateform' => $event->getPlateform(),
                'annonceur' => $event->getAnnonceur(),
                'routeur' => $event->getRouteur(),
                'campagne' => $event->getCampagne(),
                'volume' => $event->getVolume(),
                'backgroundColor' => $event->getBackgroundColor(),
           ];
        }
        $data = json_encode($shoot);
        return $this->render( 'home/index.html.twig', compact('data'));
    }
}
