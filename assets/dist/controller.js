import { Controller } from '@hotwired/stimulus'
import Sortable from 'sortablejs'

class SortableController extends Controller {
    static values = {
        options: Object
    }

    connect() {
        this.sortable = new Sortable(this.element, {
            animation: 150,
            ...this.optionsValue
        })
    }

    disconnect() {
        this.sortable?.destroy()
    }
}

export default SortableController
