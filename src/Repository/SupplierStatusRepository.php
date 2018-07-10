<?php

namespace App\Repository;

use App\Entity\SupplierStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SupplierStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierStatus[]    findAll()
 * @method SupplierStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SupplierStatus::class);
    }

//    /**
//     * @return SupplierStatus[] Returns an array of SupplierStatus objects
//     */
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
    public function findOneBySomeField($value): ?SupplierStatus
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
