<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('texte')
            ->add('date')
            ->add('idarticle')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_acualitetype';
    }
}
