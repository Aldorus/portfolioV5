<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Image
 */
class Image
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nom
     */
    private $nom;

    /**
     * @var string $path
     */
    private $path;

    /**
     * @var string $format
     */
    private $format;

    /**
     * @var date $date
     */
    private $date;

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
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
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
     * Set format
     *
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
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
}