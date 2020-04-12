<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticPagesController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('static_pages/homepage.html.twig');
    }

    /**
     * @Route("/termeni-si-conditii-consultanta-online", name="app_terms")
     */
    public function terms()
    {
        return $this->render('static_pages/terms.html.twig');
    }
    
    /**
     * @Route("/consimtamant-de-prelucrare-a-datelor-cu-caracter-personal", name="app_gdpr")
     */
    public function gdpr()
    {
        return $this->render('static_pages/gdpr.html.twig');
    }
}
