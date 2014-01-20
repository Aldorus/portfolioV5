<?php
namespace Exod\PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository 
{
	public function getImageForProjectFini(){
		$qb = $this->createQueryBuilder('img')
               ->join('img.idprojet', 'p')
               ->addSelect('p')
               ->where('p.fini>=100');

    	return $qb->getQuery()->getResult();
	}
	
public function getImageForProjectNonFini(){
		$qb = $this->createQueryBuilder('img')
               ->join('img.idprojet', 'p')
               ->addSelect('p')
               ->where('p.fini<100');

    	return $qb->getQuery()->getResult();
	}
}