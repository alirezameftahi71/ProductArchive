$(() => {
	// Footer print
	$('footer').text(getFooter("Alireza Meftahi"));

	// Active current page on navbar
	activeCurrPage(window.location);

	// Enabling confirmation
	$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		// other options
	});
});