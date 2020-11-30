<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", precision=6, scale=2)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Routeur::class, inversedBy="prestations")
     */
    private $routeur;

    /**
     * @ORM\ManyToOne(targetEntity=Plateform::class, inversedBy="prestations")
     */
    private $plateform;

    /**
     * @ORM\OneToMany(targetEntity=Shoot::class, mappedBy="prestation")
     */
    private $shoots;

    public function __construct()
    {
        $this->shoots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getRouteur(): ?Routeur
    {
        return $this->routeur;
    }

    public function setRouteur(?Routeur $routeur): self
    {
        $this->routeur = $routeur;

        return $this;
    }

    public function getPlateform(): ?Plateform
    {
        return $this->plateform;
    }

    public function setPlateform(?Plateform $plateform): self
    {
        $this->plateform = $plateform;

        return $this;
    }

    /**
     * @return Collection|Shoot[]
     */
    public function getShoots(): Collection
    {
        return $this->shoots;
    }

    public function addShoot(Shoot $shoot): self
    {
        if (!$this->shoots->contains($shoot)) {
            $this->shoots[] = $shoot;
            $shoot->setPrestation($this);
        }

        return $this;
    }

    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->removeElement($shoot)) {
            // set the owning side to null (unless already changed)
            if ($shoot->getPrestation() === $this) {
                $shoot->setPrestation(null);
            }
        }

        return $this;
    }

}
