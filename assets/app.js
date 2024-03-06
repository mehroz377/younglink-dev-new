import './styles/app.scss';

// Vis.js
import { visJsDraw } from './js/visJsDraw';
window.drawSociogram = visJsDraw

// Tippy.js
import tippy, { useTippy } from './js/useTippy.js';
useTippy();