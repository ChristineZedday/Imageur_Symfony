<?php

namespace App\Controller;

use App\Entity\Foot;
use App\Form\FootType;
use App\Repository\FootRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/foot")
 */
class FootController extends AbstractController
{
    /**
     * @Route("/", name="foot_index", methods={"GET"})
     */
    public function index(FootRepository $footRepository): Response
    {
        return $this->render('foot/index.html.twig', [
            'feet' => $footRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="foot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $foot = new Foot();
        $form = $this->createForm(FootType::class, $foot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($foot);
            $entityManager->flush();

            return $this->redirectToRoute('foot_index');
        }

        return $this->render('foot/new.html.twig', [
            'foot' => $foot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="foot_show", methods={"GET"})
     */
    public function show(Foot $foot): Response
    {
        return $this->render('foot/show.html.twig', [
            'foot' => $foot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="foot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Foot $foot): Response
    {
        $form = $this->createForm(FootType::class, $foot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foot_index');
        }

        return $this->render('foot/edit.html.twig', [
            'foot' => $foot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="foot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Foot $foot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($foot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('foot_index');
    }
}
