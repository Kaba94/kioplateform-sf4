<?php

namespace App\Repository;

use App\Entity\Routeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Routeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Routeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Routeur[]    findAll()
 * @method Routeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Routeur::class);
    }

    // /**
    //  * @return Routeur[] Returns an array of Routeur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Routeur
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
