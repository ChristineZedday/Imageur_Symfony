<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\SliderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SliderRepository::class)
 */
class Slider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", cascade={"persist"})
     * @ORM\OrderBy({"rang" = "ASC"})
     */
    private $images;

    /**
     * @ORM\OneToOne(targetEntity=Section::class, inversedBy="slider", cascade={"persist"})
     */
    private $section;

    /**
     * @ORM\ManyToMany(targetEntity=Rubrique::class, inversedBy="sliders")
     */
    private $rubriquesPiocheImages;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vignetteverticale;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->rubriquesPiocheImages = new ArrayCollection();
    }

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

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        $this->images->removeElement($image);

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getIsGenerated(): ?bool
    {
        return $this->isGenerated;
    }

    public function setIsGenerated(?bool $isGenerated): self
    {
        $this->isGenerated = $isGenerated;

        return $this;
    }

    /**
     * @return Collection|Rubrique[]
     */
    public function getRubriquesPiocheImages(): Collection
    {
        return $this->rubriquesPiocheImages;
    }

    public function addRubriquesPiocheImage(Rubrique $rubriquesPiocheImage): self
    {
        if (!$this->rubriquesPiocheImages->contains($rubriquesPiocheImage)) {
            $this->rubriquesPiocheImages[] = $rubriquesPiocheImage;
        }

        return $this;
    }

    public function removeRubriquesPiocheImage(Rubrique $rubriquesPiocheImage): self
    {
        $this->rubriquesPiocheImages->removeElement($rubriquesPiocheImage);

        return $this;
    }

    public function getVignetteverticale(): ?bool
    {
        return $this->vignetteverticale;
    }

    public function setVignetteverticale(?bool $vignetteverticale): self
    {
        $this->vignetteverticale = $vignetteverticale;

        return $this;
    }
}
