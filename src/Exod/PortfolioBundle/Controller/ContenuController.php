<?php

namespace Exod\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exod\PortfolioBundle\Entity\Contenu;
use Exod\PortfolioBundle\Form\ContenuType;

/**
 * Contenu controller.
 *
 */
class ContenuController extends Controller
{
	var $limitTweeter = 5;
	var $profondeurActu = 3;
	/**
	 * Lists all Contenu entities.
	 *
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getEntityManager();

		$entities = $em->getRepository('ExodPortfolioBundle:Contenu')->findAll();

		return $this->render('ExodPortfolioBundle:Contenu:index.html.twig', array(
				'entities' => $entities
		));
	}

	/**
	 * Finds and displays a Contenu entity.
	 *
	 */
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('ExodPortfolioBundle:Contenu')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Contenu entity.');
		}

		$deleteForm = $this->createDeleteForm($id);

		return $this->render('ExodPortfolioBundle:Contenu:show.html.twig', array(
				'entity'      => $entity,
				'delete_form' => $deleteForm->createView(),

		));
	}

	/**
	 * Displays a form to create a new Contenu entity.
	 *
	 */
	public function newAction()
	{
		$entity = new Contenu();
		$form   = $this->createForm(new ContenuType(), $entity);

		return $this->render('ExodPortfolioBundle:Contenu:new.html.twig', array(
				'entity' => $entity,
				'form'   => $form->createView()
		));
	}

	/**
	 * Creates a new Contenu entity.
	 *
	 */
	public function createAction()
	{
		$entity  = new Contenu();
		$request = $this->getRequest();
		$form    = $this->createForm(new ContenuType(), $entity);
		$form->bindRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('contenu_show', array('id' => $entity->getId())));

		}

		return $this->render('ExodPortfolioBundle:Contenu:new.html.twig', array(
				'entity' => $entity,
				'form'   => $form->createView()
		));
	}

	/**
	 * Displays a form to edit an existing Contenu entity.
	 *
	 */
	public function editAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('ExodPortfolioBundle:Contenu')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Contenu entity.');
		}

		$editForm = $this->createForm(new ContenuType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		return $this->render('ExodPortfolioBundle:Contenu:edit.html.twig', array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Edits an existing Contenu entity.
	 *
	 */
	public function updateAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$entity = $em->getRepository('ExodPortfolioBundle:Contenu')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Contenu entity.');
		}

		$editForm   = $this->createForm(new ContenuType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		$request = $this->getRequest();

		$editForm->bindRequest($request);

		if ($editForm->isValid()) {
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('contenu_edit', array('id' => $id)));
		}

		return $this->render('ExodPortfolioBundle:Contenu:edit.html.twig', array(
				'entity'      => $entity,
				'edit_form'   => $editForm->createView(),
				'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a Contenu entity.
	 *
	 */
	public function deleteAction($id)
	{
		$form = $this->createDeleteForm($id);
		$request = $this->getRequest();

		$form->bindRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getEntityManager();
			$entity = $em->getRepository('ExodPortfolioBundle:Contenu')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Contenu entity.');
			}

			$em->remove($entity);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('contenu'));
	}

	public function CVAction(){	
		return $this->redirect("http://cv.rousselguillaume.fr/ROUSSEL_GUILLAUME_CV.pdf");
	}

	public function contactAction(){
		$repository = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$message = $repository->findOneByidFonctionnel("messageContact");
		return $this->render('ExodPortfolioBundle:VersionTwo:contact.html.twig',array(
				'message'		=> $message,
				
		));
	}
	
	public function contactOldAction(){
		//Partie constante
		$repository = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repository->findOneByidFonctionnel("profil");
			
		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$lastActualites = $repositoryActu->getActualiteLimited($this->profondeurActu);
			
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();
			
		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projetsFinis= $repositoryProjet->getProjectFini();
			
		return $this->render('ExodPortfolioBundle:Contenu:contact.html.twig',array(
				'contenuProfil'		=> $contenuProfil,
				'categories'		=> $categories,
				'lastActualites'	=> $lastActualites,
				'projetsFinis'		=> $projetsFinis,
		));
	
	}

	public function traitementMailAction(){
		$bool=true;
		$request = $this->getRequest();
		if($request->request->get('email')==null || $request->request->get('nom')==null || $request->request->get('message')==null){
			$bool=false;
		}
		 
		$email = $request->request->get('email');
		$message = "<strong>".$request->request->get('nom')."</strong>, vous a envoy&eacute; un message : <br/>".$request->request->get('message');
		if($bool){
			try{
				$mail = \Swift_Message::newInstance()
				->setSubject('Contact Portfolio by '+$email)
				->setFrom('roussel.guillaume.gr@gmail.com')
				->setTo('roussel.guillaume.gr@gmail.com')
				->setBody($message);
				 
				$this->get('mailer')->send($mail);
			}catch (Exception $e){
				$bool=false;
			}
		}
		 
		$message;
		if($bool){
			$messageRetour = "Le message a bien &eacute;t&eacute; envoy&eacute;";
		}else{
			$messageRetour = "Le message n'a pas put &ecirc;tre envoy&eacute;";
		}
		 
		 
		$repository = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$message = $repository->findOneByidFonctionnel("messageContact");
		return $this->render('ExodPortfolioBundle:VersionTwo:contact.html.twig',array(
				'message'			=> $message,
				'messageRetour'		=> $messageRetour,
				
		));
	}
	
	public function traitementMailOldAction(){
		$bool=true;
		$request = $this->getRequest();
		if($request->request->get('email')==null || $request->request->get('nom')==null || $request->request->get('message')==null){
			$bool=false;
		}
			
		$email = $request->request->get('email');
		$message = "<strong>".$request->request->get('nom')."</strong>, vous a envoy&eacute; un message : <br/>".$request->request->get('message');
		if($bool){
			try{
				$mail = \Swift_Message::newInstance()
				->setSubject('Contact Portfolio by '+$email)
				->setFrom('roussel.guillaume.gr@gmail.com')
				->setTo('roussel.guillaume.gr@gmail.com')
				->setBody($message);
					
				$this->get('mailer')->send($mail);
			}catch (Exception $e){
				$bool=false;
			}
		}
			
		$message;
		if($bool){
			$message = "Le message a bien été envoyé";
		}else{
			$message = "Le message n'a pas put être envoyé;";
		}
			
			
		//Partie constante
		$repository = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repository->findOneByidFonctionnel("profil");
	
		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$lastActualites = $repositoryActu->getActualiteLimited($this->profondeurActu);
	
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();
	
		$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
		$projetsFinis= $repositoryProjet->getProjectFini();
	
		return $this->render('ExodPortfolioBundle:Contenu:contact.html.twig', array(
				'message'			=> $message,
				'contenuProfil'		=> $contenuProfil,
				'categories'		=> $categories,
				'lastActualites'	=> $lastActualites,
				'lastTweets'		=> $this->getLastTweet(),
				'projetsFinis'		=> $projetsFinis,
		));
	}

	public function profilAction(){
		$em = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository('ExodPortfolioBundle:Contenu')->findOneByidFonctionnel("CONTENU_PROFIL");
		 
		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Contenu entity.');
		}
		 
		return $this->render('ExodPortfolioBundle:Contenu:CV.html.twig', array(
				'entity'	=>$entity
		));
	}

	private function createDeleteForm($id)
	{
		return $this->createFormBuilder(array('id' => $id))
		->add('id', 'hidden')
		->getForm()
		;
	}

	public function getLastTweet(){
		/* Nom d'utilisateur sur Twitter */
		$user = "RG_exod";
		/* Nombre de message à afficher */
		$count = $this->limitTweeter;
		/* Format de la date à afficher */
		$date_format = 'd-m-Y H:i:s';
		$url = 'https://api.twitter.com/1/statuses/user_timeline.xml?screen_name='.$user.'&count='.$count;
		$url_headers = @get_headers($url);
		$arrayTweet = array();
		try{
			$oXML = simplexml_load_file( $url );
				
			foreach( $oXML->status as $oStatus ) {
				$datetime = date_create($oStatus->created_at);
				$date = date_format($datetime, $date_format);
				//		  	echo '<li>'.parse(utf8_decode($oStatus->text));
				//		  	echo ' (<a href="http://twitter.com/'.$user.'/status/'.$oStatus->id.'">'.$date.'</a>)</li>';
	
				$arrayTweet[] = array(
						'date'		=> $date,
						'texte'		=> $this->parse($oStatus->text),
						'statut'	=> $oStatus->id,
						'user'		=> $user
				);
			}
		}catch (Exception $e) {
			//NOTHING
		}

		return $arrayTweet;
	}

	private function parse($text) {
		$text = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $text);
		$text = preg_replace('#@([a-z0-9_]+)#i', '@<a href="http://twitter.com/$1">$1</a>', $text);
		$text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a href="http://search.twitter.com/search?q=%23$1">$1</a>', $text);
		return $text;
	}
}
