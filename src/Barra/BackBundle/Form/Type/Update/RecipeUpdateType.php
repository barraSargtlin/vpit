<?php

namespace Barra\BackBundle\Form\Type\Update;

use Barra\FrontBundle\Entity\RecipeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden', array(
                    'mapped' => false,
                    'label'=>false
                ))
            ->add('name', 'text', array(
                    'attr'=>array('placeholder'=>'back.recipe.name')
                ))
            ->add('submit', 'submit')
            ->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'Barra\FrontBundle\Entity\Recipe',
            'intention' =>'recipe'
        ));
    }

    public function getName()
    {
        return 'formRecipeUpdate';
    }
}