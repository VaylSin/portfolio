<?php

namespace App\Form;

use App\Entity\Customers;
use App\Entity\Image;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'label' => 'Image (JPEG, PNG file)',
                'mapped' => false,
                'required' => false,
            ])
            ->add('Alt')
            ->add('Title')
            // ->add('customers', EntityType::class, [
            //     'class' => Customers::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('Customers', EntityType::class, [
            //     'class' => Customers::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('projects', EntityType::class, [
            //     'class' => Project::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            // ->add('Project', EntityType::class, [
            //     'class' => Project::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
