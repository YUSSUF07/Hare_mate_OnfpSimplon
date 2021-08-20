<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Repository\SecteurRepository;
use App\Repository\CompetencesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    public function index(SecteurRepository $secteurRepository,CompetencesRepository $competencesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'secteurs' => $secteurRepository->findAll(),
            'free' => $competencesRepository->findAll(),
        ]);
    }

    #[Route("/home/profil", name:'profil')]
    public function prof(CompetencesRepository $competencesRepository): Response
    {
        return $this->render('home/profil.html.twig', [
            'competence' => $competencesRepository->findAll(),
        ]);
    }

    #[Route("/home/free", name:'free')]    
    public function free(): Response
    {
    
        return $this->render('home/free.html.twig', [
             
        ]);
    }
           
}
