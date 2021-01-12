<?php

namespace App\Repository;

use App\Entity\TypeChabre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeChabre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeChabre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeChabre[]    findAll()
 * @method TypeChabre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeChabreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeChabre::class);
    }

    // /**
    //  * @return TypeChabre[] Returns an array of TypeChabre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeChabre
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
