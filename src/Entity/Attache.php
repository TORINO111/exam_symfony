<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Attache extends Personne
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="attache")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="attache")
     */
    private $sessions;

    // Méthodes spécifiques à l'Attaché (inscrire des étudiants, planifier des sessions de cours)
    public function inscrireEtudiant(Etudiant $etudiant, Classe $classe)
    {
        
    }

    public function planifierSession(Session $session)
    {
        
    }
}