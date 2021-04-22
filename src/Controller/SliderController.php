<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use App\Entity\Slider;
use App\Form\SliderType;
use App\Repository\ImageRepository;
use App\Repository\SliderRepository;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Generator;

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
    public function new(Request $request, SectionRepository $sectionRepository): Response
    {
        $slider = new Slider();

        

        $form = $this->createForm(SliderType::class, $slider);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($slider);
            $entityManager->flush();

           

            return $this->redirectToRoute('slider_edit', ['id' => $slider->getId()]);
        }

        return $this->render('slider/new.html.twig', [
            'slider' => $slider,
            'form' => $form->createView(),
           
        ]);
    }

    /**
     * @Route("/{slider}/remove", name="slider_remove_images")
     */
    public function removeImages(Request $request, Slider $slider, ImageRepository $imageRepository)
    {
        $images = $request->get('images');
        foreach ($images as $image) {
            $image = $imageRepository->find($image);
            $slider->removeImage($image);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($slider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('slider_edit', ['id' => $slider->getId()]);
    }

    /**
     * @Route("/{slider}/add", name="slider_add_images")
     */
    public function addImages(Request $request, Slider $slider, ImageRepository $imageRepository)
    {
        $images = $request->get('images');
        foreach ($images as $image) {
            $image = $imageRepository->find($image);
            $slider->addImage($image);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($slider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('slider_edit', ['id' => $slider->getId()]);
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
        $images = $imageRepository->findDispo($slider);
       
        $form = $this->createForm(SliderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @Route("slider/genere/{id}", name="slider_genere", methods={"GET"})
     */
    public function sliderGenere(Generator $generator, Slider $slider)
    {
        $generator->genereFile($slider);

        return $this->redirectToRoute('slider_index');
    }
}
