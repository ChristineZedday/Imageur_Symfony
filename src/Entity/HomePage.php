<?php

namespace App\Entity;

use App\Repository\HomePageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\Includor;

/**
 * @ORM\Entity(repositoryClass=HomePageRepository::class)
 */
class HomePage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Aside::class)
     */
    private $aside;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAside(): ?Aside
    {
        return $this->aside;
    }

    public function setAside(?Aside $aside): self
    {
        $this->aside = $aside;

        return $this;
    }

    public function genereHomePage($dir, $includes, $image, $auteur)
    {
        $path = $dir.'/index.php';

        $rel_includes = '/fichiers';
       
        $articleFile = fopen($path, 'w');

        fwrite($articleFile, '<!DOCTYPE html><html lang="fr"><head><title>'.$this->getTitre().'</title>');
        fwrite($articleFile, '<meta name="author" content="'.$auteur.'" />');
        fwrite($articleFile, '<meta name="description" content="'.$this->getDescription().'"/>');
        fwrite($articleFile, '<meta name="keywords" content="'.$this->getKeywords().'"/>');
    //     $metas = new Metas();
    //     $includor = new Includor($container);
    //    $includor->includeFileHomepage($this, $metas);
     fwrite($articleFile, '</head><body><div id = "conteneur">');
        if (file_exists($includes.'/sommaire.php'))
        { fwrite($articleFile, '<div><?php include(\''.$rel_includes.'sommaire.php\'); ?></div>');}
        fwrite($articleFile, '<div class="element" id="main"><article class="contenu">');
        fwrite($articleFile, '<h1>'.$this->getTitre().'</h1>');
      
      fwrite($articleFile, $this->getContenu());
      
    
      if (!file_exists($includes.'/footer.php'))
        {
            $footer = new Footer();
            $footer->genereFooter($includes,'');}
            fwrite($articleFile, '<?php include(\''.$rel_includes.'footer.php\'); ?>');

        fwrite($articleFile, '</article></div>');
       if ($this->GetAside())
        {
            fwrite($articleFile, '<div class=element id="acote">'); 
            if (file_exists($includes.'/aside_'.$this->getAside()->getNom().'.php'))
            {
                fwrite($articleFile, '<?php include(\''.$rel_includes.'aside_'.$this->getAside()->getNom().'.php\'); ?>');
            }
            fwrite($articleFile, '</div>');   
        }
        fwrite($articleFile, '</div>');   
        fwrite($articleFile, '</body></html>');
        fclose($articleFile);
        
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}

