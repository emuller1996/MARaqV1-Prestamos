<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nombre'])
            ->add('phone', null, ['label' => 'Numero Telefonico'])
            ->add('typeDocument',  ChoiceType::class, [
                'label' => 'Tipo Documento',
                'choices'  => [
                    'CC ' => "CC ",
                    'TI' => "TI",
                    'CE' => "CE",
                    'PA' => "PA",
                ]
            ])
            ->add('numberDocument', null, ['label' => 'Numero Documneto'])
            ->add('address', null, ['label' => 'Dirrecion/Barrio'])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
