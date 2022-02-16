<?php

namespace App\Entity;

use App\Repository\SiteRepository;
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
}
