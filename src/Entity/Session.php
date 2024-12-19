<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SessionRepository;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column(type: 'integer')]
private $id;

#[ORM\Column(type: 'datetime')]
private $date;

#[ORM\Column(type: 'time')]
private $heureDebut;

#[ORM\Column(type: 'time')]
private $heureFin;

#[ORM\ManyToOne(targetEntity: Cours::class, inversedBy: 'sessions')]
private $cours;

#[ORM\Column(type: 'string', length: 255, nullable: true)]
private $salle;

// Getters and Setters
public function getId(): ?int
{
return $this->id;
}

public function getDate(): ?\DateTimeInterface
{
return $this->date;
}

public function setDate(\DateTimeInterface $date): self
{
$this->date = $date;
return $this;
}

public function getHeureDebut(): ?\DateTimeInterface
{
return $this->heureDebut;
}

public function setHeureDebut(\DateTimeInterface $heureDebut): self
{
$this->heureDebut = $heureDebut;
return $this;
}

public function getHeureFin(): ?\DateTimeInterface
{
return $this->heureFin;
}

public function setHeureFin(\DateTimeInterface $heureFin): self
{
$this->heureFin = $heureFin;
return $this;
}

public function getSalle(): ?string
{
return $this->salle;
}

public function setSalle(?string $salle): self
{
$this->salle = $salle;
return $this;
}

public function getCours(): ?Cours
{
return $this->cours;
}

public function setCours(?Cours $cours): self
{
$this->cours = $cours;
return $this;
}
}