$(function () {
	// Footer print
	$('footer').text(getFooter("Alireza Meftahi"));

	// Active current page on navbar
	const url = window.location;
	activeCurrPage(url);

	// // Enabling confirmation
	// $('[data-toggle=confirmation]').confirmation({
	// 	rootSelector: '[data-toggle=confirmation]',
	// 	// other options
	// });
});