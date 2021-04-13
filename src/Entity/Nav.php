<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\RubriqueRepository;
use App\Entity\Rubrique;

class Nav
{

	public function genereNav($dir, RubriqueRepository $rubriqueRepository)
    {
        $path = $dir.'/sommaire.php';
        $navFile = fopen($path, 'w');
		
		$rubriques = $rubriqueRepository->findAll();

        fwrite($navFile, '<div class=element id="som"> <nav  class=sommaire id="flexnav"> <ul>');
        foreach ($rubriques as $rubrique) {
        
            if (null !== $rubrique->getTitre()) {
        fwrite($navFile, '<h1>'.$rubrique->getTitre().'</h1>');
            }
            foreach ($rubrique->getArticles() as $article)
            {
                $file = $article->getNom().'.php';
                $lien = $article->getLien();
               
                if (file_exists($dir.'/'.$file)) {  
                    if (null !== $lien) {
                        fwrite($navFile, '<li><a href="'.$file.'">'.$lien.'</a></li>');      
                    }
                    else {
            fwrite($navFile, '<li><a href="'.$file.'">'.$article->getTitre().'</a></li>');
                    }
                }

            }
       
        }
    
      
        fwrite($navFile, '</ul></nav></div>');
        fclose($navFile);
    }
}
	

