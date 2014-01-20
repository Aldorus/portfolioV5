<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Article
 */
class Article
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var date $date
     */
    private $date;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var Exod\PortfolioBundle\Entity\Projet
     */
    private $idprojet;

	/**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set idprojet
     *
     * @param Exod\PortfolioBundle\Entity\Projet $idprojet
     */
    public function setIdprojet(\Exod\PortfolioBundle\Entity\Projet $idprojet)
    {
        $this->idprojet = $idprojet;
    }

    /**
     * Get idprojet
     *
     * @return Exod\PortfolioBundle\Entity\Projet 
     */
    public function getIdprojet()
    {
        return $this->idprojet;
    }
    
 	public function __toString(){
    	return $this->label;
    }
}