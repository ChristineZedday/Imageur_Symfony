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
}
