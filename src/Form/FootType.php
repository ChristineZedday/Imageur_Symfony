<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Foot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $imagesUniques = [];
        if (!empty($options['images'])) {
            foreach ($options['images'] as $image) {
                $imagesUniques[$image->getNom()] = $image;
            }
        }

        $builder
            ->add('nom')
            ->add('contenu')
            ->add('image', ChoiceType::class, [
                'choices' => $imagesUniques,
                'multiple' => false,
                'mapped' => true,
                'required' => false, ])
            ->add('type', ChoiceType::class, ['choices' => ['HomePage' => 'HomePage', 'Article' => 'Article'],
            'label' => 'Pour quel type de page?',
            'multiple' => false, ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Foot::class,
            'images' => [],
        ]);
    }
}
