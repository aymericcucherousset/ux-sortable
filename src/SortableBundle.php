<?php

declare(strict_types=1);

namespace Aymericcucherousset\Ux\Sortable;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SortableBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $loader = new PhpFileLoader(
            $container,
            new FileLocator(__DIR__.'/../config')
        );

        $loader->load('services.php');
    }
}
