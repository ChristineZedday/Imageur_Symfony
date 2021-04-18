<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */
namespace App\Service;


use App\Entity\HomePage;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class Generator 
{
	
	

	public function genereFileArticle(Article $article, Object $entity)
    {
		$type= get_class($entity);
    }

    public function genereFileHomePage(HomePage $home, Object $entity)
    {
        $type= get_class($entity);

		$path = $includes_dir_from_home;
		dd($path);
		$dir = $this->params->get('$includes_dir');
        
        switch($type){
			
             case 'Metas':
				if (!file_exists($path.'metas.php')) {
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