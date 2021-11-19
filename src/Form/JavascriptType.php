<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Javascript;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JavascriptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Javascript::class,
        ]);
    }
}
