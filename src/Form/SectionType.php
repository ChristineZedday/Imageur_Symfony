<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Article;
use App\Entity\HomePage;
use App\Entity\Section;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
// use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
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
        ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $section = $event->getData();
            $form = $event->getForm();

            if (null === $section->getArticle() && null === $section->getHomePage()) {
                $form->add('article', EntityType::class, [
                // looks for choices from this entity
                'class' => Article::class,
                'choice_label' => 'titre',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ]);
                $form->add('homePage', EntityType::class, [
                'class' => HomePage::class,
                'choice_label' => 'titre',
                'multiple' => false,
                'mapped' => true,
                'required' => false, ]);

                
                
            }
            if ($section->getBicolonne()) {
                $form->add( 'colonne2',
                TextAreaType::class,
                [
                  
                  'mapped'          => true,
                  'required'        => true,
                  'label' => 'contenu colonne de droite',
                  'attr' => ['rows' => '15', 'cols' => '100']
                 
                ]);
            }
        });

        $builder
        ->add('titre', TextType::class, [
            'required' => false,
            'attr' => ['size' => '150'], ])
            ->add('Contenu', TextareaType::class, ['label' => 'contenu (colonne de gauche si deux)', 'attr' => ['rows' => '15', 'cols' => '100']])
            ->add('rang')
            ->add('bicolonne', ChoiceType::class, ['label' => 'Deux colonnes?', 'choices' => ['oui' => true, 'non' => false], 'required' => false, 'mapped' => true]);



        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($imagesUniques) {
                $section = $event->getData();
                $form = $event->getForm();

                if (null === $section->getSlider()) { //pas à la fois une imge plus un carrousel!
                    $form->add('image', ChoiceType::class, [
                'choices' => $imagesUniques,
                'multiple' => false,
                'mapped' => true,
                'required' => false, ]);
                }
            });
            $builder
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            //    dd($event->getData());
                $colonnes = $event->getData()['bicolonne'];
                
                $form = $event->getForm();
               
                if ($colonnes) {
                    
                    $form->add('colonne2',
                    TextAreaType::class,
                    [
                      
                      'mapped'          => true,
                      'required'        => true,
                      'label' => 'contenu colonne de droite',
                      'attr' => ['rows' => '15', 'cols' => '100']
                     
                    ]);
                }
            })->getForm();
            
    }

  

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
            'images' => [],
        ]);
    }
}
