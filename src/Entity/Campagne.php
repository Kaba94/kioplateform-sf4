<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
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
}
