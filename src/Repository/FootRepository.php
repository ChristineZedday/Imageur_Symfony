<?php

namespace App\Repository;

use App\Entity\Foot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Foot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Foot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Foot[]    findAll()
 * @method Foot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Foot::class);
    }

    // /**
    //  * @return Foot[] Returns an array of Foot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Foot
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
