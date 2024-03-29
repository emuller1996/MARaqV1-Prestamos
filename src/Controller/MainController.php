<?php

namespace App\Controller;

use App\Entity\Cliente;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MainController extends AbstractController
{


    #[Route('/', name: 'app_index_main')]
    public function index_main(EntityManagerInterface $em): Response
    {


        $total = $em->getRepository(Cliente::class)->findAll();

        return $this->render('index.main.html.twig', [
            "total_clientes" =>  count($total)
        ]);
    }

    #[Route('/d/home', name: 'app_index')]
    public function index_mains(EntityManagerInterface $em): Response
    {


        $total = $em->getRepository(Cliente::class)->findAll();

        return $this->render('index.html.twig', [
            "total_clientes" =>  count($total)
        ]);
    }
}
