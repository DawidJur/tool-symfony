<?php

namespace App\Repository;

use App\Entity\PromotedGames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PromotedGames|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromotedGames|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromotedGames[]    findAll()
 * @method PromotedGames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotedGamesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PromotedGames::class);
    }

    public function returnGamesListInMonth($year, $month) {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT game_name, country_code FROM promoted_games WHERE YEAR(FROM_UNIXTIME(date_of_update)) = :year AND MONTH(FROM_UNIXTIME(date_of_update)) = :month ORDER BY game_name ASC";
        $statement = $connection->prepare($sql);
        $statement->execute(['year' => $year, 'month' => $month]);
        return $statement->fetchAll();
    }

    public function returnGameNameById($gameId) {
        return $this->getDoctrine()
        ->getRepository(PromotedGames::class)
        ->find($gameId)->getGameName();
    }

    // /**
    //  * @return PromotedGames[] Returns an array of PromotedGames objects
    //  */
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
    public function findOneBySomeField($value): ?PromotedGames
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
