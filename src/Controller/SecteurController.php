<?php

namespace App\Controller;

use App\Repository\SecteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecteurController extends AbstractController
{
    #[Route('/secteur', name: 'secteur')]
    public function index(SecteurRepository $secteurRepository): Response
    {
        $secteur = $secteurRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'SecteurController',
        ]);
    }
}
