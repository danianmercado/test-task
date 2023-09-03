<?php

namespace App\Form;

use App\Form\DataValidator\PayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PayForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product')
            ->add('taxNumber')
            ->add('couponCode')
            ->add('paymentProcessor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PayType::class,
            'csrf_protection' => false
        ]);
    }
}
