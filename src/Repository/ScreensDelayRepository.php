<?php

namespace App\Repository;

use App\Entity\ScreensDelay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScreensDelay|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScreensDelay|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScreensDelay[]    findAll()
 * @method ScreensDelay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScreensDelayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScreensDelay::class);
    }

    public function returnAvgDelayDaily() {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT DATE_FORMAT(FROM_UNIXTIME(time_stat),'%d-%m-%Y') as Date, ROUND(AVG((time_stat - dg_time) / 60 / 60), 2) as DG, ROUND(AVG((time_stat - gk_time) / 60 / 60), 2) as GK FROM screens_delay group by Date ORDER BY time_stat DESC";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function returnAvgDelayMonthly() {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT DATE_FORMAT(FROM_UNIXTIME(time_stat),'%m-%Y') as Date, ROUND(AVG((time_stat - dg_time) / 60 / 60), 2) as DG, ROUND(AVG((time_stat - gk_time) / 60 / 60), 2) as GK FROM screens_delay group by Date ORDER BY time_stat DESC";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    // /**
    //  * @return ScreensDelay[] Returns an array of ScreensDelay objects
    //  */
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
    public function findOneBySomeField($value): ?ScreensDelay
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
