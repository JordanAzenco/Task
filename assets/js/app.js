/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

/* // any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css'); */

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');
const PlusPath = require('../images/addition-sign.png');
const ClosePath = require('../images/close.png');
const UpdatePath = require('../images/refresh-button.png');

ajax_request = require('./ajax_request');


const $ = require('jquery');
global.$ = global.jQuery = $;

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
});
 


