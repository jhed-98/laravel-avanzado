import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2'

// AlpineJS
window.Alpine = Alpine;
Alpine.start();

// Hacer que Swal esté disponible globalmente
window.Swal = Swal;
