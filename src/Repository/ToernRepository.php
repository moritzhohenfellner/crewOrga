<?php

namespace App\Repository;

use App\Entity\Toern;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Toern|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toern|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toern[]    findAll()
 * @method Toern[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToernRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Toern::class);
    }

//    /**
//     * @return Toern[] Returns an array of Toern objects
//     */
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
    public function findOneBySomeField($value): ?Toern
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
