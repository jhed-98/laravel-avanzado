import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.min.js';

import './assets/string_to_slug';

// AlpineJS
window.Alpine = Alpine;
Alpine.start();

// Hacer que Swal esté disponible globalmente
window.Swal = Swal;
