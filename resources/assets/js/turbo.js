import * as Turbo from "@hotwired/turbo";
window.Turbo = Turbo;
// Drive is disabled because repeated head-script evaluation causes runtime
// redeclaration errors with Ziggy/Livewire on this stack.
Turbo.session.drive = false;
Turbo.start();
export default Turbo;
