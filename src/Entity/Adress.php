<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=adressRepository::class)
 */
class Adress
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
    private $physique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $relative_accueil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $relative_fichiers;

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

    public function getPhysique(): ?string
    {
        return $this->physique;
    }

    public function setPhysique(string $physique): self
    {
        $this->physique = $physique;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getRelativeAccueil(): ?string
    {
        return $this->relative_accueil;
    }

    public function setRelativeAccueil(string $relative_accueil): self
    {
        $this->relative_accueil = $relative_accueil;

        return $this;
    }

    public function getRelativeFichiers(): ?string
    {
        return $this->relative_fichiers;
    }

    public function setRelativeFichiers(string $relative_fichiers): self
    {
        $this->relative_fichiers = $relative_fichiers;

        return $this;
    }
}
