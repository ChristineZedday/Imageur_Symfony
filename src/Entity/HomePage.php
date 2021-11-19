<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\HomePageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="homePage")
     */
    private $sections;

    /**
     * @ORM\ManyToMany(targetEntity=Javascript::class, inversedBy="homes")
     */
    private $javascript;

    /**
     * @ORM\ManyToMany(targetEntity=CSS::class, inversedBy="homePages")
     */
    private $css;

    /**
     * @ORM\ManyToOne(targetEntity=Foot::class, inversedBy="homePages")
     */
    private $footer;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->css = new ArrayCollection();
        $this->javascript = new ArrayCollection();
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

    public function getAside(): ?Aside
    {
        return $this->aside;
    }

    public function setAside(?Aside $aside): self
    {
        $this->aside = $aside;

        return $this;
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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
            $section->setHomePage($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->section->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getHomePage() === $this) {
                $section->setHomePage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CSS[]
     */
    public function getCss(): Collection
    {
        return $this->css;
    }

    public function addCss(CSS $css): self
    {
        if (!$this->css->contains($css)) {
            $this->css[] = $css;
        }

        return $this;
    }

    public function removeCss(CSS $css): self
    {
        $this->css->removeElement($css);

        return $this;
    }

    public function getFooter(): ?Foot
    {
        return $this->footer;
    }

    public function setFooter(?Foot $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * @return Collection|Javascript[]
     */
    public function getJavascript(): Collection
    {
        return $this->javascript;
    }

    public function addJavascript(Javascript $javascript): self
    {
        if (!$this->javascript->contains($javascript)) {
            $this->javascript[] = $javascript;
        }

        return $this;
    }

    public function removeJavascript(Javascript $javascript): self
    {
        $this->javascript->removeElement($javascript);

        return $this;
    }
}
