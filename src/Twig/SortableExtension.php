<?php

declare(strict_types=1);

namespace Aymericcucherousset\Ux\Sortable\Twig;

use Symfony\UX\StimulusBundle\Helper\StimulusHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SortableExtension extends AbstractExtension
{
    public function __construct(
        private StimulusHelper $stimulus,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'sortable_attributes',
                [$this, 'renderSortableAttributes'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param array<string, mixed>       $options
     * @param array<string, string|bool> $attributes
     */
    public function renderSortableAttributes(
        array $options = [],
        array $attributes = [],
    ): string {
        $stimulusAttributes = $this->stimulus->createStimulusAttributes();

        $normalizedOptions = [] === $options ? (object) [] : $options;

        $stimulusAttributes->addController(
            '@aymericcucherousset/ux-sortable/sortable',
            [
                'options' => $normalizedOptions,
                'prefix' => $attributes['prefix'] ?? 'sortable',
            ]
        );

        foreach ($attributes as $name => $value) {
            if (in_array($name, ['data-controller', 'live'], true)) {
                continue;
            }

            if (true === $value) {
                $stimulusAttributes->addAttribute($name, $name);
            } elseif (false !== $value) {
                $stimulusAttributes->addAttribute($name, $value);
            }
        }

        return (string) $stimulusAttributes;
    }
}
