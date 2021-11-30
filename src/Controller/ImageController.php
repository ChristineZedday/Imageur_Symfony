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
use App\Service\ExtensionCleaner;


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
    public function new(Request $request, AdressRepository $adressRepository, ExtensionCleaner $extensionCleaner): Response
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
            $ext = $photo->guessExtension();
            if (null !== $nom) {
                if (count(explode('.',$nom))=== 1) {
                $fichier = $nom.'.'.$ext; //pas d'extension donnée
                }
                else {
                    $fichier = $nom;    //y avait une ext
                }

            } else {
                $fichier = $form->get('image')->getData()->getClientOriginalName();
            }
          

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
              
            }
            else {
                if ('carrousel' === $form->get('pour')) {
                   copy($dossier.$fichier, $thumbs.$fichier);
                }
            }    
            
            $nom = $extensionCleaner->cleanJPG($dossier,$fichier);
            $image->setNom($nom);

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
        $extension = explode('.',$ancien);
        $extension = $extension[1];
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              
          

            if ($_POST['image']['nom'] !== $ancien) {
            
               if (count(explode('.', $_POST['image']['nom'])) > 1) {
                  
                $nouveau = $_POST['image']['nom'];
               }//si j'ai laissé l'extension en renommant...
               else {
                $nouveau = $_POST['image']['nom'].'.'.$extension;
               }
               $this->rename($image, $ancien, $nouveau,$adressRepository);
               
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
            rename($thumbs.$ancien,$thumbs.$nouveau);   
           }
           $image->setNom($nouveau);
  
}

    /**
     * @Route("/clean/extensions", name="image_clean", methods={"GET"})
     */
public function cleanExtBase(ImageRepository $imageRepository) 
{
    $images= $imageRepository->FindAll();
    foreach ($images as $image) {
    $tableau = explode('.', $image->getNom());
    $nom = $tableau[0];
    if (count($tableau)>1)
    {
            $ext = $tableau[1];
            
            switch($ext) {
                case 'JPG':
                case 'JPEG':
                case 'jpeg':
                    $image->setNom($nom.'.jpg');
                    break;
                case  'PNG':
                    $image->setNom($nom.'.png');
                    break;
                
                    break;
                case  'GIF':
                    $image->setNom($nom.'.gif');
                
                    break;
                default:
                break;
            }
            }	
            else{
                $image->setNom($nom.'.jpg');
            }
        }
        $entityManager = $this->getDoctrine()->getManager();$entityManager->flush();
        return $this->redirectToRoute('image_index');
} 

}
