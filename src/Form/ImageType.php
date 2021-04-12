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

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $titres = [];
            if (!empty($options['sections'])) {
                foreach ($options['sections'] as $section) {
                    $titres[$section->getTitre()] = $section;
                }
              }
       
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $image = $event->getData();
                $form = $event->getForm();

                // checks if the Image object is "new"
                // If no data is passed to the form, the data is "null".
                // This should be considered a new "Image"
                if (!$image || null === $image->getId()) {
                    $form->add('nom', TextType::class, ['required' => false]);
                    $form->add('pour', ChoiceType::class, ['choices' => ['carrousel' => 'carrousel', 'illustration' => 'illustration']]);
                    $form->add('image', FileType::class, [
                        'label' => 'fichier à télécharger',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => true, ]);
                    $form->add('vignette', FileType::class, [
                        'label' => 'vignette (facultatif, vous pouvez la télécharger plus tard)',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => false, ]);
                }
            });
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $image = $event->getData();
                $form = $event->getForm();
                if ($image && false === $image->getVignette() && 'carrousel' === $image->getPour()) {
                    $form->add('vignette', FileType::class, [
                        'label' => 'vignette ',
                        'multiple' => false,
                        'mapped' => false,
                        'required' => false, 
                      ]);
                }
            });
            $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($titres) {
                $image = $event->getData();
                $form = $event->getForm();
                if (!$image || 'illustration' === $image->getPour()) {
                    $form->add('section', ChoiceType::class, [
                        'label' => 'section ',
                        'multiple' => 'false',
                        'mapped' => true,
                        'required' => true,
                        'choices' =>  $titres ]);
                }
            });

        $builder->add('alt', TextType::class, ['label' => 'texte alternatif', 'attr' => ['size' => '150']]);
        $builder->add('legend', TextType::class, ['label' => 'légende', 'required' => 'false', 'attr' => ['size' => '150']]);
        $builder->add('rang');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
            'sections' => [],
        ]);
    }
}
