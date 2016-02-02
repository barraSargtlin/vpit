<?php

namespace Barra\RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CookingType extends AbstractType
{
    /**
     * @{@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', 'text', [
                'attr' => [
                    'placeholder' => 'recipe.cooking.description',
                ],
            ])
            ->add('recipe', 'hidden', [
                'mapped' => false,
                'label'  => false,
            ])
            ->add('submit', 'submit')
            ->getForm();
    }

    /**
     * @{@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => 'Barra\RecipeBundle\Entity\Cooking',
            'csrf_protection'   => false,
        ]);
    }

    public function getName()
    {
        return 'formCooking';
    }
}