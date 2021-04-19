<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */
namespace App\Service;


use App\Entity\HomePage;
use App\Repository\AdressRepository;
use App\Repository\RubriqueRepository;
use App\Service\Includor;

define('ENTETE_HTML', '<!DOCTYPE html><html lang="fr">');
define('END_HTML','</div></div></body></html>');
define('METAS_HTML', '<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width" />');
define('MIDDLE_HTML', '</head><body><div id = "conteneur">');
define('IMAGEUR', '<p>Cette page a été générée automatiquement par <a href="https://github.com/christinezedday/Imageur_Symfony">Imageur</a></p>');
define('FOOTER','<p>Textes et dessins de Christine Zedday<br/>Photos Christine Zedday, Alain et H&eacute;l&egrave;ne Bache, Leïla et Nora Zedday </p>'); //faudra faire une table pour le/les footer


function get_class_name($classname)
{
    if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
    return $pos;
}



class Generator 
{
	private $adressRepository, $rubriqueRepository, $includor;

	public function __construct(AdressRepository $adressRepository, RubriqueRepository $rubriqueRepository, Includor $includor) //service appelé ds un service
    {
        $this->adressRepository = $adressRepository;
		$this->rubriqueRepository = $rubriqueRepository;
		$this->includor = $includor;
    }


	private function genereNav($type)
    {
        if ($type === 'HomePage') {
		$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'sommaireaccueil.php';
		}
		else {
			$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'sommaire.php';	
		}
        $file = fopen($path, 'w');
		
		$rubriques = $this->rubriqueRepository->findAll();

		fwrite($file, '<div class="element" id="som"> <nav  class=sommaire id="flexnav"> <ul>');
        if ($type !== 'HomePage'){
			fwrite($file, '<li><a href="'.$this->adressRepository->findOnebyName('home')->getRelativeAccueil().'index.php">Accueil</a></li>' );
		}

		foreach ($rubriques as $rubrique) {
			if (null !== $rubrique->getTitre()) {
				fwrite($file, '<h1>'.$rubrique->getTitre().'</h1>');
			}
				foreach ($rubrique->getArticles() as $article) {
					$nom = $article->getNom().'.php';
					$lien = $article->getLien();
					if ($type === 'HomePage')	
				{	$path = $this->adressRepository->findOnebyName('fichiers')->getRelativeAccueil();
				}
				else {
					$path = $this->adressRepository->findOnebyName('fichiers')->getRelativeFichiers();	
				}
		
                if (file_exists($this->adressRepository->findOnebyName('fichiers')->getPhysique().'/'.$nom)) {  
                    if (null !== $lien) {
                        fwrite($file, '<li><a href="'.$path.$nom.'">'.$lien.'</a></li>');      
                    }
                    else {
						fwrite($file, '<li><a href="'.$path.$nom.'">'.$article->getTitre().'</a></li>');
                    }

				
			}
		}
        
	}
	fwrite($file, ' </ul> </nav></div>');
			fclose($file);
    }

	private function genereFooter()
    {
		$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'/footer.php';
        $footerFile = fopen($path, 'w');
		

        fwrite($footerFile, '<footer>'.FOOTER.IMAGEUR.'</footer>');
       
        fclose($footerFile);
    }

	private function makePage($filename, Object $entity)
{
	$type= get_class($entity);
	$type= get_class_name($type);
    if ($type === 'HomePage') {
		$path = $this->adressRepository->findOnebyName('includes')->getRelativeAccueil();
		$css = $this->adressRepository->findOnebyName('css')->getRelativeAccueil();
	}
	else {
		$path = $this->adressRepository->findOnebyName('includes')->getRelativeFichiers();
		$css = $this->adressRepository->findOnebyName('css')->getRelativeFichiers();
	}


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
	if ($type === 'HomePage') {
		fwrite ($file, '<liNK href="'.$css.'app.css" rel="stylesheet" type="text/css">');
	}
	else {
		fwrite ($file, '<liNK href="'.$css.'app.css" rel="stylesheet" type="text/css">');
	}
	



	fwrite($file, MIDDLE_HTML);//passage head à body

   
	$this->genereNav($type);
	if ($type === 'HomePage') {
		$nom = $path.'sommaireaccueil.php';
	}
	else {
		$nom = $path.'sommaire.php';
	}
	
	fwrite ($file, '<?php include(\''.$nom.'\'); ?>');

	fwrite ($file, '<div class="element" id="main">
	<article class="contenu">');
	
	if (null !== $entity->getTitre()) {
		fwrite ($file, '<h1>'.$entity->getTitre().'</h1>')	;
	}
	if (null !== $entity->getContenu()) {
		fwrite ($file, $entity->getContenu())	;
	}
	fwrite ($file, '</article>');
	$this->genereFooter();
	
	fwrite ($file, '<?php include(\''.$path.'footer.php\'); ?>');
	fwrite($file, END_HTML);
	fclose($file);
			
   }


	
	

	public function genereFileArticle(Article $article, Object $entity)
    {
		$type= get_class($entity);
		$dir = $this->adressRepository->findOneByName('fichiers')->getPhysique() ;
		$includes_path = $this->adressRepository->findOneByName('includes')->getPhysique();
    }

    public function genereFileHomePage(HomePage $home, Object $entity)
    {
        $type= get_class($entity);
		$type= get_class_name($type);

		$dir = $this->adressRepository->findOneByName('home')->getPhysique() ;
		$includes_path = $this->adressRepository->findOneByName('includes')->getPhysique();


		
        switch($type){
			case 'HomePage':
				$filepath = $dir.'index.php';
				$this->makePage($filepath, $home);
				
				break;
			
           
            case 'Aside':
				if (!file_exists($path.'aside_'.$entity->getNom()))
				{
					$entity->genereAside($dir);
				}
				return '<?php include('.$path.'aside_'.$entity->getNom().'.php) ?>';
            }
    }
}