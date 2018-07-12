<?php

namespace App\Form;

use App\Entity\Supplier;
use App\Entity\SupplierStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dump($options['custom']);
        $builder
            ->add('code')
            ->add('name')
            ->add('status', EntityType::class,[
                'class' => SupplierStatus::class,
                'choice_label' => 'status_desc',
                'placeholder' => '-select status'
            ])
            ->add('contact_no')
            ->add('location')
//            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplier::class,
            'custom' => null,
        ]);
    }
}
