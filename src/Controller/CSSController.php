<?php

namespace App\Controller;

use App\Entity\CSS;
use App\Form\CSSType;
use App\Repository\CSSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/c/s/s")
 */
class CSSController extends AbstractController
{
    /**
     * @Route("/", name="css_index", methods={"GET"})
     */
    public function index(CSSRepository $cSSRepository): Response
    {
        return $this->render('css/index.html.twig', [
            'csses' => $cSSRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="css_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cSS = new CSS();
        $form = $this->createForm(CSSType::class, $cSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cSS);
            $entityManager->flush();

            return $this->redirectToRoute('css_index');
        }

        return $this->render('css/new.html.twig', [
            'css' => $cSS,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="css_show", methods={"GET"})
     */
    public function show(CSS $cSS): Response
    {
        return $this->render('css/show.html.twig', [
            'css' => $cSS,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="css_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CSS $cSS): Response
    {
        $form = $this->createForm(CSSType::class, $cSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('css_index');
        }

        return $this->render('css/edit.html.twig', [
            'css' => $cSS,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="css_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CSS $cSS): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cSS->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cSS);
            $entityManager->flush();
        }

        return $this->redirectToRoute('css_index');
    }
}
