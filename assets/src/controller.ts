import { Controller } from '@hotwired/stimulus'
import Sortable, { Options } from 'sortablejs'

export default class extends Controller<HTMLUListElement> {
    static values = {
        options: Object
    }

    declare readonly optionsValue: Options

    private sortable?: Sortable

    connect(): void {
        this.sortable = new Sortable(this.element, {
            animation: 150,
            ...this.optionsValue
        })
    }

    disconnect(): void {
        this.sortable?.destroy()
    }
}
