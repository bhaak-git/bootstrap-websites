<?php
	/*
	 * renderingMap is an associative array that defines what
	 * renderingAction should follow after a certain action.
	 * 
	 * The process is a PHP function that is executed via the
	 * eval function. The functionality for rendering is very similar 
	 * to processCurrentAction in lib/processing.lib.php
	 * 
	 * updated by DIRN on 09-06-2015
	 */
   
	// define renderingMap
	$renderingMap[$config['defaultaction']]	='displayHome();';		    //ref: inc/general.inc.php
	$renderingMap["showCustomers"]      ='displayAllCustomers();';      //ref: rendering/customers.rdr.php
    $renderingMap["showAddCustomer"]    ='displayAddCustomer();';       //ref: rendering/customers.rdr.php
    $renderingMap["showEditCustomer"]   ='displayEditCustomer();';      //ref: rendering/customers.rdr.php
	$renderingMap["showArticles"]       ='displayAllArticles();';       //ref: rendering/articles.rdr.php
	$renderingMap["showAddArticle"]     ='displayAddArticle();';       //ref: rendering/articles.rdr.php
	$renderingMap["showEditArticle"]    ='displayeditArticle();';       //ref: rendering/articles.rdr.php
	$renderingMap["showLogin"]    		='displayLogin();';            //ref: rendering/rendering.rdr.php
	$renderingMap["showShop"]    		='displayShop();';            //ref: rendering/shop.rdr.php
	$renderingMap["showShoppingCart"]   ='displayShoppingCart();';     //ref: rendering/shoppingcart.rdr.php
	$renderingMap["showCheckout"]   	='displayCheckout();';     	//ref: rendering/shoppingcart.rdr.php
	
	
	
	function renderCurrentAction(){
		global $renderingMap, $config; // as defined in this file and configuration-file
				
		if(isset($renderingMap[getCurrentAction()])){
			eval($renderingMap[getCurrentAction()]);
		} else {
		    eval($renderingMap[$config['defaultaction']]);
            log_message("No mapping for requested rendering/process. ". getCurrentAction() . " Redirecting to defaultaction.");
		}
        
       }

?>