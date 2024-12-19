<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 */
class Cours
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
    private string $module;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Professeur", mappedBy="cours")
     * @ORM\JoinTable(name="cours_professeur")
     */
    private Collection $professeurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Classe", mappedBy="cours")
     */
    private Collection $classes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="cours")
     */
    private Collection $sessions;

    public function __construct()
    {
        $this->professeurs = new ArrayCollection();
        $this->classes = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->addCours($this);
        }
        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeCours($this);
        }
        return $this;
    }
}