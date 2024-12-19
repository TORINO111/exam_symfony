<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Etudiant extends Personne
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     */
    private Classe $classe;

    public function getClasse(): Classe
    {
        return $this->classe;
    }

    public function setClasse(Classe $classe): self
    {
        $this->classe = $classe;
        return $this;
    }
}