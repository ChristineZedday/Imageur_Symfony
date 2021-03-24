<?php

namespace App\Form;

use App\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use App\Entity\Image;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $photos = [];
        $attr=[];
      
        foreach ($options['images'] as $image) {
            $photos[$image->getNom()]  = $image->getId(); //on affiche le nom, on transmet l'id!
        //   $attr[$image->getNom()]  = ['alt' => $image->getAlt()]; //pour savoir ce que représente la photo
        }
       
        $builder
            ->add('nom')
            ->add('article')
            ->add('section')
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
            'images' => [],

        ]);
    }
}
