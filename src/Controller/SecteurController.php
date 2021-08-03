<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

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
