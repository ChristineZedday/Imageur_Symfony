<?php

namespace App\Repository;

use App\Entity\Javascript;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Javascript|null find($id, $lockMode = null, $lockVersion = null)
 * @method Javascript|null findOneBy(array $criteria, array $orderBy = null)
 * @method Javascript[]    findAll()
 * @method Javascript[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JavascriptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Javascript::class);
    }

    // /**
    //  * @return Javascript[] Returns an array of Javascript objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Javascript
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
