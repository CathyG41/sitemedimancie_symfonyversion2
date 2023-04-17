<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrecommandeController extends AbstractController
{
    /**
     * @Route("/precommande", name="app_precommande")
     */
    public function index(): Response
    {
        return $this->render('precommande/index.html.twig', [
            'controller_name' => 'PrecommandeController',
        ]);
    }
}
