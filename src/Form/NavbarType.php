<?php

namespace App\Form;

use App\Entity\Navbar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NavbarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du site',
            ])
            ->add('logo', FileType::class, [
                'label' => 'Logo du site',
                'mapped' => false,
                'help' => 'Choisir un logo annule le nom du site.'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Navbar::class,
        ]);
    }
}
