<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adress = new Adress();
        $adress->setNom('vignette');
        $manager->persist($adress);
      
        $adress = new Adress();
        $adress->setNom('grandes_images');
        $manager->persist($adress);
      
        $adress = new Adress();
        $adress->setNom('moyennes_images');
        $manager->persist($adress);

        $adress = new Adress();
        $adress->setNom('fichiers');
        $manager->persist($adress);

        $adress = new Adress();
        $adress->setNom('includes');
        $manager->persist($adress);

        $adress = new Adress();
        $adress->setNom('home');
        $manager->persist($adress);

        $adress = new Adress();
        $adress->setNom('css');
        $manager->persist($adress);

        $adress = new Adress();
        $adress->setNom('js');
        $manager->persist($adress);

        $manager->flush();

       
   
    }
}
