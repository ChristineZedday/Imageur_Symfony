<?php

namespace App\Controller;

use App\Entity\HomePage;
use App\Form\HomePageType;
use App\Repository\HomePageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home/page")
 */
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page_index", methods={"GET"})
     */
    public function index(HomePageRepository $homePageRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'home_pages' => $homePageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="home_page_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $homePage = new HomePage();
        $form = $this->createForm(HomePageType::class, $homePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($homePage);
            $entityManager->flush();

            return $this->redirectToRoute('home_page_index');
        }

        return $this->render('home_page/new.html.twig', [
            'home_page' => $homePage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="home_page_show", methods={"GET"})
     */
    public function show(HomePage $homePage): Response
    {
        return $this->render('home_page/show.html.twig', [
            'home_page' => $homePage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="home_page_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HomePage $homePage): Response
    {
        $form = $this->createForm(HomePageType::class, $homePage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_page_index');
        }

        return $this->render('home_page/edit.html.twig', [
            'home_page' => $homePage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="home_page_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HomePage $homePage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homePage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($homePage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_page_index');
    }

      /**
     * @Route("home/genere/{id}", name="home_page_genere", methods={"GET"})
     */
    public function homePageGenere(HomePage $home)
    {
       $dir = $this->getParameter('generated_directory');
       
        $auteur =  $this->getParameter('author');
       $includes = $this->getParameter('generated_includes');
        $image = $this->getParameter('relatif_files_moyennes_images_url').'/';
      
        $home->genereHomePage($dir, $includes, $image, $auteur);

        return $this->redirectToRoute('home_page_index');
    }
}
