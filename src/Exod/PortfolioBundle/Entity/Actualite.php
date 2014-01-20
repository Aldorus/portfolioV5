<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Actualite
 */
class Actualite
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $texte
     */
    private $texte;

    /**
     * @var date $date
     */
    private $date;

    /**
     * @var Exod\PortfolioBundle\Entity\Article
     */
    private $idarticle;


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
     * Set texte
     *
     * @param text $texte
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    }

    /**
     * Get texte
     *
     * @return text 
     */
    public function getTexte()
    {
        return $this->texte;
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
     * Set idarticle
     *
     * @param Exod\PortfolioBundle\Entity\Article $idarticle
     */
    public function setIdarticle(\Exod\PortfolioBundle\Entity\Article $idarticle)
    {
        $this->idarticle = $idarticle;
    }

    /**
     * Get idarticle
     *
     * @return Exod\PortfolioBundle\Entity\Article 
     */
    public function getIdarticle()
    {
        return $this->idarticle;
    }
}