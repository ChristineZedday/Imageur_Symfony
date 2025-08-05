<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
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
     * @ORM\Column(type="string", length=255)
     */
    private $localurl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $weburl;

    /**
     * @ORM\OneToMany(targetEntity=Adress::class, mappedBy="site")
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=Rubrique::class, mappedBy="site_id")
     */
    private $rubriques;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->rubriques = new ArrayCollection();
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

    public function getLocalurl(): ?string
    {
        return $this->localurl;
    }

    public function setLocalurl(string $localurl): self
    {
        $this->localurl = $localurl;

        return $this;
    }

    public function getWeburl(): ?string
    {
        return $this->weburl;
    }

    public function setWeburl(string $weburl): self
    {
        $this->weburl = $weburl;

        return $this;
    }

    /**
     * @return Collection|Adress[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adress $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setSite($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getSite() === $this) {
                $adress->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rubrique[]
     */
    public function getRubriques(): Collection
    {
        return $this->rubriques;
    }

    public function addRubrique(Rubrique $rubrique): self
    {
        if (!$this->rubriques->contains($rubrique)) {
            $this->rubriques[] = $rubrique;
            $rubrique->setSiteId($this);
        }

        return $this;
    }

    public function removeRubrique(Rubrique $rubrique): self
    {
        if ($this->rubriques->removeElement($rubrique)) {
            // set the owning side to null (unless already changed)
            if ($rubrique->getSiteId() === $this) {
                $rubrique->setSiteId(null);
            }
        }

        return $this;
    }
}
