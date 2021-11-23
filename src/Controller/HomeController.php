<?php

/*
 * Imageur_symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Service\Generator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ExtensionCleaner;

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
     * @Route("site/genere/", name="site", methods={"GET"})
     */
    public function siteGenere(Generator $generator)
    {
        $generator->genereSite();

        return $this->redirectToRoute('home');
    }

     /**
     * @Route("/cleanExtensions", name="clean", methods={"GET"})
     */
public function cleanExtensions(ExtensionCleaner $extclean)
{
    
$extclean->cleanAllJPG();
return $this->redirectToRoute('image_index');
}
}
