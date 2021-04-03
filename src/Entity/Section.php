<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
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
    private $titre;

    /**
     * @ORM\OneToOne(targetEntity=Slider::class, mappedBy="section", cascade={"persist", "remove"})
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="sections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

  

    public function getSlider(): ?Slider
    {
        return $this->slider;
    }

    public function setSlider(?Slider $slider): self
    {
        // unset the owning side of the relation if necessary
        if ($slider === null && $this->slider !== null) {
            $this->slider->setSection(null);
        }

        // set the owning side of the relation if necessary
        if ($slider !== null && $slider->getSection() !== $this) {
            $slider->setSection($this);
        }

        $this->slider = $slider;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(?int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getG(): ?Article
    {
        return $this->g;
    }

    public function setG(?Article $g): self
    {
        $this->g = $g;

        return $this;
    }

    public function genereSection($dir)
    {
        $path = $dir.'/section_'.$this->getId().'.php';
        $sectionFile = fopen($path, 'w');
        fwrite($sectionFile, '<section>');
        if (null !== $this->getTitre() && '' !== $this->getTitre()) { 
            fwrite($sectionFile, '<h2>'.$this->getTitre().'</h2>');
        }
       
    
        fwrite($sectionFile, $this->getContenu());
        if (null !== $this->getSlider())
        {
            $nom = $this->getSlider()->getNom();
            if (file_exists($dir.'/slider_'.$nom.'.php'))
            {
                $fichier = 'slider_'.$nom.'.php'; //si structure site distant différents dossiers, ajuster
                fwrite($sectionFile, '<?php include (\''.$fichier.'\'); ?>');
            }
        }
        fwrite($sectionFile, '</section>');
        fclose($sectionFile);
    }

   
}
