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
class SkillController extends Controller
{
	/**
	 * Lists all Article entities.
	 *
	 */
	public function listAllAction()
	{
		$repositorySkill = $this->getDoctrine()->getEntityManager()->getRepository('ExodPortfolioBundle:Skill');
		$skills= $repositorySkill->findAll();
		
		$arrayJSON = array();
		foreach ($skills as $skill){
			$arrayJSON[]=$skill->toArray(true);
		}
		$responseJSON = new Response(json_encode($arrayJSON));
		
		$responseJSON->headers->set("Content-type", "application/json");
		return $responseJSON;
		
	
	}
}
