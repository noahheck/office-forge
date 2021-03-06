// Stimulus
import { Application } from "stimulus";
import { definitionsFromContext } from "stimulus/webpack-helpers";

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.moment = require('moment');

    require('bootstrap');
    require('bootstrap-select');
    require('ajax-bootstrap-select');
    require('bootstrap-datepicker');
    require('tempusdominus-bootstrap-4');

    let $ = window.$;

    $.fn.selectpicker.Constructor.DEFAULTS.iconBase = "fa-fw";
    $.fn.selectpicker.Constructor.DEFAULTS.dropupAuto = false;

    (async function() {
        require('Component/trix');
    })();


    require('Component/phone-field');
    require('Component/money-field');
    require('Component/integer-field');
    require('Component/range-field');
    require('Component/decimal-field');
    require('Component/file-input-field');
    require('Component/file-search-field');


    let dt = require('datatables.net-bs4');
    let buttons = require('datatables.net-buttons-bs4');


    // Stimulus controllers
    const application = Application.start()
    const context = require.context("./controllers", true, /\.js$/)
    application.load(definitionsFromContext(context))

    // let buttons = require('datatables.net-buttons');
             /*require( 'datatables.net-buttons/js/buttons.colVis.js' )(); // Column visibility
             require( 'datatables.net-buttons/js/buttons.html5.js' )();  // HTML 5 file export
             require( 'datatables.net-buttons/js/buttons.flash.js' )();  // Flash file export
             require( 'datatables.net-buttons/js/buttons.print.js' )();  // Print view button*/

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
