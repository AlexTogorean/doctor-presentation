<?php

namespace App\Form;

use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('email', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ]
            ])
            ->add('phone', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('message')
            ->add('acceptTerms', CheckboxType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('acceptGdpr', CheckboxType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
