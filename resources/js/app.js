import 'flowbite';
// import './bootstrap.js';
import Swal from 'sweetalert2';
window.Swal = Swal;

import jQuery from 'jquery';
window.$ = window.jQuery= jQuery;


import select2 from 'select2';
select2();
import { Modal } from 'flowbite';
window.Modal = Modal;


import 'laravel-datatables-vite';
import 'jquery-validation';
import "/node_modules/select2/dist/css/select2.css";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Chart from 'chart.js/auto';
window.Chart = Chart;

