<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Service;

use App\Repository\AdressRepository;
use App\Entity\Image;

class ExtensionCleaner
{
	public function __construct(AdressRepository $adressRepository) //service appelé ds un service
    {
        $this->adressRepository = $adressRepository;
    }

	/**
	 * Put the images' extensions of all 3 directories in *lowercase, and convert jpeg into jpg
	 */
	public function cleanAllJPG() 
	{
		$dir = $this->adressRepository->findOneByName('grandes_images')->getPhysique();
		
	    if ($dossier = opendir($dir)) {
	        while(false !== ($fichier = readdir($dossier)) && is_file($fichier)) {
				ExtensionCleaner::cleanJPG($fichier);
			
		    }
		}
		$dir = $this->adressRepository->findOneByName('vignette')->getPhysique();
		
	    if ($dossier = opendir($dir)) {
	        while(false !== ($fichier = readdir($dossier))) {
				ExtensionCleaner::cleanJPG($fichier);
			}
		}
		$dir = $this->adressRepository->findOneByName('moyennes_images')->getPhysique();
		
	    if ($dossier = opendir($dir)) {
	        while(false !== ($fichier = readdir($dossier))) {
				ExtensionCleaner::cleanJPG($fichier);
			}

		}
	}
	static function cleanJPG($fichier) 
	{
		$nom = explode('.', $fichier)[0];
				$ext = $fichier->gessExtension();
				switch($ext) {
					case 'JPG':
					case 'JPEG':
					case 'jpeg':
						rename($fichier, $nom.'.jpg');
						break;
					case  'PNG':
						rename($fichier, $nom.'.png');
						break;
					case  'GIF':
						rename($fichier, $nom.'.gif');
						break;
					default:
					break;
				}	
	}
}