<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Enum\InventoryStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('name')
            ->add('description')
            ->add('image')
            ->add('price')
            ->add('quantity')
            ->add('internalReference')
            ->add('shellId')
            ->add('inventoryStatus', ChoiceType::class, [
                'choices' => [
                    'In Stock' => InventoryStatus::INSTOCK,
                    'Low Stock' => InventoryStatus::LOWSTOCK,
                    'Out of Stock' => InventoryStatus::OUTOFSTOCK,
                ]
            ])
            ->add('rating')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez une catégorie',
                'label' => 'Catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
