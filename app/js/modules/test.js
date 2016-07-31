var test = (function( $ ) {

	'use strict';

	// some tests to show our new theme has built OK in the frontend

	function _sayYep() {
		$('.js-yep').html('It sure is!');
	}

	return {
		init : _sayYep
	};
	
})( jQuery );