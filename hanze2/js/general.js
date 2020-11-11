/*
	This file contains a helperfunction in JS
 */


/*
    This function asks the user 'message'
    if the user gives OK the browser is redirected to 'url'
 */
function confirmAction(message, url) {
	if(confirm(message) == true) {
		document.location.href = url;
	}
}