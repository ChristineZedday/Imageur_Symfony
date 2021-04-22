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
use App\Service\Generator;


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
        $dir = $this->getParameter('generated_includes');
        $nav= new Nav();
        $nav->genereNav($dir, $rubriqueRepository);
      
        return $this->redirectToRoute('home');
    }

     /**
     * @Route("footer/genere/", name="footer", methods={"GET"})
     */
    public function footerGenere()
    {
        $dir = $this->getParameter('generated_includes');
        $text1 = $this->getParameter('footerText1');
        $text2 = $this->getParameter('footerText2');
        $contact =  $this->getParameter('contact');
        $text= '<p>'.$text1.'<br/>'.$text2.'</p><p>contact: '.$contact.'</p>';
        $footer= new Footer();
        $footer->genereFooter($dir, $text);

        return $this->redirectToRoute('home');
    }
      /**
     * @Route("metas/genere/", name="metas", methods={"GET"})
     */
    public function metasGenere()
    {
        $dir = $this->getParameter('generated_includes');
        $metas= new Metas();
        $metas->genereMetas($dir);

        return $this->redirectToRoute('home');
    }

     /**
     * @Route("css/genere/", name="css", methods={"GET"})
     */
    public function cssCopie()
    {
        $dir = $this->getParameter('generated_css');
        $cop = copy ('build/app.css' , $dir.'/app.css' );

        return $this->redirectToRoute('home');
    }

    
     /**
     * @Route("site/genere/", name="site", methods={"GET"})
     */
    public function siteGenere(Generator $generator)
    {
       $generator->genereSite();

        return $this->redirectToRoute('home');
    }
}
