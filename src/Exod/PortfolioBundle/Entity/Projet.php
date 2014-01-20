<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Projet
 */
class Projet
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $label
     */
    private $label;

    /**
     * @var text $texte
     */
    private $texte;

    /**
     * @var date $date
     */
    private $date;

    /**
     * @var integer $fini
     */
    private $fini;

    /**
     * @var text $path
     */
    private $path;
    
    /**
     * @var Exod\PortfolioBundle\Entity\Categorie
     */
    private $idcategorie;
    
    
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
     * Set fini
     *
     * @param integer $fini
     */
    public function setFini($fini)
    {
        $this->fini = $fini;
    }

    /**
     * Get fini
     *
     * @return integer 
     */
    public function getFini()
    {
        return $this->fini;
    }
    
	/**
     * Set path
     *
     * @param text $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return path 
     */
    public function getPath()
    {
        return $this->path;
    }
    
	/**
     * Set idcategorie
     *
     * @param Exod\PortfolioBundle\Entity\Categorie $idcategorie
     */
    public function setIdcategorie(\Exod\PortfolioBundle\Entity\Categorie $idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * Get idcategorie
     *
     * @return Exod\PortfolioBundle\Entity\Categorie 
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }
    
   	public function __toString(){
   		return $this->label;
   	}
}