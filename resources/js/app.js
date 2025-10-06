import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import Swal from 'sweetalert2';
import axios from 'axios';

window.Swal = Swal;
window.axios = axios;

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
