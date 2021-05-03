<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */
namespace App\Service;


use App\Entity\HomePage;
use App\Entity\Section;
use App\Entity\Aside;
use App\Entity\Foot;
use App\Repository\AdressRepository;
use App\Repository\RubriqueRepository;

define('ENTETE_HTML', '<!DOCTYPE html><html lang="fr">');
define('END_HTML','</div></body></html>');
define('METAS_HTML', '<head><meta charset="utf-8"/><meta name="viewport" content="width=device-width" />');
define('MIDDLE_HTML', '</head><body><div id = "conteneur">');



function get_class_name($classname)
{
    if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
    return $pos;
}



class Generator 
{
	private $adressRepository, $rubriqueRepository;

	public function __construct(AdressRepository $adressRepository, RubriqueRepository $rubriqueRepository) //services appelés ds un service
    {
        $this->adressRepository = $adressRepository;
		$this->rubriqueRepository = $rubriqueRepository;
    }


	public function genereNav($type)
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
        if ($type === 'HomePage'){
			fwrite($file, '<li><a href="'.$this->adressRepository->findOnebyName('home')->getRelativeAccueil().'index.php">Accueil</a></li>' );
		}
		else if ($type === 'Article'){
			fwrite($file, '<li><a href="'.$this->adressRepository->findOnebyName('home')->getRelativeFichiers().'index.php">Accueil</a></li>' );
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
			if ($type === 'Article') {
				$this->genereNav('HomePage'); //eh oui, faut la mettre à jour!
			}
    }

	private function genereSection(Section $section)
	{
		$dir = $this->adressRepository->findOneByName('includes')->getPhysique() ;
		$rel = $this->adressRepository->findOneByName('includes')->getRelativeFichiers() ;
		$imgs = $this->adressRepository->findOneByName('moyennes_images')->getRelativeFichiers() ;
		$thumbs = $this->adressRepository->findOneByName('vignette')->getRelativeFichiers() ;
		$filename = $dir.'section_'.$section->GetId().'.php';
		$file = fopen($filename, 'w');
		fwrite($file,'<section>');
        if (null !== $section->getTitre() && 'sans' !== $section->getTitre()) { 
            fwrite($file, '<h2>'.$section->getTitre().'</h2>');
        }
       
        fwrite($file, $section->getContenu());

		if (null !== $section->getSlider())
        {
            $nom = $section->getSlider()->getNom();
            if (!file_exists($dir.'slider_'.$nom.'.php'))
            {
                $this->genereSlider($section->getSlider());
            }
            $fichier = $rel.'slider_'.$nom.'.php'; 
            fwrite($file, '<?php include (\''.$fichier.'\'); ?>');
        }
        else if (null !== $section->getImage()) {
            $nom = $section->getImage()->getNom();
            $alt = $section->getImage()->getAlt();
            fwrite($file, '<img src="'.$imgs.$nom.'" alt="'.$alt.'" />');
        }
		fwrite($file,'</section>');
		fclose($file);
	}

	private function genereFooter(Object $foot)
    {
		
		$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'foot_'.$foot->getNom().'.php';
        $file = fopen($path, 'w');
		
		
        fwrite($file, '<footer>');
		
       
        fwrite( $file, $foot->getContenu());
		$image = $foot->getImage();
		if (null !== $image) {
			$chemin = $this->adressRepository->findOnebyName('moyennes_images')->getRelativeFichiers();
			fwrite($file, '<img src="'.$chemin.$image->getNom().'">');
		}//pas de footer à image sur page d'accueil, du coup, pour le moment!


		fwrite($file, '</footer>');
       
        fclose($file);
    }

	private function genereAside(Object $aside)
    {
		$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'aside_'.$aside->getNom().'.php';
        $file = fopen($path, 'w');
		
		
        fwrite($file, '<aside class="acote">');
		if (null !== $aside->getTitre() && 'sans' !== $aside->getTitre()) { 
            fwrite( $file, '<h2>'.$aside->getTitre().'</h2>');
        }
       
        fwrite( $file, $aside->getContenu());


		fwrite($file, '</aside>');
       
        fclose($file);
    }

	private function genereSlider(Object $slider)
    {
		$path = $this->adressRepository->findOnebyName('includes')->getPhysique().'slider_'.$slider->getNom().'.php';
		if (null !== $slider->getSection()->getArticle())
	{	$src = $this->adressRepository->findOnebyName('vignette')->getRelativeFichiers();}
	else if (null !== $slider->getSection()->getArticle())
	{
		$src = $this->adressRepository->findOnebyName('petites_images')->getRelativeAccueil();
	}

        $sliderFile = fopen($path, 'w');
		
		fwrite($sliderFile, '<div class="container"> ');
        foreach ($slider->getImages() as $image) {
            fwrite($sliderFile, '<figure class="slide"> ');
           
            fwrite($sliderFile, ' <img class="clickable" src="'.$src.$image->getNom().'" width=150 height=100 onclick="displaySlides(src) ;" /> ');
            fwrite($sliderFile, '<figcaption hidden>'.$image->getLegend().'</figcaption>');
            fwrite($sliderFile, '</figure> ');
        }

        fwrite($sliderFile, '</div>');
        
       
        fclose($sliderFile);
    }


	private function makePage($filename, Object $entity)
{
	$type= get_class($entity);
	$type= get_class_name($type);
    if ($type === 'HomePage') {
		$path = $this->adressRepository->findOnebyName('includes')->getRelativeAccueil();
		$css = $this->adressRepository->findOnebyName('css')->getRelativeAccueil();
		$this->adressRepository->findOnebyName('js')->getRelativeAccueil();
	}
	else  if ($type === 'Article') {
		$path = $this->adressRepository->findOnebyName('includes')->getRelativeFichiers();
		$css = $this->adressRepository->findOnebyName('css')->getRelativeFichiers();
		$js = $this->adressRepository->findOnebyName('js')->getRelativeFichiers();
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
	foreach ($entity->getcss() as $style) {
	
		fwrite ($file, '<liNK href="'.$css.$style->getNom().'.css" rel="stylesheet" type="text/css">');
	
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
	if (null !== $entity->getSections()) {
		foreach ($entity->getSections() as $section) 
		{
			if (!file_exists($this->adressRepository->findOnebyName('includes')->getPhysique().'section_'.$section->getId().'.php'))
			{
				$this->genereSection($section);
			}
			$nom = $path.'section_'.$section->getId().'.php';
			fwrite ($file, '<?php include(\''.$nom.'\'); ?>');
		}
	}
	fwrite ($file, '</article>');
	$foot = $entity->getFooter();
	if ( null !== $foot) {
	$chemin = $this->adressRepository->findOnebyName('includes')->getPhysique().'foot_'.$foot->getNom().'.php';
	if (!file_exists($chemin))
	{$this->genereFooter($chemin);}
	
	fwrite ($file, '<?php include(\''.$path.'foot_'.$foot->getNom().'.php\'); ?>');
}
	fwrite($file,'</div>');
	fwrite($file,'<div class="element" id="acote">');
	$aside = $entity->getAside();
	if (null !== $aside) {
		$chemin = $this->adressRepository->findOnebyName('includes')->getPhysique().'_aside'.$aside->getNom().'.php';
	if (!file_exists($chemin))
	{$this->genereAside($aside);}
	
	fwrite ($file, '<?php include(\''.$path.'aside_'.$aside->getNom().'.php\'); ?>');
	}
	fwrite($file,'</div>');
	if (!empty($entity->getJavascript())) {
	foreach ($entity->getJavascript() as $javascript) {
	
		fwrite($file, '<script type="text/javascript" src="'.$js.$javascript->getNom().'">  </script>');
	}
}
	fwrite($file, END_HTML);
	fclose($file);
			
   }

    private function genereCSS(Object $css)
	{
		$dir = $this->adressRepository->findOnebyName('css')->getPhysique();
		copy('build/app.css',$dir.$css->getNom().'.css');
	}

    public function genereFile(Object $entity)
    {
        $type= get_class($entity);
		$type= get_class_name($type);

		$dirh = $this->adressRepository->findOneByName('home')->getPhysique() ;
		$dir = $this->adressRepository->findOneByName('fichiers')->getPhysique() ;
		$includes_path = $this->adressRepository->findOneByName('includes')->getPhysique();

        switch($type){
			case 'HomePage':
				$filepath = $dirh.'index.php';
				$this->makePage($filepath, $entity);
				
				break;
			
			case 'Article':
					$filepath = $dir.$entity->getNom().'.php';
					$this->makePage($filepath, $entity);
					
					break;
			
			case 'Section':
				$this->genereSection($entity);
			break;
			
           
            case 'Aside':
				$this->genereAside($entity);
			break;

			case 'Slider':
				$this->genereSlider($entity);
			break;

			case 'CSS':
				$this->genereCSS($entity);
			break;

			case 'Foot':
				$this->genereFooter($entity);
			break;
				
            }
    }

	

	public function genereSite()
	{
		$rubriques = $this->rubriqueRepository->findAll();
		foreach ($rubriques as $rubrique) {
			$articles = $rubrique->getArticles();
			foreach ($articles as $article) {
				$this->genereFile($article);
			}
		}
	}
}