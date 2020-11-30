<?php

namespace App\Entity;

use App\Repository\RouteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RouteurRepository::class)
 */
class Routeur
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
     * @ORM\OneToMany(targetEntity=Prestation::class, mappedBy="routeur")
     */
    private $prestations;

    /**
     * @ORM\OneToMany(targetEntity=Base::class, mappedBy="routeur")
     */
    private $bases;

    /**
     * @ORM\OneToMany(targetEntity=Shoot::class, mappedBy="routeur")
     */
    private $shoots;

    /**
     * @ORM\ManyToMany(targetEntity=Plateform::class, mappedBy="routeur")
     */
    private $plateforms;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->bases = new ArrayCollection();
        $this->shoots = new ArrayCollection();
        $this->plateforms = new ArrayCollection();
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

    /**
     * @return Collection|Prestation[]
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
            $prestation->setRouteur($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getRouteur() === $this) {
                $prestation->setRouteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Base[]
     */
    public function getBases(): Collection
    {
        return $this->bases;
    }

    public function addBasis(Base $basis): self
    {
        if (!$this->bases->contains($basis)) {
            $this->bases[] = $basis;
            $basis->setRouteur($this);
        }

        return $this;
    }

    public function removeBasis(Base $basis): self
    {
        if ($this->bases->removeElement($basis)) {
            // set the owning side to null (unless already changed)
            if ($basis->getRouteur() === $this) {
                $basis->setRouteur(null);
            }
        }

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
            $shoot->setRouteur($this);
        }

        return $this;
    }

    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->removeElement($shoot)) {
            // set the owning side to null (unless already changed)
            if ($shoot->getRouteur() === $this) {
                $shoot->setRouteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plateform[]
     */
    public function getPlateforms(): Collection
    {
        return $this->plateforms;
    }

    public function addPlateform(Plateform $plateform): self
    {
        if (!$this->plateforms->contains($plateform)) {
            $this->plateforms[] = $plateform;
            $plateform->addRouteur($this);
        }

        return $this;
    }

    public function removePlateform(Plateform $plateform): self
    {
        if ($this->plateforms->removeElement($plateform)) {
            $plateform->removeRouteur($this);
        }

        return $this;
    }
}
