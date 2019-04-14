<?php

namespace App\Repository;

use App\Entity\CustomMenuLinks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomMenuLinks|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomMenuLinks|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomMenuLinks[]    findAll()
 * @method CustomMenuLinks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomMenuLinksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomMenuLinks::class);
    }

    // /**
    //  * @return CustomMenuLinks[] Returns an array of CustomMenuLinks objects
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
    public function findOneBySomeField($value): ?CustomMenuLinks
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
