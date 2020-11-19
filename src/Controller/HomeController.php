<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PlateformRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PlateformRepository $repository, UserRepository $ur): Response
    {
        return $this->render( 'home/index.html.twig', [
            'plateforms' => $repository->findAll(),
        ]);
    }
}
