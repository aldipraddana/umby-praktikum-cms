// Bootstrap CSS and jQuery setup
import 'bootstrap/dist/css/bootstrap.min.css';
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap';

// CSRF token for all AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
