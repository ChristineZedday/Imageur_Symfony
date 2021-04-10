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
     * @ORM\OneToOne(targetEntity=Section::class, inversedBy="slider", cascade={"persist", "remove"})
     */
    private $section;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isGenerated;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->setIsGenerated(false);
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

    public function genereSlider($dir, $imgs)
    {
        $path = $dir.'/slider_'.$this->getNom().'.php';
        $sliderFile = fopen($path, 'w');

        fwrite($sliderFile, '<div class="container"> ');
        foreach ($this->getImages() as $image) {
            fwrite($sliderFile, '<figure class="slide"> ');
            $src = $imgs.$image->getNom();
            fwrite($sliderFile, ' <img class="clickable" src="'.$src.'" width=150 height=100 onclick="displaySlides(src) ;" /> ');
            fwrite($sliderFile, '<figcaption hidden>'.$image->getLegend().'</figcaption>');
            fwrite($sliderFile, '</figure> ');
        }

        fwrite($sliderFile, '</div>');
        fclose($sliderFile);
       
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
}
