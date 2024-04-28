<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Section;
use App\Entity\Rubrique;
use App\Entity\Slider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'choice_label' => 'titre',
                'multiple' => false,
                'mapped' => true,
                'required' => true, ])
            ->add('vignetteverticale')
            ->add('rubriquesPiocheImages', EntityType::class, [
                    'class' => Rubrique::class,
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'mapped' => true,
                    'required' => true, ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slider::class,
        ]);
    }
}
