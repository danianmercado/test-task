<?php

namespace App\Repository;

use App\Entity\PaymentService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaymentService>
 *
 * @method PaymentService|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentService|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentService[]    findAll()
 * @method PaymentService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentService::class);
    }

//    /**
//     * @return PaymentService[] Returns an array of PaymentService objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PaymentService
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
