<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>"Nom",
                'attr' => ['placeholder' => "nom"],
                'constraints' => [
                    new NotBlank(["message"=>"Veuillez mettre un nom"])
                ],
                'required'=>false
            ])
            ->add('price',IntegerType::class,[
                "label"=>"Prix",
                'attr' => [
                    'placeholder' => "Nombre"
                ],
                'constraints' => [
                    new NotBlank(["message"=>"Veuillez mettre un nombre"])
                ],
                'required'=>false
            ])
            ->add('description',TextareaType::class,[
                "label"=>"Description",
                'attr' => [
                    'placeholder' => "description",
                    'rows'=>2
                ],
                'constraints' => [
                    new NotBlank(["message"=>"Veuillez mettre une description"])
                ],
                'required'=>false
            ])
            ->add('stock',IntegerType::class,[
                "label"=>"Nombre au stock",
                'attr' => [
                    'placeholder' => "Nombre"
                ],
                'constraints' => [
                    new NotBlank(["message"=>"Veuillez mettre un nombre"])
                ],
                'required'=>false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('files',FileType::class,[
                "label" => "photo",
                "multiple" => true,
                "mapped" => false,
                'label'=>" ",
                'attr' => [
                    'placeholder' => " ",
                    "class" => "thefile",
                    "multiple" => "multiple"
                ],
                "data_class" => null,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
