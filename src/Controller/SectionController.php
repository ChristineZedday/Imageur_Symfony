<?php

namespace App\Controller;

use App\Entity\Section;
use App\Entity\Article;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use App\Repository\ArticleRepository;
use App\Repository\HomePageRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/section")
 */
class SectionController extends AbstractController
{
    /**
     * @Route("/", name="section_index", methods={"GET"})
     */
    public function index(SectionRepository $sectionRepository): Response
    {
        return $this->render('section/index.html.twig', [
            'sections' => $sectionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="section_new", methods={"GET","POST"})
     */
    public function new(Request $request, ImageRepository $imageRepository): Response
    {
        $section = new Section();
        $images = $imageRepository->findIllustrations();
      
      
    
        $form = $this->createForm(SectionType::class, $section, ['images' => $images]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();

            return $this->redirectToRoute('section_index');
        }

        return $this->render('section/new.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }


   


     /**
     * @Route("/article/{id}/new", name="new_section_article", methods={"GET","POST"})
     */
    public function newSectionArticle(Request $request, ArticleRepository $articleRepository, ImageRepository $imageRepository, Article $article): Response
    {
        $section = new Section();
        $images = $imageRepository->findIllustrations();

        $section->setArticle($article) ;
        
       
        $form = $this->createForm(SectionType::class, $section, ['images' => $images]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();

            return $this->redirectToRoute('article_show', ['id' =>$article->getId()]);
        }

        return $this->render('section/new.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}", name="section_show", methods={"GET"})
     */
    public function show(Section $section): Response
    {
        return $this->render('section/show.html.twig', [
            'section' => $section,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="section_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Section $section,   ImageRepository $imageRepository ): Response
    {
        $images = $imageRepository->findIllustrations();
        $form = $this->createForm(SectionType::class, $section,  [ 'images' => $images]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('section_index');
        }

        return $this->render('section/edit.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="section_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Section $section): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($section);
            $entityManager->flush();
        }

        return $this->redirectToRoute('section_index');
    }

      /**
     * @Route("section/genere/{id}", name="section_genere", methods={"GET"})
     */
    public function sectionGenere(Section $section)
    {
        $dir = $this->getParameter('generated_includes');
        $imgs = $this->getParameter('relatif_includes_petites_images_url').'/';
        $image = $this->getParameter('relatif_files_moyennes_images_url').'/';
        $section->genereSection($dir, $imgs, $image);

        return $this->redirectToRoute('section_index');
    }
}
