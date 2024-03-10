<?php

namespace App\Entity;

use App\Repository\PrestamosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestamosRepository::class)]
class Prestamos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $valorTotal = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaPrestamo = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $porcentajeInteres = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $valorInteres = null;

    #[ORM\Column(length: 20)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $deudaActual = null;

    #[ORM\Column(nullable: true)]
    private ?int $diaPago = null;

    #[ORM\ManyToOne(inversedBy: 'prestamos')]
    private ?Cliente $cliente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValorTotal(): ?string
    {
        return $this->valorTotal;
    }

    public function setValorTotal(string $valorTotal): static
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    public function getFechaPrestamo(): ?\DateTimeInterface
    {
        return $this->fechaPrestamo;
    }

    public function setFechaPrestamo(\DateTimeInterface $fechaPrestamo): static
    {
        $this->fechaPrestamo = $fechaPrestamo;

        return $this;
    }

    public function getPorcentajeInteres(): ?string
    {
        return $this->porcentajeInteres;
    }

    public function setPorcentajeInteres(string $porcentajeInteres): static
    {
        $this->porcentajeInteres = $porcentajeInteres;

        return $this;
    }

    public function getValorInteres(): ?string
    {
        return $this->valorInteres;
    }

    public function setValorInteres(string $valorInteres): static
    {
        $this->valorInteres = $valorInteres;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getDeudaActual(): ?string
    {
        return $this->deudaActual;
    }

    public function setDeudaActual(string $deudaActual): static
    {
        $this->deudaActual = $deudaActual;

        return $this;
    }

    public function getDiaPago(): ?int
    {
        return $this->diaPago;
    }

    public function setDiaPago(?int $diaPago): static
    {
        $this->diaPago = $diaPago;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }
}
