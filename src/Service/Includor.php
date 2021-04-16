<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */
namespace App\Service;


use App\Entity\HomePage;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class Includor 
{
	
	private $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }

	public function includeFileArticle(Article $article, Object $entity): string
    {
		$type= get_class($entity);
    }

    public function includeFileHomePage(HomePage $home, Object $entity): string
    {
        $type= get_class($entity);
		dd($this);
		$path = $this->params->get('$includes_dir_from_home');
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
