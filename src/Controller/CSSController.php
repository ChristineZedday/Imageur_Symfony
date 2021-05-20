<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Entity\CSS;
use App\Form\CSSType;
use App\Repository\ArticleRepository;
use App\Repository\CSSRepository;
use App\Service\CSSGenerator;
use App\Service\Generator;
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

    /**
     * @Route("css/copy/{id}", name="css_copy", methods={"GET"})
     */
    public function cssCopie(Generator $generator, CSS $css)
    {
        $generator->genereFile($css);

        return $this->redirectToRoute('css_show', array('id' => $css->getId()));
    }

    /**
     * @Route("css/articles/{id}", name="css_articles", methods={"GET"})
     */
    public function cssApplyArticles(ArticleRepository $articleRepository, CSS $css)
    {
        $articles = $articleRepository->findAll();
        foreach ($articles as $article) {
            foreach ($article->getCSS() as $oldcss) {
                $oldcss->removeArticle($article);
            }
            $css->addArticle($article);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("css/colors/{id}", name="css_colors", methods={"GET"})
     */
    public function ChangeColors(CSSGenerator $cssGenerator, CSS $css)
    {
        $cssGenerator->colorsScssGenere($css);

        return $this->redirectToRoute('css_show', array('id' => $css->getId()));
    }

      /**
     * @Route("css/fonts/{id}", name="css_fonts", methods={"GET"})
     */
    public function ChangeFonts(CSSGenerator $cssGenerator, CSS $css)
    {
        $cssGenerator->fontsScssGenere($css);

        return $this->redirectToRoute('css_show', array('id' => $css->getId()));
    }

       /**
     * @Route("css/duplicate/{id}", name="css_duplicate", methods={"GET"})
     */
    public function DuplicateStyle( CSS $css)
    {
        $newCSS = new CSS();
        $newCSS = clone $css;
        $newCSS->setNom('copie_'.$css->getNom()) ; 
        $em = $this->getDoctrine()->getManager();
$em->persist($newCSS);
$em->flush();
// $newCSS->setNom()= 'copie_'.$css->getNom(); 
// $em->flush();

        return $this->redirectToRoute('css_show', array('id' => $newCSS->getId()));
    }
   /**
     * @Route("css/structure/{id}", name="css_structure", methods={"GET"})
     */
    public function changeStructure(CSSGenerator $cssGenerator, CSS $css)
    {
        $cssGenerator->appScssGenere($css);
        return $this->redirectToRoute('css_show', array('id' => $css->getId()));
    }
}
