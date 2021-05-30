<?php

namespace App\Controller;

use App\Entity\Alumne;
use App\Form\AlumneType;
use App\Repository\AlumneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/alumne')]
class AlumneController extends AbstractController
{
    #[Route('/', name: 'alumne_index', methods: ['GET'])]
    public function index(AlumneRepository $alumneRepository): Response
    {
        return $this->render('alumne/index.html.twig', [
            'alumnes' => $alumneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'alumne_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $alumne = new Alumne();
        $form = $this->createForm(AlumneType::class, $alumne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alumne);
            $entityManager->flush();

            return $this->redirectToRoute('alumne_index');
        }

        return $this->render('alumne/new.html.twig', [
            'alumne' => $alumne,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'alumne_show', methods: ['GET'])]
    public function show(Alumne $alumne): Response
    {
        return $this->render('alumne/show.html.twig', [
            'alumne' => $alumne,
        ]);
    }

    #[Route('/{id}/edit', name: 'alumne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alumne $alumne): Response
    {
        $form = $this->createForm(AlumneType::class, $alumne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumne_index');
        }

        return $this->render('alumne/edit.html.twig', [
            'alumne' => $alumne,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'alumne_delete', methods: ['POST'])]
    public function delete(Request $request, Alumne $alumne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alumne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($alumne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('alumne_index');
    }
}