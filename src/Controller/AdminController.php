<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Plateform;
use App\Entity\Resultat;
use App\Entity\User;
use App\Form\EditUserFormType;
use App\Form\SearchForm;
use App\Repository\ResultatRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Seule le Super admin aura accés à ces routes
 * @IsGranted("ROLE_SUPERADMIN")
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(ResultatRepository $repository)
    {
        $dates = $repository->countByDate();
        $resultats = $repository->findAll();

        $date = [];
        $volume = [];
        $volumeEnvoye = [];
        // $prixRouteur = [];
        // $resultatShoot = [];
        // $rem = [];



        foreach( $dates as $d ){
            $date[] = $d['dateResultat'];
        }
        
        foreach($resultats as $res){
            $volume[] = $res->getShoot()->getVolume();
            $volumeEnvoye[] = $res->getVolumeEnvoye();
            // $prixRouteur[] = $res->getShoot()->getPrestation()->getPrix();
            // $resultatShoot[] = $res->getResultat();
            // $rem[] = $res->getShoot()->getCampagne()->getRemuneration();
            

        }


        return $this->render('admin/index.html.twig', [
            'date' => json_encode($date),
            'volume' => json_encode($volume),
            'volumeEnvoye' => json_encode($volumeEnvoye),
            // 'prixRouteur' => json_encode($prixRouteur),
            // 'resultatShoot' => json_encode($resultatShoot),
            // 'rem' => json_encode($rem),

        ]);
    }

    /**
     * Liste des utilisateurs
     * @Route("/users", name="users")
     */
    public function usersList(UserRepository $users)
    {
        return $this->render('admin/user.html.twig', [
            'users' => $users->findAll()
        ]);
    }

    /**
     * Modifier un utilisateur
     * @ParamConverter("plateform", options={"id" = "plateform_id"})
     * @Route("/edit_user/{id}", name="edit_user")
     */
    public function editUser(User $user, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createform(EditUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User)
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Les informations on bien été modifiées !');
            return $this->redirectToRoute('admin_users');
        }
        return $this->render('admin/edit_user.html.twig', [
            'editUserForm' => $form->createView()
        ]);
    }

    /**
     * Resultat Mensuel
     * @Route("/resultat_mensuel", name="resultat_mensuel")
     */
    public function resultatMonth(ResultatRepository $resultatRepository, Request $request)
    {

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $resultats = $resultatRepository->findbyMonth($data);

        return $this->render('admin/resultat_mensuel.html.twig', [
            'resultats' => $resultats,
            'form' => $form->createView()
        ]);
    }

    /**
     * Resultat Mensuel
     * @Route("/resultat_journalier", name="resultat_journalier")
     */
    public function resultatDay(ResultatRepository $resultatRepository, Request $request)
    {

        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $resultats = $resultatRepository->findbyDay($data);

        return $this->render('admin/resultat_journalier.html.twig', [
            'resultats' => $resultats,
            'form' => $form->createView()
        ]);
    }
}
