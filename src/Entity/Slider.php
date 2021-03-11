<?php

namespace App\Entity;

use App\Repository\SliderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Image;

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
     * @ORM\Column(type="string", length=255)
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $section;

    /**
   * @ORM\ManyToMany(targetEntity="App\Entity\Image", cascade={"persist"})
   */
  private $images;

  public function __construct()
  {
      $this->images = new ArrayCollection();
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

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): self
    {
        $this->section = $section;

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

    public function genereSlider($dir)
    {
      
         $path = $dir."/slider_".$this->getNom().".php";
        $sliderFile = fopen($path, 'w');
       
        fwrite($sliderFile,'<div class="container"> ');
        foreach ($this->getImages() as $image)
        {
            fwrite($sliderFile, '<figure class="slide"> ');
          
            fwrite($sliderFile, ' <img class="clickable" src="petites_images/'.$image->getNom().'" width=150 height=100 onclick="displaySlides(src) ;"> ');
            fwrite($sliderFile, '<figcaption hidden>'.$image->getLegend().'</figcaption>');
            fwrite($sliderFile, '</figure> ');
        }

        fwrite($sliderFile,'</div>');
        fclose($sliderFile);
    }
}
