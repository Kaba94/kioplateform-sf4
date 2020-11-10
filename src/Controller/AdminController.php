<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @Route("", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Liste des utilisateurs
     * @Route("/users", name="users")
     */
    public function usersList(UserRepository $users){
        return $this->render('admin/user.html.twig', [
            'users' => $users->findAll() 
        ]);

    }

    /**
     * Modifier un utilisateur
     * @Route("/edit_user/{id}", name="edit_user")
     */
    public function editUser(User $user, Request $request){
        $form = $this->createform(EditUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données de formulaire (entité User + mot de passe)
            $user = $form->getData();
            $this->manager->flush();

            $this->addFlash('message', 'Vos information on bien été modifiée !');
            return $this->redirectToRoute('admin_users');
        }
        return $this->render('admin/edit_user.html.twig', [
            'editUserForm' => $form->createView()
        ]);
    }
}
