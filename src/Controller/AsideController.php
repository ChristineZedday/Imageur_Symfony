<?php

namespace App\Controller;

use App\Entity\Aside;
use App\Form\AsideType;
use App\Repository\AsideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aside")
 */
class AsideController extends AbstractController
{
    /**
     * @Route("/", name="aside_index", methods={"GET"})
     */
    public function index(AsideRepository $asideRepository): Response
    {
        return $this->render('aside/index.html.twig', [
            'asides' => $asideRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="aside_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aside = new Aside();
        $form = $this->createForm(AsideType::class, $aside);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aside);
            $entityManager->flush();

            return $this->redirectToRoute('aside_index');
        }

        return $this->render('aside/new.html.twig', [
            'aside' => $aside,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aside_show", methods={"GET"})
     */
    public function show(Aside $aside): Response
    {
        return $this->render('aside/show.html.twig', [
            'aside' => $aside,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aside_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Aside $aside): Response
    {
        $form = $this->createForm(AsideType::class, $aside);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aside_index');
        }

        return $this->render('aside/edit.html.twig', [
            'aside' => $aside,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aside_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Aside $aside): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aside->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aside);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aside_index');
    }

    
      /**
     * @Route("aside/genere/{id}", name="aside_genere", methods={"GET"})
     */
    public function asideGenere(Aside $aside)
    {
        $dir = $this->getParameter('generated_directory');
        $aside->genereAside($dir);

        return $this->redirectToRoute('aside_index');
    }
}
