<?php
namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    public function findEtudiantsByClasse($classeId): array
    {
        return $this->createQueryBuilder('e')
            ->join('e.classes', 'cl')
            ->where('cl.id = :classeId')
            ->setParameter('classeId', $classeId)
            ->getQuery()
            ->getResult();
    }
}