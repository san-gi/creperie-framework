<?php

namespace App\Repository;

use App\Entity\CrepeCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CrepeCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrepeCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrepeCommande[]    findAll()
 * @method CrepeCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrepeCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrepeCommande::class);
    }

    // /**
    //  * @return CrepeCommande[] Returns an array of CrepeCommande objects
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
    public function findOneBySomeField($value): ?CrepeCommande
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
