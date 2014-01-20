<?php

namespace Exod\PortfolioBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Exod\PortfolioBundle\Entity\ArticleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Exod\PortfolioBundle\Service\ArticleService;
use Exod\PortfolioBundle\Entity\Article;
use Exod\PortfolioBundle\Form\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ExodPortfolioBundle:Article')->findAll();

        return $this->render('ExodPortfolioBundle:Article:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Article:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $entity = new Article();
        $entity->setDate(new \DateTime());
        $form   = $this->createForm(new ArticleType(), $entity);
		return $this->render('ExodPortfolioBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Article entity.
     *
     */
    public function createAction()
    {
        $entity  = new Article();
        $request = $this->getRequest();
        $form    = $this->createForm(new ArticleType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ExodPortfolioBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm   = $this->createForm(new ArticleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }

        return $this->render('ExodPortfolioBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ExodPortfolioBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    public function consulterArticlesAction(){
    	$em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('ExodPortfolioBundle:Article')->findAll();
    	return $this->render('ExodPortfolioBundle:Article:showFront.html.twig',array(
    		'articles'		=>$entities,
    	));
    }
    
  	public function consulterEnCoursAction(){
		$articleService = new ArticleService($this);
		$articles = $articleService->getArticleProjetByFini(0);
		return $this->render('ExodPortfolioBundle:Article:showFront.html.twig',array(
    		'articles'		=>$articles,
    	));
    }
    
	public function consulterTerminesAction(){
    	$articleService = new ArticleService($this);
		$articles = $articleService->getArticleProjetByFini(1);
    	return $this->render('ExodPortfolioBundle:Article:showFront.html.twig',array(
    		'articles'		=>$articles,
    	));
    }
    
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
	public function getFrontArticleByIdAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $article = $em->getRepository('ExodPortfolioBundle:Article')->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }
        $repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");  
        $repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
    	$categories = $repositoryCategorie->findAll();
    	
    	//recuperation des images
    	$repositoryImage = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Image');
    	$images = $repositoryImage->findByidprojet($article->getIdprojet()->getId());
    	
    	//recuperation des actualités
    	$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
    	$actualites = $repositoryActu->findByidarticle($article->getId());
    	
    	//recuperation des commentaires
    	$repositoryCommentaire = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Commentaire');
    	$commentaires = $repositoryCommentaire->findByidarticle($article->getId());
    	
    	//recuperation des documents
    	$repositoryDocument = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Document');
    	$documents = $repositoryDocument->findByidprojet($article->getIdprojet()->getId());
    	
        return $this->render('ExodPortfolioBundle:Article:showOneFront.html.twig', array(
        	'contenuProfil'		=> $contenuProfil,
        	'categories'		=> $categories,
            'article'      		=> $article,
        	'actualites'		=> $actualites,
        	'images'			=> $images,
        	'commentaires'		=> $commentaires,
        	'documents'			=> $documents
        ));
    }
    
	public function getFrontArticleByProjetIdOldAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        
        $article = $em->getRepository('ExodPortfolioBundle:Article')->findOneByIdprojet($id);
        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }
        $repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");  
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
    	$categories = $repositoryCategorie->findAll();
    	
    	//recuperation des images
    	$repositoryImage = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Image');
    	$images = $repositoryImage->findByidprojet($article->getIdprojet()->getId());
    	
    	//recuperation des actualités
    	$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
    	$actualites = $repositoryActu->findByidarticle($article->getId());
    	
    	//recuperation des commentaires
    	$repositoryCommentaire = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Commentaire');
    	$commentaires = $repositoryCommentaire->findByidarticle($article->getId());
    	
    	//recuperation des documents
    	$repositoryDocument = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Document');
    	$documents = $repositoryDocument->findByidprojet($article->getIdprojet()->getId());
    	
        return $this->render('ExodPortfolioBundle:Article:showOneFront.html.twig', array(
        	'contenuProfil'		=> $contenuProfil,
        	'categories'		=> $categories,
            'article'      		=> $article,
        	'actualites'		=> $actualites,
        	'images'			=> $images,
        	'commentaires'		=> $commentaires,
        	'documents'			=> $documents
        ));
	}
	
	public function getFrontArticleByProjetIdAction($idProjet){
		$em = $this->getDoctrine()->getEntityManager();
	
		$article = $em->getRepository('ExodPortfolioBundle:Article')->findOneByIdprojet($idProjet);
		if (!$article) {
			throw $this->createNotFoundException('Unable to find Article entity.');
		}
		$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
		$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");
		$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
		$categories = $repositoryCategorie->findAll();
		 
		//recuperation des images
		$repositoryImage = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Image');
		$images = $repositoryImage->findByidprojet($article->getIdprojet()->getId());
		 
		//recuperation des actualités
		$repositoryActu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Actualite');
		$actualites = $repositoryActu->findByidarticle($article->getId());
		 
		//recuperation des commentaires
		$repositoryCommentaire = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Commentaire');
		$commentaires = $repositoryCommentaire->findByidarticle($article->getId());
		 
		//recuperation des documents
		$repositoryDocument = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Document');
		$documents = $repositoryDocument->findByidprojet($article->getIdprojet()->getId());
		 
		return $this->render('ExodPortfolioBundle:VersionTwo:projet.html.twig', array(
				'contenuProfil'		=> $contenuProfil,
				'categories'		=> $categories,
				'article'      		=> $article,
				'actualites'		=> $actualites,
				'images'			=> $images,
				'commentaires'		=> $commentaires,
				'documents'			=> $documents
		));
	}
	
	public function commentairesForArticleAction($id){
		//recuperation des commentaires
		//recuperation des commentaires
		$repositoryCommentaire = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Commentaire');
		$commentaires = $repositoryCommentaire->findByidarticle($id);
	
		$arrayCom = array();
		foreach ($commentaires as $commentaire){
			$arrayCom[] = $commentaire->toArray();
		}
		
		$return=json_encode($arrayCom);//jscon encode the array
		$responseJSON = new Response($return,200);
		$responseJSON->headers->set("Content-type", "application/json");
		return $responseJSON;
	}
}
