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

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setSection($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSection() === $this) {
                $article->setSection(null);
            }
        }

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

   
}
