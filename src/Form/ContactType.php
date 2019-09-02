<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                    new Length(['max' => 30]),
                    new Regex(['pattern' => '/^[a-zA-Z]+(([\' -][a-zA-Z ])?[a-zA-Z]*)*$/',
                        'match' => true,
                        'message' => 'Your name cannot contain numbers or special characters '])
                ],
            ])
            ->add('email',EmailType::class,[
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8]),
                    new Length(['max' => 30]),
                    new Email([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                        'checkMX' => true,
                    ]),
                ],
            ])
            ->add('message',TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                    new Length(['max' => 250]),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
