<?php

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
    private $couleurText;

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

    public function getCouleurText(): ?string
    {
        return $this->couleurText;
    }

    public function setCouleurText(?string $couleurText): self
    {
        $this->couleurText = $couleurText;

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
}
