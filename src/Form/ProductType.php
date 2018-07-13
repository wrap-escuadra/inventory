<?php

namespace App\Form;
use App\Entity\Product;
use App\Entity\Supplier;

use PhpParser\Node\Expr\Cast\Int_;
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
        foreach ($options['choices'] as $opt){
            $choices[$opt->name] = $opt->id;
        }
//dd($builder);
        $builder
            ->add('product_code')
            ->add('description')
//            ->add('supplier_id', EntityType::class, [
//                'class' => Supplier::class,
//                'choice_label' => 'name',
//                'choice_value' => 'id',
//                'placeholder' => '-select supplier-',
//                'constraints' => array(
//                    new Assert\Type(array(
//                        'type' => 'integer',
//                        'message' => 'number lang dito'
//                    ))
//                )
//            ])
            ->add('supplier_id',ChoiceType::class, [
                'choices'=> $choices,
                'placeholder' => '-select supplier',
                'constraints' => array(
                    new Assert\Type(array(
                        'type' => 'integer',
                        'message' => 'number lang dito'
                    ))
                ),
            ])
            ->add('supplier_price')
            ->add('interest_rate')
            ->add('computed_price',TextType::class, [
                    'attr' => ['readonly' => 'readonly']
            ])
            ->add('online_price')
            ->add('img', FileType::class, [
                'data_class' => null,
                'label' => 'Select image',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'image/jpg,image/jpeg, image/png',
                ]
            ]);

    }





    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'choices' => null,
        ]);
    }
}
