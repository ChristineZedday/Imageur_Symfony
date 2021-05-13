<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Entity\Javascript;
use App\Form\JavascriptType;
use App\Repository\ArticleRepository;
use App\Repository\JavascriptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/javascript")
 */
class JavascriptController extends AbstractController
{
    /**
     * @Route("/", name="javascript_index", methods={"GET"})
     */
    public function index(JavascriptRepository $javascriptRepository): Response
    {
        return $this->render('javascript/index.html.twig', [
            'javascripts' => $javascriptRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="javascript_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $javascript = new Javascript();
        $form = $this->createForm(JavascriptType::class, $javascript);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($javascript);
            $entityManager->flush();

            return $this->redirectToRoute('javascript_index');
        }

        return $this->render('javascript/new.html.twig', [
            'javascript' => $javascript,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="javascript_show", methods={"GET"})
     */
    public function show(Javascript $javascript): Response
    {
        return $this->render('javascript/show.html.twig', [
            'javascript' => $javascript,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="javascript_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Javascript $javascript): Response
    {
        $form = $this->createForm(JavascriptType::class, $javascript);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('javascript_index');
        }

        return $this->render('javascript/edit.html.twig', [
            'javascript' => $javascript,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="javascript_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Javascript $javascript): Response
    {
        if ($this->isCsrfTokenValid('delete'.$javascript->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($javascript);
            $entityManager->flush();
        }

        return $this->redirectToRoute('javascript_index');
    }

    /**
     * @Route("javascript/articles/{id}", name="javascript_articles", methods={"GET"})
     */
    public function javascriptApplyArticles(ArticleRepository $articleRepository, Javascript $js)
    {
        $articles = $articleRepository->findAll();
        foreach ($articles as $article) {
            $js->addArticle($article);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('javascript_index');
    }
}
