import axios from 'axios';
import 'flowbite';
import './template/dark-mode.js';
import $ from 'jquery';
import ApexCharts from 'apexcharts';


window.jQuery = window.$ = $;
window.axios = axios;
window.ApexCharts = ApexCharts;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
