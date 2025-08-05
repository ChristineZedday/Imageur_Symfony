<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\CSSRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CSSRepository::class)
 */
class CSS
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
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="css")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity=HomePage::class, mappedBy="css")
     */
    private $homePages;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurTexte;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurFond;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurAcote;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurTitre1;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurTitre2;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurLiens;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurLiensVisites;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurFondSommaire;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurTexteSommaire;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurLiensSommaire;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurLiensVisitesSommaire;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $couleurTexteAcote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleurTitreAcote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleurTitre3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $policeTexte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $policeTitre1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PoliceTitre2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $policeTitre3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $structure;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="css_files")
     */
    private $site;

   

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->homePages = new ArrayCollection();
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
            $article->addCss($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeCss($this);
        }

        return $this;
    }

    /**
     * @return Collection|HomePage[]
     */
    public function getHomePages(): Collection
    {
        return $this->homePages;
    }

    public function addHomePage(HomePage $homePage): self
    {
        if (!$this->homePages->contains($homePage)) {
            $this->homePages[] = $homePage;
            $homePage->addCss($this);
        }

        return $this;
    }

    public function removeHomePage(HomePage $homePage): self
    {
        if ($this->homePages->removeElement($homePage)) {
            $homePage->removeCss($this);
        }

        return $this;
    }

    public function getCouleurTexte(): ?string
    {
        return $this->couleurTexte;
    }

    public function setCouleurTexte(?string $couleurTexte): self
    {
        $this->couleurTexte = $couleurTexte;

        return $this;
    }

    public function getCouleurFond(): ?string
    {
        return $this->couleurFond;
    }

    public function setCouleurFond(?string $couleurFond): self
    {
        $this->couleurFond = $couleurFond;

        return $this;
    }

    public function getCouleurAcote(): ?string
    {
        return $this->couleurAcote;
    }

    public function setCouleurAcote(?string $couleurAcote): self
    {
        $this->couleurAcote = $couleurAcote;

        return $this;
    }

    public function getCouleurTitre1(): ?string
    {
        return $this->couleurTitre1;
    }

    public function setCouleurTitre1(?string $couleurTitre1): self
    {
        $this->couleurTitre1 = $couleurTitre1;

        return $this;
    }

    public function getCouleurTitre2(): ?string
    {
        return $this->couleurTitre2;
    }

    public function setCouleurTitre2(?string $couleurTitre2): self
    {
        $this->couleurTitre2 = $couleurTitre2;

        return $this;
    }

    public function getCouleurLiens(): ?string
    {
        return $this->couleurLiens;
    }

    public function setCouleurLiens(?string $couleurLiens): self
    {
        $this->couleurLiens = $couleurLiens;

        return $this;
    }

    public function getCouleurLiensVisites(): ?string
    {
        return $this->couleurLiensVisites;
    }

    public function setCouleurLiensVisites(?string $couleurLiensVisites): self
    {
        $this->couleurLiensVisites = $couleurLiensVisites;

        return $this;
    }

    public function getCouleurFondSommaire(): ?string
    {
        return $this->couleurFondSommaire;
    }

    public function setCouleurFondSommaire(?string $couleurFondSommaire): self
    {
        $this->couleurFondSommaire = $couleurFondSommaire;

        return $this;
    }

    public function getCouleurTexteSommaire(): ?string
    {
        return $this->couleurTexteSommaire;
    }

    public function setCouleurTexteSommaire(?string $couleurTexteSommaire): self
    {
        $this->couleurTexteSommaire = $couleurTexteSommaire;

        return $this;
    }

    public function getCouleurLiensSommaire(): ?string
    {
        return $this->couleurLiensSommaire;
    }

    public function setCouleurLiensSommaire(?string $couleurLiensSommaire): self
    {
        $this->couleurLiensSommaire = $couleurLiensSommaire;

        return $this;
    }

    public function getCouleurLiensVisitesSommaire(): ?string
    {
        return $this->couleurLiensVisitesSommaire;
    }

    public function setCouleurLiensVisitesSommaire(?string $couleurLiensVisitesSommaire): self
    {
        $this->couleurLiensVisitesSommaire = $couleurLiensVisitesSommaire;

        return $this;
    }

    public function getCouleurTexteAcote(): ?string
    {
        return $this->couleurTexteAcote;
    }

    public function setCouleurTexteAcote(?string $couleurTexteAcote): self
    {
        $this->couleurTexteAcote = $couleurTexteAcote;

        return $this;
    }

    public function getCouleurTitreAcote(): ?string
    {
        return $this->couleurTitreAcote;
    }

    public function setCouleurTitreAcote(?string $couleurTitreAcote): self
    {
        $this->couleurTitreAcote = $couleurTitreAcote;

        return $this;
    }

    public function getCouleurTitre3(): ?string
    {
        return $this->couleurTitre3;
    }

    public function setCouleurTitre3(?string $couleurTitre3): self
    {
        $this->couleurTitre3 = $couleurTitre3;

        return $this;
    }

    public function getPoliceTexte(): ?string
    {
        return $this->policeTexte;
    }

    public function setPoliceTexte(?string $policeTexte): self
    {
        $this->policeTexte = $policeTexte;

        return $this;
    }

    public function getPoliceTitre1(): ?string
    {
        return $this->policeTitre1;
    }

    public function setPoliceTitre1(?string $policeTitre1): self
    {
        $this->policeTitre1 = $policeTitre1;

        return $this;
    }

    public function getPoliceTitre2(): ?string
    {
        return $this->PoliceTitre2;
    }

    public function setPoliceTitre2(?string $PoliceTitre2): self
    {
        $this->PoliceTitre2 = $PoliceTitre2;

        return $this;
    }

    public function getPoliceTitre3(): ?string
    {
        return $this->policeTitre3;
    }

    public function setPoliceTitre3(?string $policeTitre3): self
    {
        $this->policeTitre3 = $policeTitre3;

        return $this;
    }

    public function getStructure(): ?string
    {
        return $this->structure;
    }

    public function setStructure(?string $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }

   
}
