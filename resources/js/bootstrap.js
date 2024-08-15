import axios from 'axios';
// Import our custom CSS
import '../sass/app.scss';
// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
