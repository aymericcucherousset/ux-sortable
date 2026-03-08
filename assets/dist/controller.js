// src/controller.ts
import { Controller } from "@hotwired/stimulus";
import Sortable from "sortablejs";
import { getComponent } from "@symfony/ux-live-component";
var controller_default = class extends Controller {
  connect() {
    this.sortable = new Sortable(this.element, {
      animation: 150,
      ...this.optionsValue,
      onStart: (event) => this.emit("start", event),
      onEnd: (event) => this.emit("end", event),
      onAdd: (event) => this.emit("add", event),
      onUpdate: (event) => this.emit("update", event),
      onRemove: (event) => this.emit("remove", event)
    });
  }
  disconnect() {
    this.sortable?.destroy();
  }
  async emit(name, event) {
    const order = Array.from(this.element.children).map(
      (el) => el.dataset.id
    );
    const componentEl = this.element.closest('[data-controller~="live"]');
    if (!componentEl === null) {
      console.warn("No live component found for sortable controller");
      return;
    }
    const component = await getComponent(componentEl);
    component.emit(`${this.prefixValue}.${name}`, {
      order,
      ids: order,
      oldIndex: event.oldIndex,
      newIndex: event.newIndex
    });
  }
};
controller_default.values = {
  options: Object,
  prefix: String
};
export {
  controller_default as default
};
