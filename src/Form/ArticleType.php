<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $noms = [];
        foreach ($options['rubriques'] as $rubrique) {
            $noms[$rubrique->getNom()] = $rubrique;

        }
        $sides = [];
        foreach ($options['asides'] as $aside) {
            $sides[$aside->getNom()] = $aside;
        }
        $builder
            ->add('titre',  TextType::class, [
                 'attr' => ['size' => '150']])
                ->add('lien',  TextType::class, [
                    'label' => 'Nom du lien si différent du titre',
                    'required' => false])
            ->add('auteur')
            ->add('nom', TextType::class, [
                'label' => 'Nom pour le fichier (éviter accents)'])
            ->add('rubrique', ChoiceType::class,[ 
                'choices' => $noms,
                'multiple' => false,
                'mapped' => true,
                'required' => true])
             ->add('description', TextType::class, [
             'required' => false,
                'attr' => ['size' => '150']])
             ->add('keywords',  TextType::class, [
                 'required' => false, 
                'attr' => ['size' => '150']])
            ->add('aside', ChoiceType::class, [
                'choices' => $sides,
                'required' =>false,
                'multiple' => false,
                'mapped' => true,])
            ->add('rang', NumberType::class, [
                'label' =>'rang dans la rubrique',
                'required' =>false,
                'mapped' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'rubriques' => [],
            'asides' => [],
        ]);
    }
}
