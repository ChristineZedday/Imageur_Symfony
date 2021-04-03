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
use App\Entity\Metas;
use App\Entity\Footer;
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

     /**
     * @Route("footer/genere/", name="footer", methods={"GET"})
     */
    public function footerGenere()
    {
        $dir = $this->getParameter('generated_directory');
        $text1 = $this->getParameter('footerText1');
        $text2 = $this->getParameter('footerText2');
        $contact =  $this->getParameter('contact');
        $text= $text1.'<br/>'.$text2.'</p><p>contact: '.$contact.'</p>';
        $footer= new Footer();
        $footer->genereFooter($dir, $text);

        return $this->redirectToRoute('home');
    }
      /**
     * @Route("metas/genere/", name="metas", methods={"GET"})
     */
    public function metasGenere()
    {
        $dir = $this->getParameter('generated_directory');
        $metas= new Metas();
        $metas->genereMetas($dir);

        return $this->redirectToRoute('home');
    }
}
