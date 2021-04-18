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
define('END_HTML','</body></html>');
define('METAS_HTML', '<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width" />');
define('MIDDLE_HTML', '</head><body>');

function get_class_name($classname)
{
    if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
    return $pos;
}

function makePage($filename, Object $entity)
{
	$file = fopen($filename, 'w');
	fwrite($file, ENTETE_HTML.METAS_HTML);
	if (null !== $entity->getAuteur())
	{
		fwrite ($file, '<meta name="author" content="'.$entity->getAuteur().'"/>');
	}
	if (null !== $entity->getTitre())
	{
		fwrite ($file, '<meta name="title" content="'.$entity->getTitre().'"/>');
	}
	if (null !== $entity->getDescription())
	{
		fwrite ($file, '<meta name="description" content="'.$entity->getDescription().'"/>');
	}
	if (null !== $entity->getKeywords())
	{
		fwrite ($file, '<meta name="keywords" content="'.$entity->getKeywords().'"/>');
	}

	
	


	fwrite($file, MIDDLE_HTML);

	fwrite($file, END_HTML);
	fclose($file);
			
}


class Generator 
{
	
	

	public function genereFileArticle(Article $article, Object $entity)
    {
		$type= get_class($entity);
    }

    public function genereFileHomePage(HomePage $home, Object $entity, AdressRepository $adressRepository)
    {
        $type= get_class($entity);
		$type= get_class_name($type);

		$dir = $adressRepository->findOneByName('home')->getPhysique() ;
		$includes_path = $adressRepository->findOneByName('includes')->getPhysique();


		
        switch($type){
			case 'HomePage':
				$filepath = $dir.'index.php';
				makePage($filepath, $home);
				
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