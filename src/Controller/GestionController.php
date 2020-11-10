<?php

namespace App\Controller;

use App\Entity\Plateform;
use App\Form\PlateformFormType;
use App\Repository\PlateformRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_PERSONNEL")
 * @Route("/gestion", name="gestion_")
 */
class GestionController extends AbstractController
{

    /**
     * Liste de toutes les plateform
     * @Route("/plateform", name="plateform")
     */
    public function index(PlateformRepository $repository)
    {
        return $this->render('gestion/plateform/plateform.html.twig', [
            'plateforms' => $repository->findAll(),
        ]);
    }

    /**
     * Ajout d'une nouvelle plateform
     * @Route("/create_plateform", name="create_plateform")
     */
    public function createPlatefom(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(PlateformFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $plateform = $form->getData();

            $manager->persist($plateform);
            $manager->flush();

            $this->addFlash('success', 'La plateform a été enregistré !');
            return $this->redirectToRoute('gestion_plateform');
        }

        return $this->render('gestion/plateform/create_plateform.html.twig', [
            'plateformForm' => $form->createView()
        ]);
       
    }

    /**
     * Modifier une plateform
     * @Route("/edit_plateform/{id}", name="edit_plateform")
     */
    public function editPlateform(EntityManagerInterface $manager, Plateform $plateform, Request $request)
    {
        $form = $this->createForm(PlateformFormType::class, $plateform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->flush();

            $this->addFlash('success', 'Le produit a été mis à jour.');

            return $this->redirectToRoute('gestion_plateform');
        }

        return $this->render('gestion/plateform/edit_plateform.html.twig', [
            'plateform' => $plateform,
            'plateformForm' => $form->createView()
        ]);
    }

    /**
     * Suppression d'une plateform
     * @Route ("/remove_plateform/{id}", name="remove_plateform")
     * @IsGranted("ROLE_PROPRIETAIRE")
     */
    public function removePlateform(Plateform $plateform, EntityManagerInterface $manager, Request $request)
    {
        // Récuparation du jeton csrf
        $token = $request->query->get('token');

        // Vérification de la validité de la clé 
        if ($this->isCsrfTokenValid('gestion_remove_plateform', $token))
        {
            // Suppression
            $manager->remove($plateform);
            $manager->flush();
        }
        // redirection
        return $this->redirectToRoute('gestion_plateform');
    }
}
