<?php

namespace App\Form;

use App\Entity\HomePage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Aside;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HomePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('titre')
            ->add('aside', EntityType::class, [
                // looks for choices from this entity
                'class' => Aside::class,
                'choice_label' => 'nom',])
                ->add('description', TextType::class, [
                    'required' => false,
                       'attr' => ['size' => '150']])
                    ->add('keywords',  TextType::class, [
                        'required' => false, 
                       'attr' => ['size' => '150']])
                       ->add('contenu',  TextType::class, [
                        'required' => false, 
                       'attr' => ['size' => '150']])
                       ->add('auteur',  TextType::class, [
                        'required' => false, 
                       'attr' => ['size' => '150']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomePage::class,
        ]);
    }
}
