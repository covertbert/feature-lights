var $ = jQuery;

$('.wpmenucartli').hover(showFlyoutMenu, hideFlyoutMenu);

function showFlyoutMenu() {
	$('.sub-menu.wpmenucart').show();
}

function hideFlyoutMenu() {
	$('.sub-menu.wpmenucart').hide();
}