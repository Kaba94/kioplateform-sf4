<?php

namespace App\Entity;

use App\Repository\ResultatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ResultatRepository::class)
 * @UniqueEntity(fields={"shoot"}, message="Ce shoot à déjà été sélectionné")
 */
class Resultat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Shoot::class, inversedBy="resultat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $shoot;

    /**
     * @ORM\Column(type="integer")
     */
    private $volumeEnvoye;

    /**
     * @ORM\Column(type="integer")
     */
    private $resultat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShoot(): ?Shoot
    {
        return $this->shoot;
    }

    public function setShoot(Shoot $shoot): self
    {
        $this->shoot = $shoot;

        return $this;
    }

    public function getVolumeEnvoye(): ?int
    {
        return $this->volumeEnvoye;
    }

    public function setVolumeEnvoye(int $volumeEnvoye): self
    {
        $this->volumeEnvoye = $volumeEnvoye;

        return $this;
    }

    public function getResultat(): ?int
    {
        return $this->resultat;
    }

    public function setResultat(int $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
