<?php

namespace App\Controller;

use App\Entity\Annonceur;
use App\Entity\Plateform;
use App\Entity\Prestation;
use App\Entity\Routeur;
use App\Form\AnnonceurFormType;
use App\Form\PlateformFormType;
use App\Form\PrestationFormType;
use App\Form\RouteurFormType;
use App\Repository\AnnonceurRepository;
use App\Repository\PlateformRepository;
use App\Repository\PrestationRepository;
use App\Repository\RouteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Twig\Extra\Intl\IntlExtension;

/**
 * @IsGranted("ROLE_PERSONNEL")
 * @Route("/gestion", name="gestion_")
 */
class GestionController extends AbstractController
{

    

    

    /*****PLATEFORM******/

    /**
     * Liste de toutes les plateform
     * @Route("/plateform", name="plateform")
     */
    public function indexPlateform(PlateformRepository $repository)
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

            $this->addFlash('success', 'La plateform a été mis à jour.');

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

    /*****ROUTEUR*******/

    /**
     * Liste de tout les routeurs 
     * @Route("/routeur", name="routeur")
     */
    public function indexRouteur(RouteurRepository $repository)
    {
        return $this->render('gestion/routeur/routeur.html.twig', [
            'routeurs' => $repository->findAll(),
        ]);
    }

    /**
     * Ajout d'un nouveau routeur
     * @Route("/create_routeur", name="create_routeur")
     */
    public function createRouteur(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(RouteurFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $routeur = $form->getData();

            $manager->persist($routeur);
            $manager->flush();

            $this->addFlash('success', 'La routeur a été enregistré !');
            return $this->redirectToRoute('gestion_routeur');
        }

        return $this->render('gestion/routeur/create_routeur.html.twig', [
            'routeurForm' => $form->createView()
        ]);
    }

    /**
     * Modifier un routeur
     * @Route("/edit_routeur/{id}", name="edit_routeur")
     */
    public function editRouteur(EntityManagerInterface $manager, Routeur $routeur, Request $request)
    {
        $form = $this->createForm(RouteurFormType::class, $routeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->flush();

            $this->addFlash('success', 'Le routeur a été mis à jour.');

            return $this->redirectToRoute('gestion_routeur');
        }

        return $this->render('gestion/routeur/edit_routeur.html.twig', [
            'routeur' => $routeur,
            'routeurForm' => $form->createView()
        ]);
    }

   /**
     * Suppression d'un routeur
     * @Route ("/remove_routeur/{id}", name="remove_routeur")
     * @IsGranted("ROLE_PROPRIETAIRE")
     */
    public function removeRouteur(Routeur $routeur, EntityManagerInterface $manager, Request $request)
    {
        // Récuparation du jeton csrf
        $token = $request->query->get('token');

        // Vérification de la validité de la clé 
        if ($this->isCsrfTokenValid('gestion_remove_routeur', $token))
        {
            // Suppression
            $manager->remove($routeur);
            $manager->flush();
        }
        // redirection
        return $this->redirectToRoute('gestion_routeur');
    }

    /**
     * Ajouter un prix routeur/plateform
     * @Route("/prestation", name="prestation")
     */
    public function prestation(Request $request, EntityManagerInterface $manager) 
    { 

        $prestation = new Prestation(); 
        $form = $this->createForm(PrestationFormType::class, $prestation); 

        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $prestation = $form->getData();
            $manager->persist($prestation); 
            $manager->flush(); 

        return $this->redirectToRoute('gestion_list_prestation'); 
        } 


        return $this->render(
        'gestion/prestation/prestation.html.twig', 
        ['prestationForm' => $form->createView()]); 
    }

    /**
     * Liste de tout les prix de routeur 
     * @Route("/list_prestation", name="list_prestation")
     */
    public function indexPrestation(PrestationRepository $repository)
    {
        return $this->render('gestion/prestation/list_prestation.html.twig', [
            'prestations' => $repository->findAll(),
        ]);
    }

    /**
     * Modifier un prix
     * @Route("/edit_prestation/{id}", name="edit_prestation")
     */
    public function editPrestation(EntityManagerInterface $manager, Prestation $prestation, Request $request)
    {
        $form = $this->createForm(PrestationFormType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->flush();

            $this->addFlash('success', 'Le prix a été mis à jour.');

            return $this->redirectToRoute('gestion_list_prestation');
        }

        return $this->render('gestion/prestation/edit_prestation.html.twig', [
            'prestation' => $prestation,
            'prestationForm' => $form->createView()
        ]);
    }

    /**
     * Suppression d'un prix
     * @Route ("/remove_prestation/{id}", name="remove_prestation")
     * @IsGranted("ROLE_PROPRIETAIRE")
     */
    public function removePrestation(Prestation $prestation, EntityManagerInterface $manager, Request $request)
    {
        // Récuparation du jeton csrf
        $token = $request->query->get('token');

        // Vérification de la validité de la clé 
        if ($this->isCsrfTokenValid('gestion_remove_prestation', $token))
        {
            // Suppression
            $manager->remove($prestation);
            $manager->flush();
        }
        // redirection
        return $this->redirectToRoute('gestion_list_prestation');
    }


    /******* ANNONCEUR *******/

    /**
     * Liste de tout les annonceur
     * @Route("/annonceur", name="annonceur")
     */
    public function indexAnnonceur(AnnonceurRepository $repository)
    {
        
        return $this->render('gestion/annonceur/annonceur.html.twig', [
            'annonceurs' => $repository->findAll(),
        ]);
    }

    /**
     * Ajout d'un nouvel annonceur
     * @Route("/create_annonceur", name="create_annonceur")
     */
    public function createAnnonceur(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(AnnonceurFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $annonceur = $form->getData();

            $manager->persist($annonceur);
            $manager->flush();

            $this->addFlash('success', 'L\'annonceur a été enregistré !');
            return $this->redirectToRoute('gestion_annonceur');
        }

        return $this->render('gestion/annonceur/create_annonceur.html.twig', [
            'annonceurForm' => $form->createView()
        ]);
       
    }

    /**
     * Modifier un annonceur
     * @Route("/edit_annonceur/{id}", name="edit_annonceur")
     */
    public function editAnnonceur(EntityManagerInterface $manager, Annonceur $annonceur, Request $request)
    {
        $form = $this->createForm(AnnonceurFormType::class, $annonceur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->flush();

            $this->addFlash('success', 'L\'annonceur a été mis à jour.');

            return $this->redirectToRoute('gestion_annonceur');
        }

        return $this->render('gestion/annonceur/edit_annonceur.html.twig', [
            'annonceur' => $annonceur,
            'annonceurForm' => $form->createView()
        ]);
    }

    /**
     * Suppression d'un annonceur
     * @Route ("/remove_annonceur/{id}", name="remove_annonceur")
     * @IsGranted("ROLE_PROPRIETAIRE")
     */
    public function removeAnnonceur(Annonceur $annonceur, EntityManagerInterface $manager, Request $request)
    {
        // Récuparation du jeton csrf
        $token = $request->query->get('token');

        // Vérification de la validité de la clé 
        if ($this->isCsrfTokenValid('gestion_remove_annonceur', $token))
        {
            // Suppression
            $manager->remove($annonceur);
            $manager->flush();
        }
        // redirection
        return $this->redirectToRoute('gestion_annonceur');
    }

}
