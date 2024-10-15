import axios from 'axios';
import 'flowbite';
import './template/dark-mode.js';
import $ from 'jquery';
import './pace/pace.min.js';

if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
    '(prefers-color-scheme: dark)').matches)) {
document.documentElement.classList.add('dark');
} else {
document.documentElement.classList.remove('dark')
}

window.jQuery = window.$ = $;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
