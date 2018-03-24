$(function() {
	// Footer print
	$('footer').text(getFooter("Alireza Meftahi"));

	// Active current page on navbar
	var url = window.location;
	activeCurrPage(url);
});