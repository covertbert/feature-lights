// Below we are using a node-like `require`, provided by our grunt-neuter task.
// This works the same as in the HAVAS LYNX eDetail boilerplate
// https://gitlab.havaslynx.com/frontend/eDetail-boilerplate
// https://github.com/trek/grunt-neuter
// In this configuration it's doing little more than concatenate our scripts on build, 
// in the order we specify them...
//
// Our modules...
require('modules/test.js');

// In this next expression we are passing-in jQuery to the anonymous function (IIFE), so 
// that we can use the `$` shortcut in the local scope for our scripts as normal.
// Without this step we would have to use the full `jQuery` name in all our scripts,
// or maybe add something like:
// var $ = jQuery.noConflict();
// This is because WordPress loads jQuery in `compatibility` mode by default, to avoid
// conflicts with other JS libs which may also use `$` as a shortcut.
//
(function ($) {

	// Initialise required modules

	test.init();

})(jQuery);


// app.js is loaded in to our custom theme, using the WordPress script loader. 
// The script tags are automatically added to your template header.php or footer.php
// as-required, see `php/functions.php` and `readme.md`
// In this project `app.js` is known to WordPress by the `handle` `hl_app`.
