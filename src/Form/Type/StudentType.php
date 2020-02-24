<?php
namespace App\Form\Type;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class StudentType extends AbstractType
{

    public function __construct()
    {}
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id', NumberType::class)
        ->add('msisdn', NumberType::class)
        ->add('name', TextType::class)
        ->add('surname', TextType::class)
        ->add('age', NumberType::class)
        ->add('courseWorkScore', NumberType::class)
        ->add('finalScore', NumberType::class)
        ;
    }
    
    /* public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefault([
            'data_class' => User::class
            ]);
    } */
}

