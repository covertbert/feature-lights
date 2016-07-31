# Wordpress Boilerplate

# Release 0.1.2 - "Pob"

First off, using this approach, everything you author is contained within `app`, which sits __outside__ the WordPress installation. So if you're editing files inside the WordPress theme folder, you're gonna have a bad time.

Plugins and uploads are where you'd expect them to be.

## What you need to configure and do to get going
* Pretty much the only thing you have to _configure_ is, aside from getting your copy of WordPress up and running, is inside  `project-congig.js`. The `local` setting inside the `host` object needs to match the local development URL you're using. This is just so when you run Grunt, Browser-Sync will fire up a proxy to sort out your live reloading.
* To get the tooling ready install your Node dependencies and Bower dependencies if you need them (a couple are included for examples' sake) with `npm i && bower i`.
* Make sure you've got MAMP running with your WordPress instance going and then do `grunt serve` to start the server.

## Debugging

* At an absolute minimum, it's recommended to have at least this line:
**`define('WP_DEBUG', true);`**
in your wp-config.php while you are developing your theme, so you can follow any PHP errors generated in the browser.
If you want a log file too, you can set:
`define('WP_DEBUG_LOG', true);`
which will output debug.log, in wp-content directory, then in a term window you can do this to follow it, for example:
`$> tail -f debug.log`
There are plenty of other debug settings and helper plugins. Start here:
[Debugging in WordPress](https://codex.wordpress.org/Debugging_in_WordPress)
* If you’re not used to PHP, it’s worth noting that without some helper code, there’s no JavaScript-style Console as such. A couple of useful functions to get you started, instead of console.log :]
1. `var_dump( mixed $expression [, mixed $... ] )` - Dumps information about a variable to the browser window
2. `print_r( mixed $expression [, bool $return = false ] )` - Prints human-readable information about a variable to browser window, useful for displaying the contents of arrays for example

[var_dump at php.net](http://php.net/manual/en/function.var-dump.php)
[print_r at php.net](http://php.net/manual/en/function.print-r.php)

## The database
* Just install WordPress as you normally would!
* __We'd strongly recommend using the same database name, username and password for everyone's installation.__ That way you can commit your wp-config.php and not have problems.

### Modernizr
* This project includes a minimal Modernizr build, which just adds the body classes.
* Modernizr CLI is recommended for building your own custom Modernizr with only the features you need. You can add the detection tests you need, then download or copy the resulting config file. [see Modernizr docs](https://modernizr.com/docs). 
* A sample Modernizr config is included with this boilerplate, and the resulting build is loaded in Head. 
* You can build your own config file at [modernizr.com](https://modernizr.com/download?setclasses)

    `$> npm install -g modernizr
    $> modernizr -c modernizr-config.json -d app/js/head/modernizr.js`

## "app"
So within `app` you've got

* `config` - This gets synced straight into the root of the theme. My intention was to keep this for the things that WordPress __has__ to have, like `style.css` and optionally a screenshot of the theme
* `img` - While developing, this gets synced into `assets/img` and _maintains any file structure you've got_
* `js` - Your authored js gets concatenated into `assets/js/app.js` complete with source map
* `js/head/` - If you have to load any scripts in the Head of your page (Modernizr for example), you can place them in this directory get and they will concatenated into `assets/js/head.js` and loaded in the Head of the page by WordPress. Scripts in this directory don't get minified, so you can grab the minified version of any vendor scripts you're using, if that's an option. 
* `others` - Anything in here gets synced into `assets`. Examples of stuff appropriate for here would be videos, downloads, documents
* `php` - Your *.php files get synced into the root of the theme, _including any subfolders that contain php files_
* `scss` - The SASS gets concatenated into `assets/css`.

## "www"
This is the document root of your WordPress site. When using MAMP for example, your web document root wants to be here.

## Bower!

### Using CSS & JS Bower components in your project
If you look inside any bower component you'll see that in the root there's a file called `bower.json`. This file details the component's dependencies, as _your_ main `bower.json` does, and it also has a key called `main:`. This `main:` is an array of files that constitute the main files that the plugin exposes. So for example, Bootstrap's `main:` entry it has:

    "main": [
     "less/bootstrap.less",
     "dist/js/bootstrap.js"
     ]

Therefore, the two main files that Bootstrap exposes are the main `bootstrap.less` file, and the fully compiled `bootstrap.js` file.

Inside this boilerplate is [Wiredep](https://github.com/taptapship/wiredep). Wiredep will go through _your_ main `bower.json`, grab all the main files that your components expose and then depending on their dependencies will work out the best order for your files to be in. So if you install jQuery and jQuery UI via Bower, Wiredep will determine correctly that in your concatenated `theme/assets/js/vendor.js` file, jQuery needs to come before jQuery UI.

A couple of things to note:

* Anything you want to include from your `bower.json` file needs to be in __dependencies__, not _dev-dependencies_.
* Wiredep does its thing via your `bower.json` __FILE__. It's not enough to have your bower component _there_ in the bower_components folder!

### Using SCSS frameworks in your projects
So the above talks about using raw JS and CSS from components that use those. If they use SCSS in a modular fashion, you don't want to copy these files exactly into your theme - you want to simply make them accessible to the compiler and import them if and when you want access to their mixins in your own `style.scss`.

The `bunder-wiredep` task will also look for SCSS files and import their locations to the Sass compiler's loadPath so you don't have to import them manually.


## JavaScript Conventions

### General principles
WordPress is a mature, and (very) opinionated, Open Source project - remember there will be other JavaScripts working in the finished site besides your own, which you may have no control over, for example WordPress admin screen scripts, and scripts from any plugins you have used, or plugins which other developers or administrators may add to your project in the future.

### In practice
For this reason, this boilerplate uses the built-in WordPress script loader `wp_enqueue_script`, which handles script library dependencies and loading. You can do this by assigning a name (`handle` in WordPress) to any script you need to load, in functions.php, and specifying its dependencies there also.
WordPress will then automatically append the relevant script tags to the header and/or footer of your templates.
WordPress comes bundled with versions of several popular JavaScipt libraries, including jQuery, jQuery UI, Backbone and Underscore. You can see the full list here.

* [wp_enqueue_script reference…](https://developer.wordpress.org/reference/functions/wp_enqueue_script/)

### jQuery in particular
Where jQuery is a dependency, it is loaded by WordPress in `compatibility mode` to avoid conflicts with other libraries. One consequence of this is that the usual `$` shortcut for `jQuery` is not available unless you make it so yourself, ie. you have to write out `jQuery` in full, unless you 1. redefine $ as jQuery.noConflict(), or 2. pass-in jQuery as an argument in an anonymous function, which can then use the `$` in its local scope.

The above is why you'll see the functions encapsulated so that `$` is available for use with jQuery. So an example of a function would be:

    (function ( $, ) {

    	// your code here

    })( jQuery );

This approach to modularising script blocks is more thoroughly documented in the code.

### Further reading
* [More information on jQuery noConflict mode](https://learn.jquery.com/using-jquery-core/avoid-conflicts-other-libraries/)
* [Background to using jQuery with WordPress](https://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/)
* [Why you shouldn’t load your own copies of scripts which WordPress already supplies](https://pippinsplugins.com/why-loading-your-own-jquery-is-irresponsible/)

### Your own scripts
You can write your own JavaScripts as modules, for example, then use a node-style `require` in app.js in order to concatenate them - the same process as in our own [eDetail boilerplate](https://gitlab.havaslynx.com/frontend/eDetail-boilerplate), which also uses [`grunt-neuter`](https://github.com/trek/grunt-neuter). It’s very lightweight, but does give you the chance to specify the order in which your scripts are concatenated. For more involved projects you may need to incorporate a true module dependency manager/loader like [RequireJS](http://requirejs.org)

## The Grunt Tasks
The three you need to use are:

* `grunt` (default) to do all the necessaries and start a livereload proxy server
* `grunt quick` will do a default build without minifying anything. Basically a dev version without the server
* `grunt build` will do the usual and then imagemin and minify the scripts and styles