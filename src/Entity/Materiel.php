<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $radio;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ronde;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $lamp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ivvadr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCle(): ?bool
    {
        return $this->cle;
    }

    public function setCle(?bool $keys): self
    {
        $this->cle = $keys;

        return $this;
    }

    public function isRadio(): ?bool
    {
        return $this->radio;
    }

    public function setRadio(bool $radio): self
    {
        $this->radio = $radio;

        return $this;
    }

    public function isPhone(): ?bool
    {
        return $this->phone;
    }

    public function setPhone(?bool $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function isRonde(): ?bool
    {
        return $this->ronde;
    }

    public function setRonde(?bool $round): self
    {
        $this->ronde = $round;

        return $this;
    }

    public function isLamp(): ?bool
    {
        return $this->lamp;
    }

    public function setLamp(?bool $torche): self
    {
        $this->lamp = $torche;

        return $this;
    }

    public function isContact(): ?bool
    {
        return $this->contact;
    }

    public function setContact(?bool $key_car): self
    {
        $this->contact = $key_car;

        return $this;
    }

    public function isIvvadr(): ?bool
    {
        return $this->ivvadr;
    }

    public function setIvvadr(?bool $ivvadr): self
    {
        $this->ivvadr = $ivvadr;

        return $this;
    }
}
