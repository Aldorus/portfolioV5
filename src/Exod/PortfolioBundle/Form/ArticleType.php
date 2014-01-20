<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('label')
            ->add('idprojet')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_articletype';
    }
}
