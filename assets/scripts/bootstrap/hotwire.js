import { startStimulusApp, registerControllers } from "vite-plugin-symfony/stimulus/helpers";
import * as Turbo from "@hotwired/turbo";
// import ModalWindow from "@dpsys/stimulus-modal-window";
// import AutoSubmit from "@stimulus-components/auto-submit";
import LiveControllerDefault from "@symfony/ux-live-component";


const stimulusApp = startStimulusApp();
registerControllers(
  stimulusApp,
  import.meta.glob('../controllers/**/*_controller.*s', {
    query: "?stimulus",
    /**
     * always true, the `lazy` behavior is managed internally with
     * import.meta.stimulusFetch (see reference)
     */
    eager: true,
  })
)

stimulusApp.debug = false;
stimulusApp.register('live', LiveControllerDefault);
// stimulusApp.register('modal-window', ModalWindow);
// stimulusApp.register('auto-submit', AutoSubmit);
Turbo.config.forms.mode = 'off';

// https://github.com/lhapaipai/symfony-vite-dev/issues/63
// https://symfony-vite.pentatrion.com/stimulus/installation.html#installation
if (import.meta.hot) 
{
    window.$$stimulusApp$$ = stimulusApp;
}


// Přehledné logování všech Symfony UX / Custom událostí
// const originalDispatch = EventTarget.prototype.dispatchEvent;

// EventTarget.prototype.dispatchEvent = function(event) 
// {
//     console.groupCollapsed(`⚡ [Event] ${event.type}`);
//     console.log('Detail:', event.detail);
//     console.log('Target element:', this);
//     console.groupEnd();

//     return originalDispatch.apply(this, arguments);
// };