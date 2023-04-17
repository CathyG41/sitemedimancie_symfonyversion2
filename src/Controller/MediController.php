<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediController extends AbstractController
{
    /**
     * @Route("/medi", name="app_medi")
     */
    public function index(): Response
    {
        return $this->render('medi/index.html.twig', [
            'controller_name' => 'MediController',
        ]);
    }
}
