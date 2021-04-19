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
    private $titre= 'sans';

    /**
     * @ORM\OneToOne(targetEntity=Slider::class, mappedBy="section", cascade={"persist", "remove"})
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="sections")
     * @ORM\JoinColumn(nullable=true)
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

    /**
     * @ORM\OneToOne(targetEntity=Image::class, mappedBy="section", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=HomePage::class, inversedBy="section")
     */
    private $homePage;

    


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

   

    public function genereSection($dir, $imgs, $image)
    {
        $path = $dir.'/section_'.$this->getId().'.php';
        $sectionFile = fopen($path, 'w');
        fwrite($sectionFile, '<section>');
        if (null !== $this->getTitre() && 'sans' !== $this->getTitre()) { 
            fwrite($sectionFile, '<h2>'.$this->getTitre().'</h2>');
        }
       
        fwrite($sectionFile, $this->getContenu());

        if (null !== $this->getSlider())
        {
            $nom = $this->getSlider()->getNom();
            if (!file_exists($dir.'/slider_'.$nom.'.php'))
            {
                $this->getSlider()->genereSlider($dir, $imgs);
            }
            $fichier = $dir.'/slider_'.$nom.'.php'; //si structure site distant différents dossiers, ajuster
            fwrite($sectionFile, '<?php include (\''.$fichier.'\'); ?>');
        }
        else if (null !== $this->getImage()) {
            $nom = $this->getImage()->getNom();
            $alt = $this->getImage()->getAlt();
            fwrite($sectionFile, '<img src="'.$image.$nom.'" alt="'.$alt.'" />');
        }
        fwrite($sectionFile, '</section>');
        fclose($sectionFile);
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        // unset the owning side of the relation if necessary
        if ($image === null && $this->image !== null) {
            $this->image->setSection(null);
        }

        // set the owning side of the relation if necessary
        if ($image !== null && $image->getSection() !== $this) {
            $image->setSection($this);
        }

        $this->image = $image;

        return $this;
    }

    public function getHomePage(): ?HomePage
    {
        return $this->homePage;
    }

    public function setHomePage(?HomePage $homePage): self
    {
        $this->homePage = $homePage;

        return $this;
    }

 

   
}
