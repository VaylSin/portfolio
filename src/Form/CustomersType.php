<?php

namespace App\Form;

use App\Entity\Tag;
use App\Form\ImageType;
use App\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CustomersType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {

        $builder
            ->add('name')
            ->add('url_project')
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}
