<?php

namespace App\Controller;

use App\Entity\Shoot;
use App\Form\ShootType;
use App\Repository\ShootRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_PERSONNEL")
 * @Route("/shoot")
 */
class ShootController extends AbstractController
{
    /**
     * @Route("/", name="shoot_index", methods={"GET"})
     */
    public function index(ShootRepository $shootRepository): Response
    {
        return $this->render('shoot/index.html.twig', [
            'shoots' => $shootRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="shoot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $shoot = new Shoot();
        $form = $this->createForm(ShootType::class, $shoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shoot);
            $entityManager->flush();

            return $this->redirectToRoute('shoot_index');
        }

        return $this->render('shoot/new.html.twig', [
            'shoot' => $shoot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shoot_show", methods={"GET"})
     */
    public function show(Shoot $shoot): Response
    {
        return $this->render('shoot/show.html.twig', [
            'shoot' => $shoot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="shoot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Shoot $shoot): Response
    {
        $form = $this->createForm(ShootType::class, $shoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shoot_index');
        }

        return $this->render('shoot/edit.html.twig', [
            'shoot' => $shoot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shoot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Shoot $shoot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shoot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shoot_index');
    }
}
