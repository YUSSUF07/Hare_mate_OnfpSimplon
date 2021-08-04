<?php

namespace App\Controller;

use App\Repository\SecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    public function index(SecteurRepository $secteurRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'secteurs' => $secteurRepository->findAll(),
        ]);
    }

     #[Route('/recherche_demande', name:'acceuil')]
    public function user(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('home/recherche_demande.html.twig', [
            'utilisateurs' => $utilisateurRepository->findAll(),
        ]);
    }
}
