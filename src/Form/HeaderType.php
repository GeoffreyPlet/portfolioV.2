<?php

namespace App\Form;

use App\Entity\Header;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('image', FileType::class, [
                'mapped' => false,
            ])
            ->add('display', ChoiceType::class, [
                'label' => 'Disponible a la création ?',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Header::class,
        ]);
    }
}
