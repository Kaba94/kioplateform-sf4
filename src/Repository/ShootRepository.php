<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Shoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shoot[]    findAll()
 * @method Shoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shoot::class);
    }

    // /**
    //  * @return Shoot[] Returns an array of Shoot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shoot
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
