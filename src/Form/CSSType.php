<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Form;

use App\Entity\CSS;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

// use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CSSType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('couleurTexte')
            ->add('couleurFond')
            ->add('couleurTexteSommaire')
            ->add('couleurFondSommaire')
            ->add('couleurTitre1')
            ->add('couleurTitre2')
            ->add('couleurTitre3')
            ->add('couleurAcote')
            ->add('couleurLiens')
            ->add('couleurLiensVisites')
            ->add('couleurLiensSommaire')
            ->add('couleurLiensVisitesSommaire')
            ->add('couleurTexteAcote')
            ->add('couleurTitreAcote')
            ->add('policeTexte')
            ->add('policeTitre1')
            ->add('policeTitre2')
            ->add('policeTitre3')
            ->add('structure', ChoiceType::class, ['choices' => ['menu à gauche, aside à droite, sauf téléphone' => 'menu à gauche, aside à droite, sauf téléphone', 'menu en haut, 2 colonnes, pas d\'aside' => 'menu en haut, 2 colonnes, pas d\'aside']]);
           

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CSS::class,
        ]);
    }
}
