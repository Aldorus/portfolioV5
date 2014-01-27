<?php

namespace Exod\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('coef')
        ;
    }

    public function getName()
    {
        return 'exod_portfoliobundle_skilltype';
    }
}
