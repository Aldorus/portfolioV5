<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('idFonctionnel')
            ->add('texte')
            ->add('path')
            ->add('idProjet')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_contenutype';
    }
}
