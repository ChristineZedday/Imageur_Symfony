<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
