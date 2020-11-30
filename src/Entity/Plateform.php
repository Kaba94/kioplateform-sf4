<?php

namespace App\Entity;

use App\Repository\PlateformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=PlateformRepository::class)
 * @UniqueEntity(fields={"nom"}, message="There is already an plateform with this name")
 */
class Plateform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Prestation::class, mappedBy="plateform")
     */
    private $prestations;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="plateforms")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Base::class, mappedBy="plateform")
     */
    private $base;

    /**
     * @ORM\OneToMany(targetEntity=Shoot::class, mappedBy="plateform")
     */
    private $shoots;

    /**
     * @ORM\ManyToMany(targetEntity=Routeur::class, inversedBy="plateforms")
     */
    private $routeur;

    public function __construct()
    {
        $this->prestations = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->base = new ArrayCollection();
        $this->shoots = new ArrayCollection();
        $this->routeur = new ArrayCollection();
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
            $prestation->setPlateform($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getPlateform() === $this) {
                $prestation->setPlateform(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|Base[]
     */
    public function getBase(): Collection
    {
        return $this->base;
    }

    public function addBase(Base $base): self
    {
        if (!$this->base->contains($base)) {
            $this->base[] = $base;
            $base->setPlateform($this);
        }

        return $this;
    }

    public function removeBase(Base $base): self
    {
        if ($this->base->removeElement($base)) {
            // set the owning side to null (unless already changed)
            if ($base->getPlateform() === $this) {
                $base->setPlateform(null);
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
            $shoot->setPlateform($this);
        }

        return $this;
    }

    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->removeElement($shoot)) {
            // set the owning side to null (unless already changed)
            if ($shoot->getPlateform() === $this) {
                $shoot->setPlateform(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Routeur[]
     */
    public function getRouteur(): Collection
    {
        return $this->routeur;
    }

    public function addRouteur(Routeur $routeur): self
    {
        if (!$this->routeur->contains($routeur)) {
            $this->routeur[] = $routeur;
        }

        return $this;
    }

    public function removeRouteur(Routeur $routeur): self
    {
        $this->routeur->removeElement($routeur);

        return $this;
    }
}
