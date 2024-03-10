<?php

namespace App\Controller\Api;

use App\Entity\Cliente;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/clientes', name: 'api_clientes')]
class ClienteApiController extends AbstractController
{


    #[Route('/', name: '_list', methods: ["GET"])]
    public function index(ClienteRepository $clienteRepository): JsonResponse
    {

        $result = $clienteRepository->findAll();

        $arr = [];
        foreach ($result as $key => $value) {
            $arr[] = [
                "nombre" => $value->getName(),
                "phone" => $value->getPhone(),
                "tipo_documento" => $value->getTypeDocument(),
                "numero_documento" => $value->getNumberDocument(),


            ];
        }

        return new JsonResponse($arr);
    }
}
