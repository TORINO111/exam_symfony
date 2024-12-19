<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cours", inversedBy="classes")
     * @ORM\JoinTable(name="classe_cours")
     */
    private Collection $cours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etudiant", mappedBy="classe")
     */
    private Collection $etudiants;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
    }
    

}