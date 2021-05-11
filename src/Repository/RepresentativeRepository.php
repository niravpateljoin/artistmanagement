<?php

namespace App\Repository;

use App\Entity\Representative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Representative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representative[]    findAll()
 * @method Representative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representative::class);
    }

    public function getRepresentative($representative)
    {
        $objCelebrity = $this->createQueryBuilder('r')
            ->select('c.name as celebrityName')
            ->innerJoin('r.celebrities', 'c')
            ->where('r.id = :representative')
            ->setParameter('representative', $representative)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult();

         $celebrityOfArray = array();
         if( $objCelebrity )
         {
            foreach ($objCelebrity as $celebrity) {
                $celebrityOfArray[] = $celebrity['celebrityName'];
            }
         }
        
        return implode(', ', $celebrityOfArray);
    }

    // /**
    //  * @return Representative[] Returns an array of Representative objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Representative
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
