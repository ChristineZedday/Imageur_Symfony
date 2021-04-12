<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $titresArticles = [];
            if (!empty($options['articles'])) {
                foreach ($options['articles'] as $article) {
                    $titresArticles[$article->getTitre()] = $article;
                }
              }
        $imagesUniques = [];
        if (!empty($options['images'])) {
            foreach ($options['images'] as $image) {
                $imagesUniques[$image->getNom()] = $image;
            }
          }
           
        $builder
        ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($titresArticles) {
            $section = $event->getData();
            $form = $event->getForm();
           
           if (null === $section->getArticle()) {
           
           
               $form->add('article', ChoiceType::class,[
            'choices' => $titresArticles,
            'multiple' => false,
            'mapped' => true,
            'required' => true]);
            }});
       
      $builder
        ->add('titre',  TextType::class, [
            'required' =>false,
            'attr' => ['size' => '150']])
            ->add('Contenu',  TextareaType::class, ['label' => 'contenu', 'attr' => ['rows' => '15', 'cols' => '100']])
            ->add('rang');

            $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($imagesUniques) {
                $section = $event->getData();
                $form = $event->getForm();
               
               if (null === $section->getSlider()) { //pas à la fois une imge plus un carrousel!
               
               
                   $form->add('image', ChoiceType::class,[
                'choices' => $imagesUniques,
                'multiple' => false,
                'mapped' => true,
                'required' => false]);
                }});
    }
            
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
            'articles' => [],
            'images' =>[],
        ]);
    }
}
