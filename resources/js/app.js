import './bootstrap';

import Alpine from 'alpinejs';
import inputmask from 'inputmask';

//Acrescenta a mascara
document.addEventListener("DOMContentLoaded", function () {
    
    var cpfMask = new Inputmask("999.999.999-99");
    cpfMask.mask(document.querySelectorAll('.cpf'));
    
    var celularMask = new Inputmask("(99) 9 9999-9999)");
    celularMask.mask(document.querySelectorAll('.celular'));

    var placaMask = new Inputmask("###-9#99");
    placaMask.mask(document.querySelectorAll('#mask-placa'));
});

window.Alpine = Alpine;

Alpine.start();
