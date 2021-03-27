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
     * @ORM\Column(type="blob", nullable=true)
     */
    private $Contenu;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="section")
     */
    private $articles;

    /**
     * @ORM\OneToOne(targetEntity=Slider::class, mappedBy="section", cascade={"persist", "remove"})
     */
    private $slider;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="sections")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    
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
        return $this->Contenu;
    }

    public function setContenu($Contenu): self
    {
        $this->Contenu = $Contenu;

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

   
}
