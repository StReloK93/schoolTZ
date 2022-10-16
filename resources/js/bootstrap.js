import axios from 'axios'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.withCredentials = true
axios.defaults.baseURL = '/api/'


import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.min.css'
window.Swal = Swal

import "ag-grid-community/styles/ag-grid.css"; 
import 'ag-grid-community/styles/ag-theme-alpine.css';
import './main/app.css'
