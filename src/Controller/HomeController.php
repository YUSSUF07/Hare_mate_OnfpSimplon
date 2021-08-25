<?php

namespace App\Controller;

use App\Entity\Freelancer;
use App\Form\FreelancerType;
use App\Repository\SecteurRepository;
use App\Repository\CompetencesRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function free(CompetencesRepository $competencesRepository,Request $request): Response
    {
        $search = new Freelancer();
        $form = $this->createForm(FreelancerType::class, $search);
        $form->handleRequest($request);
        
        return $this->render('home/free.html.twig', [
            'competences' => $competencesRepository->findAll($search),
            'form' => $form->createView()
        ]);
    }
           
}
