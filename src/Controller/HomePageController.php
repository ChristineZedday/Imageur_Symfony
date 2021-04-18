<?php

namespace App\Controller;

use App\Entity\HomePage;
use App\Form\HomePageType;
use App\Repository\HomePageRepository;
use App\Repository\AdressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Generator;
use App\Service\Includor;


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

//     public function newGenerator(Generator $generator): Response
// {
//     // thanks to the type-hint, the container will instantiate a
//     // new MessageGenerator and pass it to you!
//     // ...

//     $this->addFlash('success', 'oui');
//     // ...
// }

      /**
     * @Route("home/genere/{id}", name="home_page_genere", methods={"GET"})
     */
    public function homePageGenere(Generator $generator, Includor $includor, HomePage $home, AdressRepository $adressRepository)
    {
      
      
        $generator->genereFileHomePage($home, $home, $adressRepository);
    //    $dir = $this->getParameter('generated_directory');
    //    $path = $dir.'/index.php';
       
    //     $auteur =  $this->getParameter('author');
    //    $includes = $this->getParameter('generated_includes');
    //     $image = $this->getParameter('relatif_files_moyennes_images_url').'/';
      
    //     $home->genereHomePage($dir, $includes, $image, $auteur);
   

    $rel_includes = '/fichiers';
   
    $articleFile = fopen($path, 'w');

    fwrite($articleFile, '<!DOCTYPE html><html lang="fr"><head><title>'.$this->getTitre().'</title>');
    fwrite($articleFile, '<meta name="author" content="'.$auteur.'" />');
    fwrite($articleFile, '<meta name="description" content="'.$this->getDescription().'"/>');
    fwrite($articleFile, '<meta name="keywords" content="'.$this->getKeywords().'"/>');
//     $metas = new Metas();
//     $includor = new Includor($container);
//    $includor->includeFileHomepage($this, $metas);
 fwrite($articleFile, '</head><body><div id = "conteneur">');
    if (file_exists($includes.'/sommaire.php'))
    { fwrite($articleFile, '<div><?php include(\''.$rel_includes.'sommaire.php\'); ?></div>');}
    fwrite($articleFile, '<div class="element" id="main"><article class="contenu">');
    fwrite($articleFile, '<h1>'.$this->getTitre().'</h1>');
  
  fwrite($articleFile, $this->getContenu());
  

  if (!file_exists($includes.'/footer.php'))
    {
        $footer = new Footer();
        $footer->genereFooter($includes,'');}
        fwrite($articleFile, '<?php include(\''.$rel_includes.'footer.php\'); ?>');

    fwrite($articleFile, '</article></div>');
   if ($this->GetAside())
    {
        fwrite($articleFile, '<div class=element id="acote">'); 
        if (file_exists($includes.'/aside_'.$this->getAside()->getNom().'.php'))
        {
            fwrite($articleFile, '<?php include(\''.$rel_includes.'aside_'.$this->getAside()->getNom().'.php\'); ?>');
        }
        fwrite($articleFile, '</div>');   
    }
    fwrite($articleFile, '</div>');   
    fwrite($articleFile, '</body></html>');
    fclose($articleFile);
    

        return $this->redirectToRoute('home_page_index');
    }
}
