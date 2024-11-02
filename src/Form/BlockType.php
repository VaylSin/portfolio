<?php

namespace App\Form;

use App\Entity\Block;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;

class BlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $validationGroups = $options['validation_groups'];
        if ($validationGroups instanceof \Closure) {
            $validationGroups = $validationGroups($builder->getForm());
        }

        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Texte' => 'text',
                    'Image' => 'image',
                    'Image + texte' => 'image_text',
                    'Texte + image' => 'text_image',
                    'Image ronde + texte en dessous' => 'rounded_pic_text_below',
                    // Ajoutez d'autres types de blocs ici
                ],
                'placeholder' => 'Sélectionnez un type de bloc',
            ]);

        if (in_array('text', $validationGroups)) {
            $builder->add('textContent', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-text'],
            ]);
        }

        if (in_array('image', $validationGroups)) {
            $builder->add('imageContent', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-image'],
            ]);
        }

        if (in_array('image_text', $validationGroups)) {
            $builder->add('textContent', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-image_text'],
            ]);
            $builder->add('imageContent', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-image_text'],
            ]);
        }

        if (in_array('text_image', $validationGroups)) {
            $builder->add('textContent', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-text_image'],
            ]);
            $builder->add('imageContent', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-text_image'],
            ]);
        }

        if (in_array('rounded_pic_text_below', $validationGroups)) {
            $builder->add('textContent', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-rounded_pic_text_below'],
            ]);
            $builder->add('imageContent', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'block-content block-content-rounded_pic_text_below'],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Block::class,
            'validation_groups' => function (FormInterface $form) {
                $data = $form->getData();
                if ($data && $data->getType()) {
                    return [$data->getType()];
                }
                return ['Default'];
            },
        ]);
    }
}
