<?php

namespace App\Entity;

use App\Repository\BaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BaseRepository::class)
 */
class Base
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Routeur::class, inversedBy="bases")
     */
    private $routeur;

    /**
     * @ORM\ManyToOne(targetEntity=Plateform::class, inversedBy="base")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plateform;

    /**
     * @ORM\OneToMany(targetEntity=Shoot::class, mappedBy="base")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $shoot->setBase($this);
        }

        return $this;
    }

    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->removeElement($shoot)) {
            // set the owning side to null (unless already changed)
            if ($shoot->getBase() === $this) {
                $shoot->setBase(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
