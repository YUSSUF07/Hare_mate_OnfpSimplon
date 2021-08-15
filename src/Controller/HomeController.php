<?php

namespace App\Controller;

use App\Repository\CompetencesRepository;
use App\Repository\SecteurRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    public function index(SecteurRepository $secteurRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'secteurs' => $secteurRepository->findAll(),
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
    
    
    public function free(UtilisateurRepository $utilisateurRepository): Response
    {
    
        return $this->render('home/free.html.twig', [
            'user' => $utilisateurRepository->findAll(), 
        ]);
    }
           
}
