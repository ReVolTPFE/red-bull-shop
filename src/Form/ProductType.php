<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nom du produit'])
            ->add('price', null, ['label' => 'Prix'])
            ->add('description', null, ['label' => 'Description'])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Catégories'
            ])
            ->add('image', null, ['label' => 'Image'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
