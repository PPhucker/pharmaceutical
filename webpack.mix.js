const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').
    sass('resources/sass/app.scss', 'public/css').
    postCss('resources/css/app.css', 'public/css').
    postCss('resources/css/templates/documents/invoice_for_payment.css', 'public/css/templates/documents').
    postCss('resources/css/templates/documents/shipment/packing_list.css', 'public/css/templates/documents/shipment').
    postCss('resources/css/templates/documents/shipment/bill.css', 'public/css/templates/documents/shipment').
    postCss('resources/css/templates/documents/shipment/appendix.css', 'public/css/templates/documents/shipment').
    postCss('resources/css/templates/documents/shipment/protocol.css', 'public/css/templates/documents/shipment').
    minify(['public/js/app.js', 'public/css/app.css']);
