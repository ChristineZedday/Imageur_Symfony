<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\AdressRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image")
 */
class ImageController extends AbstractController
{
    /**
     * @Route("/", name="image_index", methods={"GET"})
     */
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="image_new", methods={"GET","POST"})
     */
    public function new(Request $request, AdressRepository $adressRepository): Response
    {
        $thumbs = $adressRepository->findOnebyName('vignette')->getPhysique();
        $grandes = $adressRepository->findOneByName('grandes_images')->getPhysique();
        $autres = $adressRepository->findOneByName('moyennes_images')->getPhysique();
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('image')->getData();
            $nom = $form->get('nom')->getData();
            if (null !== $nom) {
                $fichier = $nom.'.'.$photo->guessExtension();
            } else {
                $fichier = $form->get('image')->getData()->getClientOriginalName();
            }
            $image->setNom($fichier);

            if ('carrousel' === $form->get('pour')->getData()) {
                $dossier = $grandes;
            } else {
                $dossier = $autres;
            }

            // On copie le fichier dans le dossier images du site

            $photo->move($dossier, $fichier);
           
            if (null !== $form->get('vignette') && null !== $form->get('vignette')->getData()) {
               
                $vignette = $form->get('vignette')->getData();
                $vignette->move($thumbs, $fichier);
              
                $image->setVignette(true);
            }
            else {
                if ('carrousel' === $form->get('pour')) {
                   copy($dossier.$fichier, $thumbs.$fichier);
                }
            }     

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('image_index');
        }

        return $this->render('image/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_show", methods={"GET"})
     */
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdressRepository $adressRepository, Image $image): Response
    {
        $thumbs = $this->getParameter('thumbs_directory');

        $form = $this->createForm(ImageType::class, $image);
        $ancien = $image->getNom();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              
            if (\array_key_exists('vignette', $_POST)) {
              
                $vignette->move(
                    $thumbs,
                    $image->getNom()
                );
                $image->setVignette(true);
            }

            if ($_POST['image']['nom'] !== $ancien) {
               
              $this->rename($image, $ancien, $_POST['image']['nom'], $adressRepository);
               
            }
            $this->getDoctrine()->getManager()->flush();



            return $this->redirectToRoute('image_show',  array('id' => $image->getId()));
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Image $image, AdressRepository $adressRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $thumbs = $adressRepository->findOnebyName('vignette')->getPhysique();
            $grandes = $adressRepository->findOneByName('grandes_images')->getPhysique();
            $autres = $adressRepository->findOneByName('moyennes_images')->getPhysique();
            if ($image->getPour() === 'carrousel') {
                @unlink($grandes.$image->getNom());
                @unlink($thumbs.$image->getNom());
            }
            else {
                @unlink($autres.$image->getNom());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
            //et effacer le fichier et vignette
        }

        return $this->redirectToRoute('image_index');
    }

      
    private function rename( Image $image, String $ancien, String $nouveau, AdressRepository $adressRepository )
    {
        $thumbs = $adressRepository->findOnebyName('vignette')->getPhysique();
        $grandes = $adressRepository->findOneByName('grandes_images')->getPhysique();
        $autres = $adressRepository->findOneByName('moyennes_images')->getPhysique();
     
           
           if ($image->getPour() === 'illustration') {
           
            rename($autres.$ancien,$autres.$nouveau);
           }
           else {
            rename($grandes.$ancien,$grandes.$nouveau); 
            if ($image->getVignette() === true){
            rename($thumbs.$ancien,$thumbs.$nouveau);   }
           }
  
}

}
