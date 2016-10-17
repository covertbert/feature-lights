var $ = jQuery;
var filterListHeading = $('.filter-container .widget-title');

filterListHeading.on('click', function () {
	var currentFilterButton = $(this);
	var currentFilterList = $(this).siblings('ul');
	currentFilterButton.toggleClass('widget-title--active');
	currentFilterList.toggleClass('filter-list--active');
});