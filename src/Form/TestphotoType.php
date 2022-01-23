<?php

namespace App\Form;

use App\Entity\Test;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestphotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'label' => 'Titre',
                'required' => false,
                'constraints'=>[
                    new NotBlank(['message'=>'Indiquez un titre'])
                ],
                'data_class' => null
            ])
            ->add('photo',FileType::class,[
                'label'=>'Photo',
                'required' => false,
                'constraints'=>[
                    new NotBlank(['message'=>'Choisissez une image'])
                ],
                'data_class' => null
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}
