<?php

namespace Exod\PortfolioBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExodPortfolioBundle extends Bundle
{
 	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
