<?php

	// depending on what button pressed this function will decide what action to take
	function processShoppingCart(){

		# update contents of shoppingcart
		storeShopCartDataInSession();
		updateShoppingCart();

		if(isset($_POST['updateCartNextShop'])){
			$succesRedirectLocation = "index.php?action=showShop";

		}

		if(isset($_POST['updateCartNextCheckout'])){
			$succesRedirectLocation = "index.php?action=showCheckout";

		}
		# requested branch

		immediate_redirect_to($succesRedirectLocation); // return to shop

	}

	function updateShoppingCart(){

		// declaration and initialisation
		$dataentryName 			= 'shoppingCartData';
		$orderLineAantalKeys 	= array();
		$orderLineMaatKeys 		= array();

		foreach($_POST as $key => $value){

	 		if (strpos($key, "orderlineaantal")!==FALSE){
	 			$orderLineAantalKeys[] = $key;
	 		}

			if (strpos($key, "orderlinemaat")!==FALSE){
	 			$orderLineMaatKeys[] = $key;
	 		}

		}




		foreach ($orderLineMaatKeys as $index => $orderLineMaatKey) {

			$orderLineIndex = str_replace("orderlinemaat-", "", $orderLineMaatKey);

			$maat = $_POST[$orderLineMaatKey];

			$_SESSION[$dataentryName]['orderlines'][$orderLineIndex]['maat'] = $maat;

		}

		foreach ($orderLineAantalKeys as $index => $orderLineAantalKey) {

			$orderLineIndex = str_replace("orderlineaantal-", "", $orderLineAantalKey);

			$aantal = $_POST[$orderLineAantalKey];

			$_SESSION[$dataentryName]['orderlines'][$orderLineIndex]['aantal'] = $aantal;

			// if aantal == 0, then remove orderline, it is important where to write this line.
			if($aantal == 0 ){

				unset($_SESSION[$dataentryName]['orderlines'][$orderLineIndex]);
			}
		}

	}

	/**
    * Stores $_POST data in session. This function
    * should be called by handling functions before
    * any computations on the data is performed.
    *
    * Works in conjunction with returnValueFromSession
    * stored in general.lib.
    */
    function storeShopCartDataInSession(){

		$dataentryName = 'shoppingCartData';

		// removing data about previous pushed buttons
		// form the session data-entry. THis is not information
		// we are interested in keeping.
		unset($_SESSION[$dataentryName]['updateCartNextShop']);
		unset($_SESSION[$dataentryName]['updateCartNextShop']);

    	if (isset($_SESSION[$dataentryName])){
    		// if the shopData entry is set, it may contain data that is not set via a form submission
    		// but directrly in PHP code. If we would blunlty overwrite session data with POST we would
    		// lose this data. (i.e. $_SESSION['shopData'] = $_POST;
    		$shopTechnicalData = array_diff_assoc($_SESSION[$dataentryName], $_POST); // data that was not submitted via form

    		// In the $_SESSION array we find information about technical items as well as previous
    		// POSTS. We need to know which keys in the POST message (that is form submission data)
    		// is available. Generally speaking this is newer information, that we need to merge into the
    		// $_SESSION
    		$newDataKeys = array_intersect_key($_POST, $_SESSION[$dataentryName]);
		}

		// overwrite the complete shopData entry with POST data
		// this action may unset technicaldata entries
		$_SESSION[$dataentryName] = $_POST;

		// and append those entries that where lost
		foreach ($shopTechnicalData as $key => $value) {
			if(!array_key_exists($key, $newDataKeys)){
				$_SESSION[$dataentryName][$key] = $value;
			}
		}

     }

	// will create order in database and add orderlines
	function placeOrder(){

		global $db_conn;

		$redirectLocation 		= 'index.php?action=showCheckout'; # default redirect setting
		$dataentryName 			= 'shoppingCartData';
		$errorFound				= FALSE;

		$klantnummer = $_SESSION['userData']['klantnummer'];
		$bestelnummer = null;

		 // create order
        $sql = "INSERT INTO bestelling (klantnummer, besteldatum) VALUES ('$klantnummer', CURRENT_TIMESTAMP)";

		// execute the statement
		$result = mysqli_query($db_conn, $sql);

		 // create order
        $sql  = "SELECT bestelnummer FROM bestelling";

		// execute the statement
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();
		$bestelnummer = $row['bestelnummer'];

		// create orderrows
		$orderLines = $_SESSION[$dataentryName]['orderlines'];

		foreach ($orderLines as $index => $orderline) {

			$artikelnummer 	= $orderline['artikelnummer'];
			$maat			= $orderline['maat'];
			$aantal			= $orderline['aantal'];
			
			$sql  = "INSERT INTO bestelregel (bestelnummer, artikelnummer, maat, aantal)
					 VALUES ('$bestelnummer', '$artikelnummer', '$maat', '$aantal')";

			// execute the statement
			$result = mysqli_query($db_conn, $sql);

			if($result == 0){
				$errorFound = TRUE;
			};
		}

		if ($errorFound){
			add_to_message_stack("Door een technische fout, bestelling niet geplaatst");
		} else {
			add_to_message_stack("Bestelling geplaatst. Uw bestelnummer is: {$bestelnummer}");
			$redirectLocation = "index.php";
		}
		unset($_SESSION[$dataentryName]); # make shoppingcart empty
		
		immediate_redirect_to($redirectLocation); // return to shop

	}


?>
