<?php
	/**
	 * This file contains all configuration related settings of the system.
	 *
	 * Modified by DIRN on 10/06/2015
	 */

	 // make sure error logging is turned on
	error_reporting(E_ALL);

	// Configurations are stored in an array.
	$config = array();

    // Database configuration settings
    $config['mysql']['hostname'] = "localhost";
    $config['mysql']['username'] = "fcuser";
    $config['mysql']['password'] = "1234";
    $config['mysql']['database'] = "downhatgym";


    /**
     * Default application configuration settings
     */
    $config['pagetitle']        = "Downhat Gym Sportinggoods"; // Title of the application
    $config['defaultaction']    = "home"; // Default action if none is specified
    $config['loglocation']      = 'log'; // relative path to the logfile folder. Make sure that write permissions are set.

	// library files: functions that are used in multiple user functions
	require_once("lib/messages.lib.php");  				// Messaging functionality. Also errorhandling.
	require_once("lib/database.lib.php"); 				// Functions to connect to the DB
	require_once("lib/authorisation.lib.php"); 			// Functionality concerning authentication and authorisation
	require_once("lib/general.lib.php"); 				// generic functions like DrawHeader and DrawFooter
	require_once("lib/sorting.lib.php"); 				// Sorting functions
	require_once("lib/processing.lib.php"); 			// Functionality to process requests
	require_once("lib/rendering.lib.php");  			// Functionality to render HTML
	require_once("lib/html.lib.php");					// functionality concerning rendering of HTML elements

	// functionality concerning processing of pages
  	require_once("processing/login.pcs.php");			// contains functions to handle login and logout
	require_once("processing/customers.pcs.php");       // contains functions to generate functionallity concerning the customers page
  	require_once("processing/articles.pcs.php");        // contains functions to generate functionallity concerning the articles page
  	require_once("processing/shoppingcart.pcs.php");	// containts functionallity to handle shoppingcart requests

	// functionality concerning rendering of pages
	require_once("rendering/login.rdr.php");			// contains functions to generate login page
	require_once("rendering/customers.rdr.php");        // contains functions to generate functionallity concerning the customer page
  	require_once("rendering/articles.rdr.php");         // contains functions to generate functionallity concerning the article page
	require_once("rendering/shop.rdr.php");				// containts functions to generate functionality concerning the shop
	require_once("rendering/shoppingcart.rdr.php");		// contrains functionallity to generate the shoppingCart
?>
