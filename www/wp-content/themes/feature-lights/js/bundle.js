(function e(t, n, r) {
	function s(o, u) {
		if (!n[o]) {
			if (!t[o]) {
				var a = typeof require == "function" && require;if (!u && a) return a(o, !0);if (i) return i(o, !0);var f = new Error("Cannot find module '" + o + "'");throw f.code = "MODULE_NOT_FOUND", f;
			}var l = n[o] = { exports: {} };t[o][0].call(l.exports, function (e) {
				var n = t[o][1][e];return s(n ? n : e);
			}, l, l.exports, e, t, n, r);
		}return n[o].exports;
	}var i = typeof require == "function" && require;for (var o = 0; o < r.length; o++) s(r[o]);return s;
})({ 1: [function (require, module, exports) {
		jQuery(document).ready(function () {
			require('./modules/sorting-filter-position.js');
			require('./modules/cart-flyout.js');
			require('./modules/logo-clicks.js');
		});
	}, { "./modules/cart-flyout.js": 2, "./modules/logo-clicks.js": 3, "./modules/sorting-filter-position.js": 4 }], 2: [function (require, module, exports) {
		var $ = jQuery;

		$('.wpmenucartli').hover(showFlyoutMenu, hideFlyoutMenu);

		function showFlyoutMenu() {
			$('.sub-menu.wpmenucart').show();
		}

		function hideFlyoutMenu() {
			$('.sub-menu.wpmenucart').hide();
		}
	}, {}], 3: [function (require, module, exports) {
		var $ = jQuery;

		$('.header__logo, .sidebar-top__logo').on('click', function () {
			window.location = '/';
		});
	}, {}], 4: [function (require, module, exports) {
		var $ = jQuery;
		var filterListHeading = $('.filter-container .widget-title');

		filterListHeading.on('click', function () {
			var currentFilterButton = $(this);
			var currentFilterList = $(this).siblings('ul');
			currentFilterButton.toggleClass('widget-title--active');
			currentFilterList.toggleClass('filter-list--active');
		});
	}, {}] }, {}, [1]);
//# sourceMappingURL=bundle.js.map
