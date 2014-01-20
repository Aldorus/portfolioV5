<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Commentaire
 */
class Commentaire
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
     * @var string $auteur
     */
    private $auteur;

    /**
     * @var string $email
     */
    private $email;

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
     * Set auteur
     *
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
    
    public function toArray($bool=true){
    	$arrayReturn = get_object_vars($this);
    	return $arrayReturn;
    }
}