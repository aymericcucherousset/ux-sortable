# Usage with LiveComponents

Symfony UX Sortable integrates seamlessly with Symfony UX LiveComponent for dynamic, interactive lists.

## 1. Create a Twig Component

**Twig template:**  
File: templates/components/TestList.html.twig

```twig
<div {{ attributes }}>
    <ul {{ sortable_attributes(
        { animation: 300 },
        { prefix: 'reorder' }
    ) }}>
        {% for item in items %}
            <li data-id="{{ item.id }}">
                {{ item.name }}
            </li>
        {% else %}
            <li>No items</li>
        {% endfor %}
    </ul>
</div>
```

**PHP component:**  
File: src/Twig/Components/TestList.php

```php
<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class TestList
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public array $items = [];

    #[LiveListener(eventName: 'reorder.end')]
    public function reorder(
        #[LiveArg()] array $order,
        #[LiveArg()] array $ids,
        #[LiveArg()] int $oldIndex,
        #[LiveArg()] int $newIndex,
    ): void
    {
        $item = $this->items[$oldIndex];

        array_splice($this->items, $oldIndex, 1);

        array_splice($this->items, $newIndex, 0, [$item]);

        // Handle reordered items (example: dump for debug)
        dd($this->items);
    }
}
```

## 2. Use the Component in a Page

```twig
{{ component('TestList', {
    items: [
        { id: 1, name: 'Item 1' },
        { id: 2, name: 'Item 2' },
        { id: 3, name: 'Item 3' },
    ],
}) }}
```

## How it works

- The `sortable_attributes` helper generates the necessary Stimulus data attributes.
- The `prefix` option (e.g., `'reorder'`) customizes the event name emitted on reorder.
- The `LiveListener` listens for the `reorder.end` event and updates the items array accordingly.

**Result:**  
Drag & drop reordering is fully reactive, and the component updates automatically.
