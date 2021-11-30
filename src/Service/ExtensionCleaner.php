<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Service;

use App\Repository\AdressRepository;
use App\Repository\ImageRepository;

class ExtensionCleaner
{
	public function __construct(AdressRepository $adressRepository, ImageRepository $imageRepository) //services appelés ds un service
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
	        while(false !== ($fichier = readdir($dossier))) {
				if ($fichier != '.' && $fichier != '..') {
				ExtensionCleaner::cleanJPG($dir,$fichier);
				}
		    }
		}
		$dir = $this->adressRepository->findOneByName('vignette')->getPhysique();
		
	    if ($dossier = opendir($dir)) {
	        while(false !== ($fichier = readdir($dossier)))  { 
				if ($fichier != '.' && $fichier != '..'){
				ExtensionCleaner::cleanJPG($dir, $fichier);
				}
			}
		}
		$dir = $this->adressRepository->findOneByName('moyennes_images')->getPhysique();
		
	    if ($dossier = opendir($dir)) {
			while(false !== ($fichier = readdir($dossier)))  { 
				if ($fichier != '.' && $fichier != '..'){
				
				ExtensionCleaner::cleanJPG($dir, $fichier);
				}
			}

		}
	}
	public function cleanJPG($dossier, $fichier) : String
	{
		
		$tableau = explode('.', $fichier);
		$nom = $tableau[0];
		if (count($tableau)>1)
		{
				$ext = $tableau[1];
				
				switch($ext) {
					case 'JPG':
					case 'JPEG':
					case 'jpeg':
						
						rename($dossier.$fichier, $dossier.$nom.'.jpg');
						return $nom.'.jpg';
						
						break;
					case  'PNG':
						
						rename($dossier.$fichier, $dossier.$nom.'.png');
						return $nom.'.png';
						break;
					case  'GIF':
						
						rename($dossier.$fichier, $dossier.$nom.'.gif');
						return $nom.'.gif';
						break;
					default:
					return $nom.'.jpg';
					break;
				}
				}	
				else {
					return $nom.'.jpg'; //si l'extension est perdue, on met jpg
				}
	}
	
}