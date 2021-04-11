<?php

/*
 * Imageur_Symfony
 * Symfony 5
 * Christine Zedday
 */

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function findDispo($slider)
    {
// public function notIn($x, $y); // Returns Expr\Func instance

        $images = $slider->getImages();
        $imids = [];
        $i = 0;
        foreach ($images as $image) {
            $imids[$i] = $image->getId();
            ++$i;
        }

        $entityManager = $this->getEntityManager();

        if (!empty($imids)) {
            $query = $entityManager->createQuery(
                'select i
                from App\Entity\Image i
                where i.id NOT IN (:imids)'
            )->setParameter('imids', $imids);
        } else {
            return $this->findAll();
        }

        return $query->getResult();
    }

    public function findIllustrations()
    {

        $entityManager = $this->getEntityManager();

       
            $query = $entityManager->createQuery(
                'select i
                from App\Entity\Image i
                where i.pour = \'illustration\'');
        
     

        return $query->getResult();
    } 

    // /**
    //  * @return Image[] Returns an array of Image objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Image
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
