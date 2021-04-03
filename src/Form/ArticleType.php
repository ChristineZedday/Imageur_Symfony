<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $noms = [];
        foreach ($options['rubriques'] as $rubrique) {
            $noms[$rubrique->getNom()] = $rubrique;

        }
        $builder
            ->add('titre',  TextType::class, [
                 'attr' => ['size' => '150']])
            ->add('auteur')
            ->add('nom', TextType::class, [
                'label' => 'Nom pour le fichier (éviter accents)'])
            ->add('rubrique', ChoiceType::class,[ 
                'choices' => $noms,
                'multiple' => false,
                'mapped' => true,
                'required' => true])
             ->add('description', TextType::class, [
                'attr' => ['size' => '150']])
             ->add('keywords',  TextType::class, [
                'attr' => ['size' => '150']])
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
