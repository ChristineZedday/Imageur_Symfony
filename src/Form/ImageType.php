<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Rubrique;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $image = $event->getData();
                $form = $event->getForm();

                // checks if the Image object is "new"
                // If no data is passed to the form, the data is "null".
                // This should be considered a new "Image"
                if (!$image || null === $image->getId()) {
                   
                    $form->add('pour', ChoiceType::class, ['choices' => ['carrousel' => 'carrousel', 'illustration' => 'illustration']]);
                    $form->add('image', FileType::class, [
                        'label' => 'fichier à télécharger',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => true, ]);
                    $form->add('vignette', FileType::class, [
                        'label' => 'vignette (facultatif)',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => false, ]);
                }
            });
        // $builder
        //     ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        //         $image = $event->getData();
        //         $form = $event->getForm();
              
        //         if ($image && false === $image->getVignette() && 'carrousel' === $image->getPour()) {
        //             $form->add('vignette', FileType::class, [
        //                 'label' => 'vignette ',
        //                 'multiple' => false,
        //                 'mapped' => false,
        //                 'required' => false,
        //               ]);
        //         }
        //     });
      
            $builder->add('nom', TextType::class, ['label' => 'changer le nom? (sans extension)', 'mapped'=>true, 'required'=>false]);
        $builder->add('alt', TextType::class, ['label' => 'texte alternatif', 'attr' => ['size' => '150']]);
        $builder->add('legend', TextType::class, ['label' => 'légende', 'required' => 'false', 'attr' => ['size' => '150']]);
        $builder->add('rang');
        $builder->add('rubrique', EntityType::class, [
            // looks for choices from this entity
            'class' => Rubrique::class,
            'choice_label' => 'titre',
            'multiple' => false,
            'mapped' => true,
            'required' => true, ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
