# Symfony UX Sortable

A lightweight Symfony UX wrapper around SortableJS
 using AssetMapper & Stimulus.

Symfony UX Sortable integrates [SortableJS](https://github.com/SortableJS/Sortable) into Symfony applications using:

- AssetMapper (no Webpack/Vite required)
- Stimulus
- Twig helper
- Importmap

## Features

- Drag & drop reordering
- Fully configurable SortableJS options
- Clean Twig API
- Zero build step

Compatible with Symfony 7.4 / 8+

## Installation

```bash
composer require aymericcucherousset/ux-sortable
```

If you are using Symfony Flex, the bundle is auto-registered.

Then install JavaScript dependencies:

```bash
php bin/console importmap:install
```

## Basic Usage

### Twig

```twig
<ul {{ sortable_attributes() }}>
    <li>Item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
</ul>
```

That’s it. Drag & drop is now enabled.

### Passing Options

You can pass any SortableJS option:

```twig
<ul {{ sortable_attributes({
    group: 'tasks',
    animation: 150,
    ghostClass: 'bg-gray-200'
}) }}>
    <li>Task A</li>
    <li>Task B</li>
</ul>
```

Options are automatically encoded as a valid JSON object.

### How It Works

Registers a Stimulus controller
Uses AssetMapper to expose JS assets
Wraps SortableJS
Generates correct Stimulus data attributes via Twig
Generated HTML example:

```html
<ul
  data-controller="aymericcucherousset--ux-sortable--sortable"
  data-aymericcucherousset--ux-sortable--sortable-options-value='{"animation":150}'
>
```

## Requirements

- PHP 8.3+
- Symfony 7.4+ or 8+
- symfony/stimulus-bundle
- symfony/asset-mapper

## Advanced Usage

You can still access the controller manually if needed:

```html
<ul
  data-controller="aymericcucherousset--ux-sortable--sortable"
  data-aymericcucherousset--ux-sortable--sortable-options-value='{"animation":300}'
>
```

## Roadmap

- [ ] Emit custom events  
- [ ] Integration with Symfony UX LiveComponent
- [ ] Nested sortable support
- [x] TypeScript support
- [ ] Auto persistence helper

## Versioning

Current version: v0.0.1

This is an early release. API may evolve before 1.0.

## Contributing

Issues and pull requests are welcome.
