// Tippy.js
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import 'tippy.js/themes/light.css';

export const useTippy = () => {
    tippy('[data-tippy-content]', {
        theme: 'light',
        trigger: 'click',
        allowHTML: true,
    });
}