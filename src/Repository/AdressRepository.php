<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Repository;

use App\Entity\Adress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method adress|null find($id, $lockMode = null, $lockVersion = null)
 * @method adress|null findOneBy(array $criteria, array $orderBy = null)
 * @method adress[]    findAll()
 * @method adress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adress::class);
    }

    // /**
    //  * @return adress[] Returns an array of adress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneByName($value, $site): ?adress
    {
        return $this->createQueryBuilder('a')
            ->where('a.site = :s')
            ->setParameter('s', $site)
            ->andWhere('a.nom = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
