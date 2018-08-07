<?php

namespace App\Form;

use App\Entity\Supplier;
use App\Entity\SupplierStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;


class SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // dd($options['choices']);
        foreach ($options['choices'] as $opt){
            $choices[$opt->status_desc] = $opt->id;
        }
//        dump($options['custom']);
        $builder
            ->add('code')
            ->add('name')
            // ->add('status', EntityType::class,[
            //     'class' => SupplierStatus::class,
            //     'choice_label' => 'status_desc',
            //     'placeholder' => '-select status'
            // ])
            ->add('status',ChoiceType::class, [
                'choices'=> $choices,
                'placeholder' => '-select supplier',
                'constraints' => array(
                    new Assert\Type(array(
                        'type' => 'integer',
                        'message' => 'number lang dito'
                    ))
                ),
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
            'choices' => null,
        ]);
    }
}
