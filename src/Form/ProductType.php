<?php

namespace App\Form;
use App\Entity\Product;
use App\Entity\Supplier;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;



class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $options['suppliers'] = [
            'choices' => [
                '-select-' => '',
                'two' => 2,
                'one' => 1
            ]
        ];
        $builder
            ->add('product_code')
            ->add('description')
            ->add('supplier_id', EntityType::class, [
                'class' => Supplier::class,
//                'choice_label' => function(Supplier $supplier) {
//                    return $supplier->getName();
//                },
                'choice_label' => 'name',
                'placeholder' => '-select supplier-',
                'choice_value' => 'id'

//                'expanded' => true,
//                'multiple'=> true,
//            'sortable' => true
//                'constraints' => array(
//                    new Assert\Type(array(
//                        'type' => 'integer',
//                        'message' => 'number lang dito'
//                    ))
//                )
            ])

//            ->add('supplier_id', ChoiceType::class, $options['suppliers'])
            ->add('supplier_price')
            ->add('interest_rate')
            ->add('computed_price',TextType::class, [

                    'attr' => ['readonly' => 'readonly']

            ])
            ->add('online_price')
            ->add('img', FileType::class, [
                'label' => 'Select image',
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'image/jpg,image/jpeg',
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
//            'suppliers' => null,


        ]);
    }
}
