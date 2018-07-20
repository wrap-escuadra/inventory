<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use http\Env\Request;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

//    public function findAll(Array $order= array('created_at' => 'DESC'))
//    {
//        return $this->findBy(array(), $order);
//    }

    public function testfind( $request)
    {
        $filter = $request->query->get('searchBy',false);
        $qsearch = $request->query->get('qsearch','');

        $result = $this->createQueryBuilder('p')
            ->leftJoin('p.supplier','s')->addSelect('s');
        if($filter){
            foreach($filter as $searchby){
                $result->orWhere($searchby.' LIKE :searchquery');
                $result->setParameter('searchquery', '%'.trim($qsearch).'%');
            }

        }

        $result->getQuery();

        return $result;
    }



//    /**
//     * @return Product[] Returns an array of Product objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
