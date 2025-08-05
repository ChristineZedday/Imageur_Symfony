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

    /**
     * @ORM\OneToMany(targetEntity=HomePage::class, mappedBy="site")
     */
    private $homePages;

    /**
     * @ORM\OneToMany(targetEntity=Aside::class, mappedBy="site")
     */
    private $asides;

    /**
     * @ORM\OneToMany(targetEntity=Foot::class, mappedBy="site")
     */
    private $footers;

    /**
     * @ORM\OneToMany(targetEntity=CSS::class, mappedBy="site")
     */
    private $css_files;

    /**
     * @ORM\OneToMany(targetEntity=JavaScript::class, mappedBy="site")
     */
    private $javaScripts;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->rubriques = new ArrayCollection();
        $this->homePages = new ArrayCollection();
        $this->asides = new ArrayCollection();
        $this->footers = new ArrayCollection();
        $this->css_files = new ArrayCollection();
        $this->javaScripts = new ArrayCollection();
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
            $homePage->setSite($this);
        }

        return $this;
    }

    public function removeHomePage(HomePage $homePage): self
    {
        if ($this->homePages->removeElement($homePage)) {
            // set the owning side to null (unless already changed)
            if ($homePage->getSite() === $this) {
                $homePage->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Aside[]
     */
    public function getAsides(): Collection
    {
        return $this->asides;
    }

    public function addAside(Aside $aside): self
    {
        if (!$this->asides->contains($aside)) {
            $this->asides[] = $aside;
            $aside->setSite($this);
        }

        return $this;
    }

    public function removeAside(Aside $aside): self
    {
        if ($this->asides->removeElement($aside)) {
            // set the owning side to null (unless already changed)
            if ($aside->getSite() === $this) {
                $aside->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Foot[]
     */
    public function getFooters(): Collection
    {
        return $this->footers;
    }

    public function addFooter(Foot $footer): self
    {
        if (!$this->footers->contains($footer)) {
            $this->footers[] = $footer;
            $footer->setSite($this);
        }

        return $this;
    }

    public function removeFooter(Foot $footer): self
    {
        if ($this->footers->removeElement($footer)) {
            // set the owning side to null (unless already changed)
            if ($footer->getSite() === $this) {
                $footer->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CSS[]
     */
    public function getCssFiles(): Collection
    {
        return $this->css_files;
    }

    public function addCssFile(CSS $cssFile): self
    {
        if (!$this->css_files->contains($cssFile)) {
            $this->css_files[] = $cssFile;
            $cssFile->setSite($this);
        }

        return $this;
    }

    public function removeCssFile(CSS $cssFile): self
    {
        if ($this->css_files->removeElement($cssFile)) {
            // set the owning side to null (unless already changed)
            if ($cssFile->getSite() === $this) {
                $cssFile->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JavaScript[]
     */
    public function getJavaScripts(): Collection
    {
        return $this->javaScripts;
    }

    public function addJavaScript(JavaScript $javaScript): self
    {
        if (!$this->javaScripts->contains($javaScript)) {
            $this->javaScripts[] = $javaScript;
            $javaScript->setSite($this);
        }

        return $this;
    }

    public function removeJavaScript(JavaScript $javaScript): self
    {
        if ($this->javaScripts->removeElement($javaScript)) {
            // set the owning side to null (unless already changed)
            if ($javaScript->getSite() === $this) {
                $javaScript->setSite(null);
            }
        }

        return $this;
    }
}
