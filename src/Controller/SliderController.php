<?php

namespace App\Controller;

use App\Entity\Slider;
use App\Entity\Image;
use App\Form\SliderType;
use App\Repository\SliderRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;


/**
 * @Route("/slider")
 */
class SliderController extends AbstractController
{
    /**
     * @Route("/", name="slider_index", methods={"GET"})
     */
    public function index(SliderRepository $sliderRepository): Response
    {
        return $this->render('slider/index.html.twig', [
            'sliders' => $sliderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="slider_new", methods={"GET","POST"})
     */
    public function new(Request $request, ImageRepository $imageRepository): Response
    {
        $slider = new Slider();

        $images = $imageRepository->findAll();

        $form = $this->createForm(SliderType::class, $slider, ['images'=> $images]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($slider);
            $entityManager->flush();

            $images = $form->get('images')->getData();
            foreach ( $images as $image)
            {
                $image = $imageRepository->find($image);
                $slider->addImage($image);
            }

            $entityManager->flush();

            return $this->redirectToRoute('slider_index');
        }

        return $this->render('slider/new.html.twig', [
            'slider' => $slider,
            'form' => $form->createView(),
            'images' => $images,
        ]);
    }
     /**
     * @Route("/{slider}/remove/{image}", name="slider_remove_image")
     */
    public function removeImage (Request $request, Slider $slider,Image $image)
    {
       $slider->removeImage($image);
       $entityManager = $this->getDoctrine()->getManager();
       $entityManager->persist($slider);
       $entityManager->flush();
       return $this->redirectToRoute('slider_index');
    }
   

    /**
     * @Route("/{id}", name="slider_show", methods={"GET"})
     */
    public function show(Slider $slider): Response
    {
        return $this->render('slider/show.html.twig', [
            'slider' => $slider,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="slider_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Slider $slider, ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        $form = $this->createForm(SliderType::class, $slider, ['images'=> $images]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $images = $form->get('images')->getData();
            foreach ( $images as $image)
            {
                $image = $imageRepository->find($image);
                $slider->addImage($image);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('slider_index');
        }

        return $this->render('slider/edit.html.twig', [
            'slider' => $slider,
            'form' => $form->createView(),
            'images' => $images,
        ]);
    }

    /**
     * @Route("/{id}", name="slider_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Slider $slider): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slider->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($slider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('slider_index');
    }
}
