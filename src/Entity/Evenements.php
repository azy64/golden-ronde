<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementsRepository::class)
 */
class Evenements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeEvenements::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type_evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getTypeEvenement(): ?TypeEvenements
    {
        return $this->type_evenement;
    }

    public function setTypeEvenement(?TypeEvenements $type_evenement): self
    {
        $this->type_evenement = $type_evenement;

        return $this;
    }
}
