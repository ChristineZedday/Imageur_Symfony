<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Rubrique;
use App\Entity\Aside;
use App\Entity\Javascript;
use App\Entity\CSS;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
     
        $builder
            ->add('titre',  TextType::class, [
                 'attr' => ['size' => '150']])
                ->add('lien',  TextType::class, [
                    'label' => 'Nom du lien si différent du titre',
                    'required' => false])
            ->add('auteur')
            ->add('nom', TextType::class, [
                'label' => 'Nom pour le fichier (éviter accents)'])
            ->add('rubrique', EntityType::class,[ 
                'class' => Rubrique::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'mapped' => true,
                'required' => true])
             ->add('description', TextType::class, [
             'required' => false,
                'attr' => ['size' => '150']])
             ->add('keywords',  TextType::class, [
                 'required' => false, 
                'attr' => ['size' => '150']])
            ->add('aside',EntityType::class, [
                'class' => Aside::class,
                'choice_label' => 'nom',
                'required' =>false,
                'multiple' => false,
                'mapped' => true,])
            ->add('rang', NumberType::class, [
                'label' =>'rang dans la rubrique',
                'required' =>false,
                'mapped' => true,
            ])
            ->add('javascript', EntityType::class, [
                // looks for choices from this entity
                'class' => Javascript::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'required' =>false,
                'mapped' => true,])
        ->add('css', EntityType::class, [
            // looks for choices from this entity
            'class' => CSS::class,
            'choice_label' => 'nom',
            'multiple' => true,
            'required' =>false,
            'mapped' => true,])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
           
            
        ]);
    }
}
