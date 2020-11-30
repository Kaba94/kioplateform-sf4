<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Resultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resultat[]    findAll()
 * @method Resultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resultat::class);
    }

    /**
     * Récupére les resultats en lien avec une recherche
     * @return resultats[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this
            ->createQueryBuilder('re')
            ->select('re', 'sh')
            ->join('re.shoot', 'sh')
            ->join('sh.routeur', 'ro')
            ->join('sh.base', 'ba')
            ->join('sh.annonceur', 'an')
            ->join('sh.campagne', 'ca');

            if(!empty($search->q)) {
                $query = $query
                    ->andWhere('sh.title LIKE :q')
                    ->setParameter('q', "%{$search->q}%");
            }

            if(!empty($search->routeur)) {
                $query = $query
                    ->andWhere('ro.id IN (:routeur)')
                    ->setParameter('routeur', $search->routeur);
            }
            if(!empty($search->base)) {
                $query = $query
                    ->andWhere('ba.id IN (:base)')
                    ->setParameter('base', $search->base);
            }
            if(!empty($search->annonceur)) {
                $query = $query
                    ->andWhere('an.id IN (:annonceur)')
                    ->setParameter('annonceur', $search->annonceur);
            }
            if(!empty($search->campagne)) {
                $query = $query
                    ->andWhere('ca.id IN (:campagne)')
                    ->setParameter('campagne', $search->campagne);
            }
            if(!empty($search->test)) {
                $query = $query
                    ->andWhere('ca.test = 1');
                    // ->setParameter('campagne', $search->campagne);
            }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Resultat[] Returns an array of Resultat objects
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
    public function findOneBySomeField($value): ?Resultat
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
