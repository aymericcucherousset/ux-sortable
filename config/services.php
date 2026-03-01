<?php

declare(strict_types=1);

use Aymericcucherousset\Ux\Sortable\Twig\SortableExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\UX\StimulusBundle\Helper\StimulusHelper;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    // Alias pour permettre l'autowiring du StimulusHelper
    $services->alias(StimulusHelper::class, 'stimulus.helper');

    $services->set(SortableExtension::class)
        ->tag('twig.extension');
};
