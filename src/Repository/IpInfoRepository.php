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

    public function findIpLastDay()
    {
        return $this->createQueryBuilder("e")
            ->andWhere('e.dateCreated BETWEEN :from AND :to')
            ->setParameter('from', new \DateTime('yesterday'))
            ->setParameter('to', new \DateTime('now'))
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
