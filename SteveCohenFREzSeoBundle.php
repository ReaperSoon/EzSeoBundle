<?php

namespace SteveCohenFR\EzSeoBundle;

use SteveCohenFR\EzSeoBundle\DependencyInjection\AddProvidersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SteveCohenFREzSeoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddProvidersPass());
    }
}