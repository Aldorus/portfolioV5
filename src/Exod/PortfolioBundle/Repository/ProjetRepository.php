<?php
namespace Exod\PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProjetRepository extends EntityRepository 
{
	public function getProjectFini(){
		$qb = $this->createQueryBuilder('p')
               ->where('p.fini>=100');

    	return $qb->getQuery()->getResult();
	}
	
	public function getProjectNonFini($limit){
		$qb = $this->createQueryBuilder('p')
               ->where('p.fini<100')
               ->setMaxResults($limit);

    	return $qb->getQuery()->getResult();
	}
	
	public function getProjectFiniByCategorie($idCategorie){
		$qb = $this	->createQueryBuilder('p')
					->where('p.fini>=100')
					->andWhere('p.idcategorie=:idcategorie')
					->setParameter('idcategorie', $idCategorie);
	
		return $qb->getQuery()->getResult();
	}
	
	public function getProjectNonFiniByCategorie($idCategorie, $limit){
		$qb = $this	->createQueryBuilder('p')
					->where('p.fini<100')
					->andWhere('p.idcategorie=:idcategorie')
					->setMaxResults($limit)
					->setParameter('idcategorie', $idCategorie);
	
		return $qb->getQuery()->getResult();
	}
	
	public function getProjects($limit){
		$qb = $this->createQueryBuilder('p')
		->setMaxResults($limit)
		->addOrderBy('p.id', 'DESC');
		
		return $qb->getQuery()->getResult();
	}
}
