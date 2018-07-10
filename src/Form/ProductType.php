<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dd($options);
        $builder
            ->add('product_code')
            ->add('description');
        $builder
            ->add('supplier_id', ChoiceType::class, $options['suppliers'])
            ->add('product_status', ChoiceType::class,$options['suppstatus'])
            ->add('supplier_price')
            ->add('interest_rate')
            ->add('computed_price')
            ->add('online_price')
            ->add('img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'suppliers' => null,
            'suppstatus' => null,
        ]);
    }
}
