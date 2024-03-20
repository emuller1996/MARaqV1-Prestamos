<?php

namespace App\Controller;

use App\Entity\Pagos;
use App\Entity\Prestamos;
use App\Form\PagosType;
use App\Form\PrestamoFormType;
use App\Repository\PrestamosRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestamosController extends AbstractController
{
    #[Route('/prestamos', name: 'app_prestamos_list')]
    public function index(PrestamosRepository $prestamosRepository): Response
    {

        $prestamos = $prestamosRepository->findAll();

        return $this->render('prestamos/index.html.twig', [
            'prestamos' => $prestamos,
        ]);
    }

    #[Route('/prestamos/new', name: 'app_prestamos_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        $prestamo = new Prestamos();
        // ...

        $form = $this->createForm(PrestamoFormType::class, $prestamo);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $prestamo = $form->getData();
            $prestamo->setPorcentajeInteres(10);
            $prestamo->setValorInteres($prestamo->getValorTotal() * 0.10);
            $prestamo->setEstado("PENDIENTE");
            $prestamo->setDeudaActual($prestamo->getValorTotal() + ($prestamo->getValorTotal() * 0.10));
            $em->persist($prestamo);
            $em->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_prestamos_list');
        }
        return $this->render('prestamos/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/prestamos/show/{id}', name: 'app_prestamos_show')]
    public function show(int $id, Request $request, EntityManagerInterface $em): Response
    {


        $prestamo = $em->getRepository(Prestamos::class)->find($id);
        $pagos = new Pagos();
        $pagos->setPagoInteres($prestamo->getValorInteres());
        $form = $this->createForm(PagosType::class, $pagos);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $pagos = $form->getData();
            $prestamo->addPago($pagos);
            $prestamo->setDeudaActual($prestamo->getDeudaActual() - $pagos->getPagoTotal());
            if ($prestamo->getDeudaActual() == 0) {
                $prestamo->setEstado("PAGADO");
            }

            $em->persist($pagos);
            $em->persist($prestamo);

            $em->flush();
            // ... perform some action, such as saving the task to the database
            return $this->redirectToRoute('app_prestamos_show', ["id" => $prestamo->getId()]);
        }

        return $this->render('prestamos/show.html.twig', [
            'prestamo' => $prestamo,
            'form' => $form,
        ]);
    }
}
