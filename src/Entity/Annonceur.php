<?php

namespace App\Entity;

use App\Repository\AnnonceurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AnnonceurRepository::class)
 * @UniqueEntity(fields={"nom"}, message="There is already an annonceur with this name")
 */
class Annonceur
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
     * @ORM\Column(type="string", length=50)
     */
    private $nomDuContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $skypeDuContact;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $emailDuContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroSiret;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $emailComptabilite;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $contactComptabilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlPlateform;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mdpPlateform;

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

    public function getNomDuContact(): ?string
    {
        return $this->nomDuContact;
    }

    public function setNomDuContact(string $nomDuContact): self
    {
        $this->nomDuContact = $nomDuContact;

        return $this;
    }

    public function getSkypeDuContact(): ?string
    {
        return $this->skypeDuContact;
    }

    public function setSkypeDuContact(?string $skypeDuContact): self
    {
        $this->skypeDuContact = $skypeDuContact;

        return $this;
    }

    public function getEmailDuContact(): ?string
    {
        return $this->emailDuContact;
    }

    public function setEmailDuContact(string $emailDuContact): self
    {
        $this->emailDuContact = $emailDuContact;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostale(): ?int
    {
        return $this->codePostale;
    }

    public function setCodePostale(int $codePostale): self
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNumeroSiret(): ?int
    {
        return $this->numeroSiret;
    }

    public function setNumeroSiret(int $numeroSiret): self
    {
        $this->numeroSiret = $numeroSiret;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(?int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getEmailComptabilite(): ?string
    {
        return $this->emailComptabilite;
    }

    public function setEmailComptabilite(?string $emailComptabilite): self
    {
        $this->emailComptabilite = $emailComptabilite;

        return $this;
    }

    public function getContactComptabilite(): ?string
    {
        return $this->contactComptabilite;
    }

    public function setContactComptabilite(?string $contactComptabilite): self
    {
        $this->contactComptabilite = $contactComptabilite;

        return $this;
    }

    public function getUrlPlateform(): ?string
    {
        return $this->urlPlateform;
    }

    public function setUrlPlateform(?string $urlPlateform): self
    {
        $this->urlPlateform = $urlPlateform;

        return $this;
    }

    public function getMdpPlateform(): ?string
    {
        return $this->mdpPlateform;
    }

    public function setMdpPlateform(?string $mdpPlateform): self
    {
        $this->mdpPlateform = $mdpPlateform;

        return $this;
    }
}
