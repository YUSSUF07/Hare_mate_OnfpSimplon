<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Form\CompetencesType;
use App\Repository\CompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Competences')]
class CompetencesController extends AbstractController
{
    #[Route('/', name: 'competences_index', methods: ['GET'])]
    public function index(CompetencesRepository $competencesRepository): Response
    {
        return $this->render('competences/index.html.twig', [
            'competence' => $competencesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'competences_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competences);
            $entityManager->flush();

            return $this->redirectToRoute('profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competences/new.html.twig', [
            'competence' => $competences,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'competences_show', methods: ['GET'])]
    public function show(Competences $competences): Response
    {
        return $this->render('competences/show.html.twig', [
            'competence' => $competences,
        ]);
    }

    #[Route('/{id}/edit', name: 'competences_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competences $competences): Response
    {
        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('competences_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competences/edit.html.twig', [
            'competence' => $competences,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'competences_delete', methods: ['POST'])]
    public function delete(Request $request, Competences $competences): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competences->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competences);
            $entityManager->flush();
        }

        return $this->redirectToRoute('competences_index', [], Response::HTTP_SEE_OTHER);
    }
}
