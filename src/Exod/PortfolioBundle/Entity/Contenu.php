<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Contenu
 */
class Contenu
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $idFonctionnel
     */
    private $idFonctionnel;

    /**
     * @var text $texte
     */
    private $texte;

    /**
     * @var string $path
     */
    private $path;
    
    /**
     * @var integer $idProjet
     */
    private $idProjet;


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
     * Set idFonctionnel
     *
     * @param string $idFonctionnel
     */
    public function setIdFonctionnel($idFonctionnel)
    {
        $this->idFonctionnel = $idFonctionnel;
    }

    /**
     * Get idFonctionnel
     *
     * @return string 
     */
    public function getIdFonctionnel()
    {
        return $this->idFonctionnel;
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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
    
	/**
     * Set idprojet
     *
     * @param Exod\PortfolioBundle\Entity\Projet $idprojet
     */
    public function setIdprojet(\Exod\PortfolioBundle\Entity\Projet $idprojet)
    {
        $this->idProjet = $idprojet;
    }

    /**
     * Get idprojet
     *
     * @return Exod\PortfolioBundle\Entity\Projet 
     */
    public function getIdprojet()
    {
        return $this->idProjet;
    }
}