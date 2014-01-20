<?php

namespace Exod\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Exod\PortfolioBundle\Entity\Commentaire;
use Exod\PortfolioBundle\Form\CommentaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Commentaire controller.
 *
 */
class CommentaireController extends Controller
{
    /**
     * Lists all Commentaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ExodPortfolioBundle:Commentaire')->findAll();

        return $this->render('ExodPortfolioBundle:Commentaire:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Commentaire entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Commentaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commentaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Commentaire:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Commentaire entity.
     *
     */
    public function newAction()
    {
        $entity = new Commentaire();
        $entity->setDate(new \DateTime());
        $form   = $this->createForm(new CommentaireType(), $entity);
		
        return $this->render('ExodPortfolioBundle:Commentaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Commentaire entity.
     *
     */
    public function createAction()
    {
        $entity  = new Commentaire();
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentaireType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
        	$em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('commentaire_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ExodPortfolioBundle:Commentaire:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Commentaire entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Commentaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commentaire entity.');
        }

        $editForm = $this->createForm(new CommentaireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Commentaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Commentaire entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Commentaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commentaire entity.');
        }

        $editForm   = $this->createForm(new CommentaireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('commentaire_edit', array('id' => $id)));
        }

        return $this->render('ExodPortfolioBundle:Commentaire:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Commentaire entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ExodPortfolioBundle:Commentaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commentaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('commentaire'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
	public function ajaxSubmitCommentaireAction(){
	   $request = $this->get('request');
	   $nom=$request->request->get('nom');
	   $email=$request->request->get('email');
	   $message=$request->request->get('message');
	   $idarticle=$request->request->get('idarticle');
	   
	   
	   if($nom!="" && $email!="" && $message!="" && $idarticle!=""){
			//recuperation de l'article 
	      	$em = $this->getDoctrine()->getEntityManager();
        	$article = $em->getRepository('ExodPortfolioBundle:Article')->find($idarticle);
	   	
	   		$commentaire = new Commentaire();
	      	$commentaire->setAuteur($nom);
	      	$commentaire->setDate(new \DateTime(date("y-m-d")));
	      	$commentaire->setEmail($email);
	      	$commentaire->setIdarticle($article);
	      	$commentaire->setTexte($message);
	      	
	   		$em = $this->getDoctrine()->getEntityManager();
            $em->persist($commentaire);
            $em->flush();
	   		
	   		$return=array("responseCode"=>200,  "returnback"=>utf8_encode("Votre commentaire a bien été pris en compte"));
	   }
	   else{
	      $return=array("responseCode"=>400, "returnback"=>"Il manque des informations");
	   }
	   
	   $return=json_encode($return);//jscon encode the array
	   return new Response($return,200);
	}
}
