<?php
	/*
	 * Non OO_PHP-Template application.The file index.php
	 * serves as relay-station. It generates the default
	 * webpage, sets a default header, navigation and footer
	 * and can dynamically generate the `middle' content
	 * based upon a suitable PHP function (the action request) called.
	 *
	 * index.php decides what function to apply, i.e. what
	 * action to take, based upon the action argument it receives
	 * via the URL. It is important to understand that ALL user-actions
	 * , hence GET- and POST requests this application receive are
	 * relayed trough this file.
	 *
	 * Modified by DIRN on 09/06/2015, changelog 12341
	 */

	session_start(); // set serverside cookie

	require_once("conf/config.conf.php"); 	// System configuration also contains other require-statements

	// set to the user defined error handler, see : lib/general.lib.php
	$new_error_handler = set_error_handler("fcErrorHandler");

	$db_conn = databaseConnect(); // Connect to the Oracle db

	// Since every request or POST is routed via this PHP file
	// we may need to process a submitted form. Depending on the action argument
	// processCurrentAction does that.
	//
	// Avoid HTML output before this action. See for mapping of commands processing.lib.php
	processCurrentAction();

	// Functions that generate content to browser, see general.lib.php
	displayHeader(); 	 // Generate HTML header as well as the `top' of the page
	displayNavigation(); // Generate navigation bar-menu

	renderCurrentAction(); // Generate main content, basad upon action argument. See for mapping rendering.lib.php

	displayFooter(); // Generate footer and HTML footer as well.

	databaseDisconnect($db_conn); // disconnect from Oracle db
?>
