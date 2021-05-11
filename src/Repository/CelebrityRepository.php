<?php

namespace App\Repository;

use App\Entity\Celebrity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Celebrity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Celebrity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Celebrity[]    findAll()
 * @method Celebrity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CelebrityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Celebrity::class);
    }

    public function getActiveCelebsOfRepresentative($celebrity)
    {
        $objRepresentative = $this->createQueryBuilder('c')
            ->select('r.name as representativeName')
            ->innerJoin('c.representatives', 'r')
            ->where('c.id = :celebrity')
            ->setParameter('celebrity', $celebrity)
            ->orderBy('r.name', 'ASC')
            ->getQuery()
            ->getResult();

         $representativeOfArray = array();
         if( $objRepresentative )
         {
            foreach ($objRepresentative as $representative) {
                $representativeOfArray[] = $representative['representativeName'];
            }
         }
        
        return implode(', ', $representativeOfArray);
    }

    // /**
    //  * @return Celebrity[] Returns an array of Celebrity objects
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
    public function findOneBySomeField($value): ?Celebrity
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
