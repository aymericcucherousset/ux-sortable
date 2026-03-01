// src/controller.ts
import { Controller } from "@hotwired/stimulus";
import Sortable from "sortablejs";
var controller_default = class extends Controller {
  connect() {
    this.sortable = new Sortable(this.element, {
      animation: 150,
      ...this.optionsValue
    });
  }
  disconnect() {
    this.sortable?.destroy();
  }
};
controller_default.values = {
  options: Object
};
export {
  controller_default as default
};
