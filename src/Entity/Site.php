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
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Pointaux::class, mappedBy="site", orphanRemoval=true, cascade={"persist"})
     */
    private $pointauxes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $superviseur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_pointeaux;


    public function __construct()
    {
        $this->laRondes = new ArrayCollection();
        $this->pointauxes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, LaRonde>
     */
    public function getLaRondes(): Collection
    {
        return $this->laRondes;
    }

    public function addLaRonde(LaRonde $laRonde): self
    {
        if (!$this->laRondes->contains($laRonde)) {
            $this->laRondes[] = $laRonde;
            $laRonde->setSite($this);
        }

        return $this;
    }

    public function removeLaRonde(LaRonde $laRonde): self
    {
        if ($this->laRondes->removeElement($laRonde)) {
            // set the owning side to null (unless already changed)
            if ($laRonde->getSite() === $this) {
                $laRonde->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pointaux>
     */
    public function getPointauxes(): Collection
    {
        return $this->pointauxes;
    }

    public function addPointaux(Pointaux $pointaux): self
    {
        if (!$this->pointauxes->contains($pointaux)) {
            $this->pointauxes[] = $pointaux;
            $pointaux->setSite($this);
        }

        return $this;
    }

    public function removePointaux(Pointaux $pointaux): self
    {
        if ($this->pointauxes->removeElement($pointaux)) {
            // set the owning side to null (unless already changed)
            if ($pointaux->getSite() === $this) {
                $pointaux->setSite(null);
            }
        }

        return $this;
    }

    public function getSuperviseur(): ?string
    {
        return $this->superviseur;
    }

    public function setSuperviseur(string $superviseur): self
    {
        $this->superviseur = $superviseur;

        return $this;
    }

    public function getNombrePointeaux(): ?int
    {
        return $this->nombre_pointeaux;
    }

    public function setNombrePointeaux(int $nombre_pointeaux): self
    {
        $this->nombre_pointeaux = $nombre_pointeaux;

        return $this;
    }
}
