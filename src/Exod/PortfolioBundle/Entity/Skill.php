<?php

namespace Exod\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exod\PortfolioBundle\Entity\Skill
 */
class Skill
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $label
     */
    private $label;

    /**
     * @var integer $date
     */
    private $coef;

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
     * @param text $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return text 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set coef
     *
     * @param integer $coef
     */
    public function setCoef($coef)
    {
    	$this->coef = $coef;
    }
    
    /**
     * Get coef
     *
     * @return integer
     */
    public function getCoef()
    {
    	return $this->coef;
    }
    
    public function toArray($bool=true){
    	$arrayReturn = get_object_vars($this);
    	return $arrayReturn;
    }
}