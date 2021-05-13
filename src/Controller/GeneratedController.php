<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeneratedController extends AbstractController
{
    /**
     * @Route("/generated", name="generated_index")
     */
    public function index(): Response
    {
        $url = $this->getParameter('generated_site_url');

        return new RedirectResponse($url);
    }
}
