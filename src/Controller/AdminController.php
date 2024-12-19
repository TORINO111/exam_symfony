<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Niveau;
use App\Entity\Classe;
use App\Entity\Professeur;
use App\Form\CoursType;
use App\Form\NiveauType;
use App\Repository\CoursRepository;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use App\Repository\NiveauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    // Création d'un cours
    #[Route('/admin/cours/create', name: 'admin_cours_create')]
    public function createCours(Request $request): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cours);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cours_list');
        }

        return $this->render('admin/cours/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Liste des cours par classe
    #[Route('/admin/cours/classe/{classeId}', name: 'admin_cours_by_classe')]
    public function listByClasse(int $classeId, ClasseRepository $classeRepository, CoursRepository $coursRepository): Response
    {
        $classe = $classeRepository->find($classeId);
        $cours = $coursRepository->findByClasse($classe);

        return $this->render('admin/cours/list_by_classe.html.twig', [
            'classe' => $classe,
            'cours' => $cours,
        ]);
    }

    // Liste des cours par professeur
    #[Route('/admin/cours/professeur/{professeurId}', name: 'admin_cours_by_professeur')]
    public function listByProfesseur(int $professeurId, ProfesseurRepository $professeurRepository, CoursRepository $coursRepository): Response
    {
        $professeur = $professeurRepository->find($professeurId);
        $cours = $coursRepository->findByProfesseur($professeur);

        return $this->render('admin/cours/list_by_professeur.html.twig', [
            'professeur' => $professeur,
            'cours' => $cours,
        ]);
    }

    // Liste des cours par niveau
    #[Route('/admin/cours/niveau/{niveauId}', name: 'admin_cours_by_niveau')]
    public function listByNiveau(int $niveauId, NiveauRepository $niveauRepository, CoursRepository $coursRepository): Response
    {
        $niveau = $niveauRepository->find($niveauId);
        $cours = $coursRepository->findByNiveau($niveau);

        return $this->render('admin/cours/list_by_niveau.html.twig', [
            'niveau' => $niveau,
            'cours' => $cours,
        ]);
    }

    // Création d'un niveau
    #[Route('/admin/niveau/create', name: 'admin_niveau_create')]
    public function createNiveau(Request $request): Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveau);
            $entityManager->flush();

            return $this->redirectToRoute('admin_niveau_list');
        }

        return $this->render('admin/niveau/create_niveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Liste des niveaux
    #[Route('/admin/niveau/list', name: 'admin_niveau_list')]
    public function listNiveaux(NiveauRepository $niveauRepository): Response
    {
        $niveaux = $niveauRepository->findAll();

        return $this->render('admin/niveau/list.html.twig', [
            'niveaux' => $niveaux,
        ]);
    }
}