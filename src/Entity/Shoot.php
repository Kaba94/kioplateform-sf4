<?php

namespace App\Entity;

use App\Repository\ShootRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ShootRepository::class)
 * 
 */
class Shoot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $backgroundColor;

    /**
     * @ORM\ManyToOne(targetEntity=Plateform::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plateform;

    /**
     * @ORM\ManyToOne(targetEntity=Campagne::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campagne;

    /**
     * @ORM\ManyToOne(targetEntity=Routeur::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $routeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\ManyToOne(targetEntity=Annonceur::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonceur;

    /**
     * @ORM\ManyToOne(targetEntity=Base::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $base;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="shoots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestation;

    /**
     * @ORM\OneToOne(targetEntity=Resultat::class, mappedBy="shoot", cascade={"persist", "remove"})
     */
    private $resultat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart($start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd($end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

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

    public function getCampagne(): ?Campagne
    {
        return $this->campagne;
    }

    public function setCampagne(?Campagne $campagne): self
    {
        $this->campagne = $campagne;

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

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

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

    public function getBase(): ?Base
    {
        return $this->base;
    }

    public function setBase(?Base $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getResultat(): ?Resultat
    {
        return $this->resultat;
    }

    public function setResultat(Resultat $resultat): self
    {
        $this->resultat = $resultat;

        // set the owning side of the relation if necessary
        if ($resultat->getShoot() !== $this) {
            $resultat->setShoot($this);
        }

        return $this;
    }
}
