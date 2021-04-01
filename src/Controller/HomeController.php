<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nav;
use App\Repository\RubriqueRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
      /**
     * @Route("nav/genere/", name="nav", methods={"GET"})
     */
    public function navGenere(RubriqueRepository $rubriqueRepository)
    {
        $dir = $this->getParameter('generated_directory');
        $nav= new Nav();
        $nav->genereNav($dir, $rubriqueRepository);

        return $this->redirectToRoute('home');
    }
}
