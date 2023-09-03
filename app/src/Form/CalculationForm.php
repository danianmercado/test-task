<?php

namespace App\Form;

use App\Form\DataValidator\CalculationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product')
            ->add('taxNumber')
            ->add('couponCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculationType::class,
            'csrf_protection' => false
        ]);
    }
}
