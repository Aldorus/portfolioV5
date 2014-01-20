<?php

namespace Exod\PortfolioBundle\Controller;

use Exod\PortfolioBundle\Entity\ArticleRepository;
use Exod\PortfolioBundle\Service\HomeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Home controller.
 *
 */
class HomeController extends Controller
{
	var $profondeurActu = 3;
	var $limitProjet=8;
	var $limitTweeter = 5;
	public function indexAction()
	{
		//Partie constante
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");
		 
		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$lastActualites = $repositoryActu->getActualiteLimited($this->profondeurActu);
		 
		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projets= $repositoryProjet->getProjects(3);
		
		return $this->render('ExodPortfolioBundle:VersionTwo:index.html.twig',array(
				'contenuProfil'				=> $contenuProfil,
				'lastActualites'			=> $lastActualites,
				'lastTweets'				=> $this->getLastTweet(),
				'projets'					=> $projets,
		));
	}

	public function indexOldAction()
	{
		//Partie constante
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");
			
		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$lastActualites = $repositoryActu->getActualiteLimited($this->profondeurActu);
			
		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projetsFinis= $repositoryProjet->getProjectFini();
		$projetsNonFinis= $repositoryProjet->getProjectNonFini($this->limitProjet);
	
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();
			
		return $this->render('ExodPortfolioBundle:Home:indexFront.html.twig',array(
				'contenuProfil'				=> $contenuProfil,
				'categories'				=> $categories,
				'lastActualites'			=> $lastActualites,
				'lastTweets'				=> $this->getLastTweet(),
				'projetsFinis'				=> $projetsFinis,
				'projetsNonFinis'			=> $projetsNonFinis,
		));
	}
	
	public function getLastTweet(){
// 		$connection = new TwitterOAuth('USST7m1mByqaUhkdyoxdw', '7M0KBckWiObYvHwyxUs5eF1Asxof4STA4mPiMI5YFDE');
// 		$connection->getAuthorizeURL('373958808-uUTc0Prhake1td6n9RCN2G01YDsMsIoUEn0MmoFd', 'deoO6WV8j87FLzx2EoxEU2BmW4L9c0CIy0NizCd5c');
		
		return "";
	}

	private function parse($text) {
		$text = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $text);
		$text = preg_replace('#@([a-z0-9_]+)#i', '@<a href="http://twitter.com/$1">$1</a>', $text);
		$text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a href="http://search.twitter.com/search?q=%23$1">$1</a>', $text);
		return $text;
	}

	public function indexAdminAction()
	{
		return $this->render('ExodPortfolioBundle:Home:index.html.twig');
	}

	public function byCategorieAction($idCategorie){
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");

		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$lastActualites = $repositoryActu->getActualiteByCategorieLimited($idCategorie,$this->profondeurActu);

		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projetsFinis= $repositoryProjet->getProjectFiniByCategorie($idCategorie);
		$projetsNonFinis= $repositoryProjet->getProjectNonFiniByCategorie($idCategorie,$this->limitProjet);
		 
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();

		return $this->render('ExodPortfolioBundle:VersionTwo:index.html.twig',array(
				'contenuProfil'				=> $contenuProfil,
				'categories'				=> $categories,
				'lastActualites'			=> $lastActualites,
				'lastTweets'				=> $this->getLastTweet(),
				'projetsFinis'				=> $projetsFinis,
				'projetsNonFinis'			=> $projetsNonFinis,
		));
	}
	
	public function chooseCategoriesAction(){
		
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();
		
		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projets = $repositoryProjet->findAll();
		
		return $this->render('ExodPortfolioBundle:VersionTwo:projets.html.twig',array(
				'categories'				=> $categories,
				'projets'					=> $projets,
		));
	}
	
	public function informationsAction(){
	
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");
		
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuSearch = $repositoryContenu->findOneByidFonctionnel("proSearch");
		
		return $this->render('ExodPortfolioBundle:VersionTwo:informations.html.twig',array(
				'contenuProfil'				=> $contenuProfil,
				'contenuSearch'				=> $contenuSearch,
		));
	}
}

