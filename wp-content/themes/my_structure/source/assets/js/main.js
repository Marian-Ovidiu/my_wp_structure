import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import axios from 'axios';
import ApiService from './Classes/ApiService.js';

window.axios = axios;
window.Alpine = Alpine;
window.ApiService = ApiService;

Alpine.plugin(intersect);
Alpine.start();
