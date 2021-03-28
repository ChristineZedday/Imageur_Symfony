<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $photos = [];
        $titres = [];

        // foreach ($options['images'] as $image) {
        //     $photos[$image->getNom()] = $image->getId(); //on affiche le nom, on transmet l'id!
        // //   $attr[$image->getNom()]  = ['alt' => $image->getAlt()]; //pour savoir ce que représente la photo
        // }

        
        foreach ($options['sections'] as $section) {
            $titres[$section->getTitre()] = $section; //on affiche le nom, on transmet l'objet
       
        }

        $builder
            ->add('nom')
            ->add('section', ChoiceType::class,[
                'choices' => $titres,
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
            // 'images' => [],
            'sections' => [],
        ]);
    }
}
