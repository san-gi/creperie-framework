<?php

namespace App\Repository;

use App\Entity\Crepe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Crepe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crepe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crepe[]    findAll()
 * @method Crepe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrepeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crepe::class);
    }

    // /**
    //  * @return Crepe[] Returns an array of Crepe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Crepe
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
