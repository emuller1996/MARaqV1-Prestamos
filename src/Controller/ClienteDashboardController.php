<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClienteDashboardController extends AbstractController
{
    #[Route('/client/dashboard', name: 'app_cliente_dashboard')]
    public function index(): Response
    {
        return $this->render('cliente_dashboard/index.html.twig', [
            'controller_name' => 'ClienteDashboardController',
        ]);
    }
}
