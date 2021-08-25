<?php

namespace App\Form;

use App\Entity\Freelancer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FreelancerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('competences', TextType::class, [
                'required' => false,
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'competences'
                ]
            ])
            ->add('adresse' , TextType::class, [
                'required' => false,
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'adresse'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Freelancer::class,
            'method' => 'get',
            'csrf_protection' => false 
               
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
