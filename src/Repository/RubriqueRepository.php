<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Repository;

use App\Entity\Rubrique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rubrique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rubrique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rubrique[]    findAll()
 * @method Rubrique[]    findBy(array $criteria = [], array $orderBy = 'rang', $limit = null, $offset = null)
 */
class RubriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rubrique::class);
    }

    // /**
    //  * @return Rubrique[] Returns an array of Rubrique objects
    //  */
    
    public function findBySite($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.site = :val')
            ->setParameter('val', $value)
            ->orderBy('r.rang', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        
    }
    

    /*
    public function findOneBySomeField($value): ?Rubrique
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
