<?php

namespace App\Entity;

use App\Repository\PagosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagosRepository::class)]
class Pagos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $pago_interes = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $abono_capital = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 0)]
    private ?string $pago_total = null;

    #[ORM\ManyToOne(inversedBy: 'pagos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Prestamos $prestamo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPagoInteres(): ?string
    {
        return $this->pago_interes;
    }

    public function setPagoInteres(string $pago_interes): static
    {
        $this->pago_interes = $pago_interes;

        return $this;
    }

    public function getAbonoCapital(): ?string
    {
        return $this->abono_capital;
    }

    public function setAbonoCapital(string $abono_capital): static
    {
        $this->abono_capital = $abono_capital;

        return $this;
    }

    public function getPagoTotal(): ?string
    {
        return $this->pago_total;
    }

    public function setPagoTotal(string $pago_total): static
    {
        $this->pago_total = $pago_total;

        return $this;
    }

    public function getPrestamo(): ?Prestamos
    {
        return $this->prestamo;
    }

    public function setPrestamo(?Prestamos $prestamo): static
    {
        $this->prestamo = $prestamo;

        return $this;
    }
}
