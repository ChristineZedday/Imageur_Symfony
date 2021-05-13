<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Entity;

use App\Repository\JavascriptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JavascriptRepository::class)
 */
class Javascript
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
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="javascript")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=HomePage::class, mappedBy="javascript")
     */
    private $homes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->homes = new ArrayCollection();
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
            $article->addJavascript($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeJavascript($this);
        }

        return $this;
    }

    /**
     * @return Collection|HomePage[]
     */
    public function getHomes(): Collection
    {
        return $this->homes;
    }

    public function addHome(HomePage $home): self
    {
        if (!$this->homes->contains($home)) {
            $this->homes[] = $home;
            $home->setJavascript($this);
        }

        return $this;
    }

    public function removeHome(HomePage $home): self
    {
        if ($this->homes->removeElement($home)) {
            // set the owning side to null (unless already changed)
            if ($home->getJavascript() === $this) {
                $home->setJavascript(null);
            }
        }

        return $this;
    }
}
