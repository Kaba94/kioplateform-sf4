<?php

namespace App\Controller;

use App\Entity\Shoot;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * Mis à jour automatique du shoot
     * @Route("/api/{id}/edit", name="api_shoot_edit", methods={"PUT"})
     */
    public function majShoot(?Shoot $shoot, Request $request, EntityManagerInterface $manager): Response
    {
        // On récupére les donnees de fullCalendar
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            // isset($donnees->plateform) && !empty($donnees->plateform) &&
            // isset($donnees->campagne) && !empty($donnees->campagne) &&
            // isset($donnees->routeur) && !empty($donnees->routeur) &&
            isset($donnees->volume) && !empty($donnees->volume) 
            // isset($donnees->annonceur) && !empty($donnees->annonceur)
        ){
            // Les données sont complètes 
            // On initialise un code
            $code = 200;

            // On verifie si l'id existe
            if(!$shoot){
                $shoot = new Shoot;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec nos données
            $shoot->setTitle($donnees->title);
            $shoot->setStart(new DateTime($donnees->start));
            // $shoot->setPlateform($donnees->plateforme);
            // $shoot->setCampagne($donnees->campagne);
            // $shoot->setRouteur($donnees->routeur);
            $shoot->setVolume($donnees->volume);
            // $shoot->setAnnonceur($donnees->annonceur);

            $manager->persist($shoot);
            $manager->flush();

            //  On retourne le code
            return new Response('ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
