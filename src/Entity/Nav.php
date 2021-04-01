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
        $path = $dir.'/nav.php';
        $navFile = fopen($path, 'w');
		
		$rubriques = $rubriqueRepository->findAll();

        fwrite($navFile, '<div class=element id="som"> <nav  class=sommaire id="flexnav"> <ul>');
        foreach ($rubriques as $rubrique) {
        
            if (null !== $rubrique->getTitre()) {
        fwrite($navFile, '<h1>'.$rubrique->getTitre().'</h1>');
            }
            foreach ($rubrique->getArticles() as $article)
            {
                fwrite($navFile, '<li><a href="article_'.$article->getId().'">'.$article->getTitre().'</a></li>');
            }
       
        }
    
      
        fwrite($navFile, '</ul></nav></div>');
        fclose($navFile);
    }
}
	

