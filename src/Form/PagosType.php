<?php

namespace App\Form;

use App\Entity\Pagos;
use App\Entity\Prestamos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PagosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', null, [
                'widget' => 'single_text'
            ])
            ->add('pago_interes')
            ->add('abono_capital')
            ->add('pago_total')
            ->add('prestamo', EntityType::class, [
                'class' => Prestamos::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pagos::class,
        ]);
    }
}
