<?php

namespace App\Repository;

use App\Entity\PromotedGamesProfiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PromotedGamesProfiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromotedGamesProfiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromotedGamesProfiles[]    findAll()
 * @method PromotedGamesProfiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotedGamesProfilesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PromotedGamesProfiles::class);
    }

    public function returnMissingGamesProfiles() {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT v.id FROM `pgprofiles` as v 
            left join promoted_games_profiles as e 
            on 
            v.id = e.game_id
            WHERE e.game_id is null";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    // /**
    //  * @return PromotedGamesProfiles[] Returns an array of PromotedGamesProfiles objects
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
    public function findOneBySomeField($value): ?PromotedGamesProfiles
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
