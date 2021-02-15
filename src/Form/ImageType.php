<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,['required'=>false])
            ->add('alt')
            ->add('legend')
            ->add('pour', ChoiceType::class, [ 'choices' => ['carrousel' => 'carrousel', 'illustration' => 'illustration']])
            ->add('image', FileType::class,[
                'label' => 'fichier à télécharger',
                'multiple' => false,
                'mapped' => false,
                'required' => true])
            ->add('vignette', FileType::class,[
                 'label' => 'vignette (facultatif, vous pouvez la télécharger plus tard)',
                 'multiple' => false,
                 'mapped' => false,
                 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
