<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateseance;


    /**
     * @ORM\ManyToOne(targetEntity=Soin::class, inversedBy="seances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $soin;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="seances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateseance(): ?\DateTimeInterface
    {
        return $this->dateseance;
    }

    public function setDateseance(\DateTimeInterface $dateseance): self
    {
        $this->dateseance = $dateseance;

        return $this;
    }


    public function getSoin(): ?Soin
    {
        return $this->soin;
    }

    public function setSoin(?Soin $soin): self
    {
        $this->soin = $soin;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
