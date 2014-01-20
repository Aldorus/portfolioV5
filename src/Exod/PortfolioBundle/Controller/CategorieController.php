<?php

namespace Exod\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Exod\PortfolioBundle\Entity\Categorie;
use Exod\PortfolioBundle\Form\CategorieType;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{
    /**
     * Lists all Categorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ExodPortfolioBundle:Categorie')->findAll();

        return $this->render('ExodPortfolioBundle:Categorie:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Categorie entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Categorie:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Categorie entity.
     *
     */
    public function newAction()
    {
        $entity = new Categorie();
        $form   = $this->createForm(new CategorieType(), $entity);

        return $this->render('ExodPortfolioBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Categorie entity.
     *
     */
    public function createAction()
    {
        $entity  = new Categorie();
        $request = $this->getRequest();
        $form    = $this->createForm(new CategorieType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categorie_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ExodPortfolioBundle:Categorie:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Categorie entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $editForm = $this->createForm(new CategorieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ExodPortfolioBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Categorie entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ExodPortfolioBundle:Categorie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorie entity.');
        }

        $editForm   = $this->createForm(new CategorieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categorie_edit', array('id' => $id)));
        }

        return $this->render('ExodPortfolioBundle:Categorie:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categorie entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ExodPortfolioBundle:Categorie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categorie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categorie'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function planDeSiteAction(){
    	
    	$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
    	$categories = $repositoryCategorie->findAll();
    	
    	$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
    	
    	foreach ($categories as $categorie) {
    		$projets = $repositoryProjet->findByidcategorie($categorie->getId());
    		$categorie->arrayProjets = $projets;
    	}
    	 
    	return $this->render('ExodPortfolioBundle:VersionTwo:planDeSite.html.twig', array(
    		'categories'				=> $categories,
    	));
    }
    
    public function planDeSiteOldAction(){
    	 
    	$repositoryContenu = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Contenu');
    	$contenuProfil = $repositoryContenu->findOneByidFonctionnel("profil");
    	 
    	$repositoryCategorie = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Categorie');
    	$categories = $repositoryCategorie->findAll();
    	 
    	$repositoryProjet = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Projet');
    	 
    	foreach ($categories as $categorie) {
    		$projets = $repositoryProjet->findByidcategorie($categorie->getId());
    		$categorie->arrayProjets = $projets;
    	}
    
    	return $this->render('ExodPortfolioBundle:Categorie:planDeSite.html.twig', array(
    			'contenuProfil'				=> $contenuProfil,
    			'categories'				=> $categories,
    	));
    }
}
