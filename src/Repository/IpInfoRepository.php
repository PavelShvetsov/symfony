<?php

namespace App\Repository;

use App\Entity\IpInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IpInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method IpInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method IpInfo[]    findAll()
 * @method IpInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IpInfoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IpInfo::class);
    }

    // /**
    //  * @return IpInfo[] Returns an array of IpInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IpInfo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
