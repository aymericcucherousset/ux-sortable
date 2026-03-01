<?php

declare(strict_types=1);

namespace Aymericcucherousset\Ux\Sortable\DependencyInjection;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

final class SortableExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        if ($this->isAssetMapperAvailable($container)) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        __DIR__.'/../../assets/dist' => '@aymericcucherousset/ux-sortable',
                    ],
                ],
            ]);
        }
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new \Symfony\Component\DependencyInjection\Loader\PhpFileLoader(
            $container,
            new \Symfony\Component\Config\FileLocator(__DIR__.'/../../config')
        );

        if (is_file(__DIR__.'/../../config/services.php')) {
            $loader->load('services.php');
        }
    }

    private function isAssetMapperAvailable(ContainerBuilder $container): bool
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        /** @var array{FrameworkBundle?: bool} $bundlesMetadata */
        $bundlesMetadata = $container->getParameter('kernel.bundles_metadata');

        return isset($bundlesMetadata['FrameworkBundle']);
    }
}
