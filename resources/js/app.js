import './bootstrap';

import Alpine from 'alpinejs';
import Inputmask from "inputmask";
window.Inputmask = Inputmask; // torna disponível globalmente

window.Alpine = Alpine;

Alpine.start();
