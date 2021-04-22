<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Slider;
use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('section', EntityType::class,[
                'class' => Section::class,
                'choice_label' => 'titre',
                'multiple' => false,
                'mapped' => true,
                'required' => true])
            // ->add('images', ChoiceType::class,[
            //     'choices' => $photos,
            //     // 'choice_attr' => $attr,
            //     'multiple' => true,
            //     'mapped' => false,
            //     'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slider::class,
           
        ]);
    }
}
