<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('texte')
            ->add('date')
            ->add('fini')
            ->add('path')
            ->add('idcategorie')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_projettype';
    }
}
