<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampagneRepository::class)
 */
class Campagne
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
     * @ORM\Column(type="string", length=5)
     */
    private $typeDeRemuneration;

    /**
     * @ORM\ManyToOne(targetEntity=Annonceur::class, inversedBy="campagnes")
     */
    private $annonceur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $test;

    /**
     * @ORM\Column(type="integer")
     */
    private $remuneration;

    /**
     * @ORM\OneToMany(targetEntity=Shoot::class, mappedBy="campagne")
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

    public function getTypeDeRemuneration(): ?string
    {
        return $this->typeDeRemuneration;
    }

    public function setTypeDeRemuneration(string $typeDeRemuneration): self
    {
        $this->typeDeRemuneration = $typeDeRemuneration;

        return $this;
    }

    public function getAnnonceur(): ?Annonceur
    {
        return $this->annonceur;
    }

    public function setAnnonceur(?Annonceur $annonceur): self
    {
        $this->annonceur = $annonceur;

        return $this;
    }

    public function getTest(): ?bool
    {
        return $this->test;
    }

    public function setTest(bool $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getRemuneration(): ?int
    {
        return $this->remuneration;
    }

    public function setRemuneration(int $remuneration): self
    {
        $this->remuneration = $remuneration;

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
            $shoot->setCampagne($this);
        }

        return $this;
    }

    public function removeShoot(Shoot $shoot): self
    {
        if ($this->shoots->removeElement($shoot)) {
            // set the owning side to null (unless already changed)
            if ($shoot->getCampagne() === $this) {
                $shoot->setCampagne(null);
            }
        }

        return $this;
    }
}
