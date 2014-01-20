<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('path')
            ->add('date')
            ->add('idprojet')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_documenttype';
    }
}
