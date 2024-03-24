<?php

namespace App\Controller;

use App\Repository\PagosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PagosController extends AbstractController
{
    #[Route('/pagos', name: 'app_pagos')]
    public function index( PagosRepository $pagosRepository): Response
    {

        $pagos = $pagosRepository->findAll();
        return $this->render('pagos/index.html.twig', [
            'pagos' => $pagos,
        ]);
    }
}
