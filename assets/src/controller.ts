import { Controller } from '@hotwired/stimulus'
import Sortable, { Options, SortableEvent } from 'sortablejs'
import { getComponent } from '@symfony/ux-live-component'

export default class extends Controller<HTMLUListElement> {
    static values = {
        options: Object,
        prefix: String,
    }

    declare readonly optionsValue: Options
    declare readonly prefixValue: string

    private sortable?: Sortable

    connect(): void {
        this.sortable = new Sortable(this.element, {
            animation: 150,
            ...this.optionsValue,

            onStart: (event) => this.emit('start', event),
            onEnd: (event) => this.emit('end', event),
            onAdd: (event) => this.emit('add', event),
            onUpdate: (event) => this.emit('update', event),
            onRemove: (event) => this.emit('remove', event)
        })
    }

    disconnect(): void {
        this.sortable?.destroy()
    }

    private async emit(name: string, event: SortableEvent): Promise<void> {
        const order = Array.from(this.element.children).map(
            (el: any) => el.dataset.id
        )

        const componentEl = this.element.closest('[data-controller~="live"]');

        if (!componentEl === null) {
            console.warn('No live component found for sortable controller');
            return;
        }

        const component = await getComponent(componentEl as HTMLElement);

        component.emit(`${this.prefixValue}.${name}`, {
            order,
            ids: order,
            oldIndex: event.oldIndex,
            newIndex: event.newIndex
        });
    }
}
