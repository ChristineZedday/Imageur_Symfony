<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Section;



/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $auteur;


    /**
     * @ORM\OneToMany(targetEntity=Slider::class, mappedBy="article")
     */
    private $sliders;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="article")
     * @ORM\OrderBy({"rang" = "ASC"})
     */
    private $sections;

    /**
     * @ORM\ManyToOne(targetEntity=Rubrique::class, inversedBy="articles")
     */
    private $rubrique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description ='';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords ='';

    /**
     * @ORM\ManyToOne(targetEntity=Aside::class, inversedBy="articles")
     */
    private $aside;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang;

    /**
     * @ORM\ManyToMany(targetEntity=Javascript::class, inversedBy="articles")
     */
    private $javascript;

    /**
     * @ORM\ManyToMany(targetEntity=CSS::class, inversedBy="articles")
     */
    private $css;


   

   

    

    public function __construct($auteur)
    {
        $this->sliders = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->auteur = $auteur;
        $this->javascript = new ArrayCollection();
        $this->css = new ArrayCollection();
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
            $slider->setArticle($this);
        }

        return $this;
    }

    public function removeSlider(Slider $slider): self
    {
        if ($this->sliders->removeElement($slider)) {
            // set the owning side to null (unless already changed)
            if ($slider->getArticle() === $this) {
                $slider->setArticle(null);
            }
        }

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
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setG($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getG() === $this) {
                $section->setG(null);
            }
        }

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

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

    public function getAside(): ?Aside
    {
        return $this->aside;
    }

    public function setAside(?Aside $aside): self
    {
        $this->aside = $aside;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

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

   

   


}
