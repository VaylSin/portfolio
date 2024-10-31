<?php

namespace App\Form;

use App\Entity\Customers;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}
