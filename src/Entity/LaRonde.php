<?php

namespace App\Entity;

use App\Repository\LaRondeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LaRondeRepository::class)
 */
class LaRonde
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="laRondes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $agent;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="laRondes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $materiel;

    /**
     * @ORM\OneToMany(targetEntity=Groupage::class, mappedBy="laRonde", cascade={"persist"})
     */
    private $groupages;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->pointauxes = new ArrayCollection();
        $this->groupages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

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

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }

    /**
     * @return Collection<int, Groupage>
     */
    public function getGroupages(): Collection
    {
        return $this->groupages;
    }

    public function addGroupage(Groupage $groupage): self
    {
        if (!$this->groupages->contains($groupage)) {
            $this->groupages[] = $groupage;
            $groupage->setLaRonde($this);
        }

        return $this;
    }

    public function removeGroupage(Groupage $groupage): self
    {
        if ($this->groupages->removeElement($groupage)) {
            // set the owning side to null (unless already changed)
            if ($groupage->getLaRonde() === $this) {
                $groupage->setLaRonde(null);
            }
        }

        return $this;
    }
}
