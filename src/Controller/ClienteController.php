<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\UserCliente;
use App\Form\ClienteType;
use App\Form\RegistrationFormType;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/d/clientes', name: 'app_cliente')]
class ClienteController extends AbstractController
{


    #[Route('/', name: '_list_page')]
    public function index(ClienteRepository $clienteRepository): Response
    {

        $clientes = $clienteRepository->findAll();
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
            'clientes' => $clientes
        ]);
    }

    #[Route('/edit/{id}', name: '_edit_page')]
    public function edit(Request $request, EntityManagerInterface $em, int $id,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $cliente = $em->getRepository(Cliente::class)->find($id);        // ...
        $form = $this->createForm(ClienteType::class, $cliente);
        $user = new UserCliente();
        $user->setUsername($cliente->getNumberDocument());

        $form2 = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        $form2->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cliente = $form->getData();
            $em->persist($cliente);
            $em->flush();
            // ... perform some action, such as saving the task to the database        
            return $this->redirectToRoute('app_cliente_list_page');
        }


        if ($form2->isSubmitted() && $form2->isValid()) {
            // encode the plain password
            $user->setCliente($cliente);
            $user->setRoles(["ROLE_CLIENTE"]);
            $user->setPassword(
                    $userPasswordHasher->hashPassword(
                    $user,
                    $form2->get('plainPassword')->getData()
                )
            );

            $em->persist($user);
            $em->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('app_cliente_list_page');
        }


        return $this->render('cliente/edit.html.twig', [
            'form' => $form,
            'form2' => $form2,
            'cliente' => $cliente
        ]);
    }

    #[Route('/new', name: '_new_page')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $cliente = new Cliente();
        // ...

        $form = $this->createForm(ClienteType::class, $cliente);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $cliente = $form->getData();
            $em->persist($cliente);
            $em->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_cliente_list_page');
        }
        return $this->render('cliente/new.html.twig', [
            'form' => $form,
        ]);
    }
}
