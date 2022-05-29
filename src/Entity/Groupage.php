<?php

namespace App\Entity;

use App\Repository\GroupageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupageRepository::class)
 */
class Groupage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Evenements::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $evenement;

    /**
     * @ORM\ManyToOne(targetEntity=Pointaux::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $pointau;

    /**
     * @ORM\ManyToOne(targetEntity=LaRonde::class, inversedBy="groupages")
     */
    private $laRonde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvenement(): ?Evenements
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenements $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getPointau(): ?Pointaux
    {
        return $this->pointau;
    }

    public function setPointau(?Pointaux $pointau): self
    {
        $this->pointau = $pointau;

        return $this;
    }

    public function getLaRonde(): ?LaRonde
    {
        return $this->laRonde;
    }

    public function setLaRonde(?LaRonde $laRonde): self
    {
        $this->laRonde = $laRonde;

        return $this;
    }
}
