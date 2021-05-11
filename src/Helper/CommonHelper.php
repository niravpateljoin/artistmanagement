<?php

namespace App\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\EmailLog;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;

class CommonHelper {

	private $entityManager;
    private $container;

    public function __construct(EntityManager $entityManager, ContainerInterface  $container, Session $session) {
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function getRepresentative( $celebrity )
    {
    	$objRepresentative = $this->entityManager->getRepository('App:Celebrity')->createQueryBuilder('c')
            ->select('r.name as representativeName')
            ->innerJoin('c.representatives', 'r')
            ->where('c.id = :celebrity')
            ->setParameter('celebrity', $celebrity)
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

    public function getCelebrity( $representative )
    {
    	$objCelebrity = $this->entityManager->getRepository('App:Representative')->createQueryBuilder('r')
            ->select('c.name as celebrityName')
            ->innerJoin('r.celebrities', 'c')
            ->where('r.id = :representative')
            ->setParameter('representative', $representative)
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
}