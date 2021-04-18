<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */
namespace App\Service;


use App\Entity\HomePage;
use App\Repository\AdressRepository;

define('ENTETE_HTML', '<!DOCTYPE html><html lang="fr">');


class Generator 
{
	
	

	public function genereFileArticle(Article $article, Object $entity)
    {
		$type= get_class($entity);
    }

    public function genereFileHomePage(HomePage $home, Object $entity, AdressRepository $adressRepository)
    {
        $type= get_class($entity);
		$dir = $adressRepository->findOneByName('home')->getPhysique() ;
		$includes_path = $adressRepository->findOneByName('includes')->getPhysique();


		
        switch($type){
			case 'HomePage':
				$filepath = $dir.'index.php';
				$file = open($filepath, w);
				fwrite($file, ENTETE_HTML);
				fclose($file);
				break;
			
             case 'Metas':
				if (!file_exists($includes_path.'metas.php')) {
					$entity->genereMetas($dir);
				}
                return '<?php include('.$path.'metas.php) ?>';
			case 'Footer':
				if (!file_exists($path.'footer.php')) {
					$entity->genereFooter($dir);
				}
                return '<?php include('.$path.'footer.php) ?>';
            case 'Aside':
				if (!file_exists($path.'aside_'.$entity->getNom()))
				{
					$entity->genereAside($dir);
				}
				return '<?php include('.$path.'aside_'.$entity->getNom().'.php) ?>';
            }
    }
}