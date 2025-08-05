<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RubriqueRepository::class)
 */
class Rubrique
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
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="rubrique")
     * @ORM\OrderBy({"rang" = "ASC"})
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="rubrique")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity=Slider::class, mappedBy="rubriquesPiocheImages")
     */
    private $sliders;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=0, nullable=true)
     */
    private $rang;

   

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->sliders = new ArrayCollection();
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

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
            $article->setRubrique($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getRubrique() === $this) {
                $article->setRubrique(null);
            }
        }

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
            $image->setRubrique($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRubrique() === $this) {
                $image->setRubrique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Slider[]
     */
    public function getSliders(): Collection
    {
        return $this->sliders;
    }

    public function addSlider(Slider $slider): self
    {
        if (!$this->sliders->contains($slider)) {
            $this->sliders[] = $slider;
            $slider->addRubriquesPiocheImage($this);
        }

        return $this;
    }

    public function removeSlider(Slider $slider): self
    {
        if ($this->sliders->removeElement($slider)) {
            $slider->removeRubriquesPiocheImage($this);
        }

        return $this;
    }

    public function getRang(): ?string
    {
        return $this->rang;
    }

    public function setRang(?string $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

     /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="rubriques")
     */
    private $site;

 public function getSite(): ?Site
    {
        return $this->getSite;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
   
}
