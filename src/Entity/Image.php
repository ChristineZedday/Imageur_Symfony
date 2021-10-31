<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
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
    private $alt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $legend;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pour;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vignette;

    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\Slider", cascade={"persist"})
    //  *  @ORM\JoinTable(name="slider_image",
    //  * joinColumns={@ORM\JoinColumn(name="user_id", *referencedColumnName="id", nullable=true)}
    //  *)
    //  */
    // private $sliders;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang;

    /**
     * @ORM\OneToOne(targetEntity=Section::class, inversedBy="image", cascade={"persist"})
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity=Rubrique::class, inversedBy="images")
     */
    private $rubrique;

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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(?string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    public function getPour(): ?string
    {
        return $this->pour;
    }

    public function setPour(string $pour): self
    {
        $this->pour = $pour;

        return $this;
    }

    public function getVignette(): ?bool
    {
        return $this->vignette;
    }

    public function setVignette(?bool $vignette): self
    {
        $this->vignette = $vignette;

        return $this;
    }

    // /**
    //  * @return Collection|Slider[]
    //  */
    // public function getSliders(): Collection
    // {
    //     return $this->sliders;
    // }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(?int $rang): self
    {
        $this->rang = $rang;

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

    public function getRubrique(): ?Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }
}
