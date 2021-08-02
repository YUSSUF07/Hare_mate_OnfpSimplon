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

    /**
     * @Route("/api", name="api", methods="Get")
     */

    public function api_g(SecteurRepository $secteurRepository): Response
    {
        return $this->json($secteurRepository->findAll(), 200, [], ['groups' => 'secteur:liste']);
    }

     /**
     * @Route("/api", name="api",)
     */

    public function api_p(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        try{
            $jsonRecu = $request->getContent();

            $secteur = $serializer->deserialize($jsonRecu, Secteur::class, 'json');
            
            $em->persist($secteur);
            $em->fflush;
            return $this->json($secteur, 200, [], ['groups' => 'secteur:liste']);
        }
       
        catch(NotEncodableValueException $e){
            return $this->json(['status' => 400,
            'message' => $e->getMessage()], 400);
        }
    }
}
