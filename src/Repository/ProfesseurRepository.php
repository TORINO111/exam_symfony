<?php

namespace App\Repository;

use App\Entity\Professeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProfesseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Professeur::class);
    }

    public function save(Professeur $professeur, bool $flush = false): void
    {
        $this->_em->persist($professeur);

        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(Professeur $professeur, bool $flush = false): void
    {
        $this->_em->remove($professeur);

        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findProfesseurByName(string $nom, string $prenom): ?Professeur
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.nom = :nom')
            ->andWhere('p.prenom = :prenom')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllProfesseurs(): array
    {
        return $this->findBy([], ['nom' => 'ASC']); // Tri par nom
    }

    // Recherche par module (si tu veux faire un filtre pour les professeurs par module)
    public function findProfesseursByModule(string $module): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.cours', 'c')
            ->andWhere('c.module = :module')
            ->setParameter('module', $module)
            ->getQuery()
            ->getResult();
    }
}