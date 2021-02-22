<?php

namespace App\Form;

use App\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Image;


class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $photos = [];
      
        foreach ($options['images'] as $image)
        {
           $photos[$image->getNom()]  = $image->getId(); //on affiche le nom, on transmet l'id!
          
        }
       
        $builder
            ->add('nom')
            ->add('article')
            ->add('section')
            ->add('images', ChoiceType::class,[
                'choices' => $photos,
                'multiple' => true,
                'mapped' => false,
                'required' => false])
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
