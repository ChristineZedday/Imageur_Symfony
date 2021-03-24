<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Image;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $nb_fichiers = 0;
        if ($dossier = opendir("C:\laragon\www\Imageur\public\uploads\petites_images")) {
            while (false !== ($fichier = readdir($dossier))) {
                if ($fichier != '.' && $fichier != '..' && $fichier != 'index.php') {
                    $nb_fichiers++;

                    $image = new Image();
                    $image->setNom($fichier);
                    $image->setAlt('à compléter!');
                    $image->setLegend('');
                    $image->setPour('carrousel');
                    $image->setVignette(true);
                    $manager->persist($image);
                }
            }
            $manager->flush();
        } else {
            dd('pas bon le chemin');
        }
    }
}
