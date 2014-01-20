<?php
namespace Exod\PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActualiteRepository extends EntityRepository 
{
	public function getActualiteLimited($limite){
		$qbActu=$this	->createQueryBuilder('a')
						->orderBy('a.date','DESC')
		    			->setMaxResults($limite);
    	return $qbActu->getQuery()->getResult();
	}
	
	public function getActualiteByCategorieLimited($idCategorie, $limite){
		$qbActu=$this	->createQueryBuilder('a')
						->leftJoin('a.idarticle', 'art')
						->leftJoin('art.idprojet','p')
						->where('p.idcategorie=:idCategorie')
		    			->setParameter('idCategorie', $idCategorie)
						->orderBy('a.date','DESC')
						->setMaxResults($limite);
    	return $qbActu->getQuery()->getResult();
	}
}