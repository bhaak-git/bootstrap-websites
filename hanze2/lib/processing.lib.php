<?php
	/*
	 * processingMap is an associative array that defines what
	 * process should follow after a certain action.
	 *
	 * The process is a PHP function that is executed via the
	 * eval function. The function takes on whatever session
	 * variables are available (via $_SESSION or $_POST) and
	 * redirects via index.php to render a result page to the
	 * user.
	 */
    //log_message("Start loading processing.lib");

	$processingMap[$config['defaultaction']]='';
	$processingMap["insertCustomer"]='addCustomer();';					    // ref: processing/customers.pcs.php
	$processingMap["updateCustomer"]='updateCustomer();';					// ref: processing/customers.pcs.php
	$processingMap["deleteCustomer"]='deleteCustomer();';					// ref: processing/customers.pcs.php
	$processingMap["insertArticle"]	='addArticle();';                       // ref: processing/articles.pcs.php
  $processingMap["updateArticle"]	='updateArticle();';                    // ref: processing/articles.pcs.php
  $processingMap["deleteArticle"]	='deleteArticle();';                    // ref: processing/articles.pcs.php
  $processingMap["logout"]		='logout();';                           // ref: processing/login.pcs.php
  $processingMap["login"]			='login();';                            // ref: processing/login.pcs.php
	$processingMap["redirectToShop"]='redirectToShop();';                   // ref: processing/shop.pcs.php
	$processingMap["processShoppingCart"]='processShoppingCart();';         // ref: processing/shoppingcart.pcs.php
  $processingMap["placeOrder"]	='placeOrder();';						// ref: processing/shoppingcart.pcs.php

	function processCurrentAction(){
		global $processingMap; // defined in this file

		// retrieve command from $_GET and execute
    	if(isset($processingMap[getCurrentAction()])){
    		log_message("Processing action request: ".getCurrentAction());
    		//execute command as defined in above mapping;
    		eval($processingMap[getCurrentAction()]);
    	} else {
    	    log_message("No mapping for requested action/process: ". getCurrentAction());
    	}


	}
    //log_message("Finished loading processing.lib");
?>
