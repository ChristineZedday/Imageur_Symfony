<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $noms = [];
        foreach ($options['rubriques'] as $rubrique) {
            $noms[$rubrique->getNom()] = $rubrique;

        }
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('rubrique', ChoiceType::class,[
                'choices' => $noms,
                'multiple' => false,
                'mapped' => true,
                'required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'rubriques' => [],
        ]);
    }
}
