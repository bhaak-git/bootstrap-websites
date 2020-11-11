<?php

	/**
	 * This function adds a new record to the table Winkel	 *
	 */
	function addCustomer() {
		// make database connection available
		global $db_conn;

        // store data that has been entered in session;
        storeCustomerDataInSession();
        // set redirectlocations for succesfull completion
        if(hasRole(array('BACKEND'))){
        	$succesRedirectLocation = "index.php?action=showCustomers";
        } else {
        	$succesRedirectLocation = "index.php?action=showLogin";
        }
        $succesMessage  = "Opgeslagen";
        // set redirectlocation for failure
        $failRedirectLocation   = "index.php?action=showAddCustomer";
        $failureMessage  = "Error, niet opgeslagen";

		// check if required fields have a value;
        if(!requiredFieldsHaveValue()){
            // stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        };

		 // Extract values from POST;
		$naam  = $_POST['naam'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$telefoonnummer = $_POST['telefoonnummer'];
		$adres = $_POST['adres'];
		$plaats = $_POST['plaats'];
		$huisnummer = $_POST['huisnummer'];
		
        // Initialize the SQL statement
        $sql  = "INSERT INTO klanten (naam, email, telefoonnummer, adres, plaats, huisnummer, password)
				 VALUES  ('$naam','$email','$telefoonnummer','$adres','$plaats','$huisnummer','$password')";

		// execute the statement
		$result = mysqli_query($db_conn, $sql);

        // check if the execution of the statement was succesfull
        if ($result == FALSE){
        	// stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        } else {
        	// set successmessage
            add_to_message_stack($succesMessage);
        }

        // clear form data
		clearCustomerDataInSession();
		// stop processing and request redirect
		immediate_redirect_to($succesRedirectLocation);
	}

	/**
	 * This function updates winkel records according to klantnummer
     * as given in $_POST['klantnummer']
	 */
	function updateCustomer() {

		// make database connection available
		global $db_conn;
        // store data that has been entered in session
        storeCustomerDataInSession();

        // set redirectlocations for succesfull completion
        $succesRedirectLocation = "index.php?action=showCustomers";
        $succesMessage  = "Record modified successfully";
        // set redirectlocation for failure
        $failRedirectLocation   = "index.php?action=showEditCustomer&klantnummer=". $_POST['klantnummer'];
        $failureMessage  = "Record not modified.";

        // check if required fields have a value;
        if(!requiredFieldsHaveValue()){
            // stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        };


		 // Extract values from POST;
		$klantnummer 	= $_POST['klantnummer'];
		$naam  			= $_POST['naam'];
		$email 			= $_POST['email'];
		$telefoonnummer = $_POST['telefoonnummer'];
		$adres 			= $_POST['adres'];
		$plaats 		= $_POST['plaats'];
		$huisnummer 	= $_POST['huisnummer'];

		$sql = "UPDATE klanten
				SET klantnummer = '$klantnummer',
					naam = '$naam',
					email = '$email',
					telefoonnummer = '$telefoonnummer',
					adres = '$adres',
					plaats = '$plaats',
					huisnummer = '$huisnummer'
				WHERE klantnummer = $klantnummer;";

		$result = mysqli_query($db_conn, $sql);

		
        // check if the execution of the statement was succesfull
        if ($result == FALSE){
        	// stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        } else {
        	// set successmessage
            add_to_message_stack($succesMessage);
        }

        // clear form data that is left;
        clearCustomerDataInSession();
		immediate_redirect_to($succesRedirectLocation); // return to Editcustomer screen
	}

	/**
	 * This function removes record with klantnummer $_GET['klantnummer'] from the table Customers
	 */
	function deleteCustomer() {
		// make database connection available
		global $db_conn;

        # after completing this action, the following URL is loaded
        $redirectlocation ="index.php?action=showCustomers";

		 // Extract values from get;
		$klantnummer = $_GET['klantnummer'];
		
		$sql = "DELETE FROM klanten WHERE klantnummer = $klantnummer";
		
		$result = mysqli_query($db_conn, $sql);

		if($result == FALSE){
			print "Failed to execute statement\n";
		}

		add_to_message_stack("Record deleted");
		immediate_redirect_to($redirectlocation); // return to customers
	}

    /**
     * checks werther values in the POST super
     * global have a set value. Writes errormessage to messagestack and boolean
     * false if there are problems. Otherwise returns true;
     */
    function requiredFieldsHaveValue(){
        $errorList = array(); // here we define errors that may arrise

        // check and add messages to errorList, see general.lib.php $naam, $email, $telefoonnummer, $adres, $plaats, $huisnummer
        ifEmptyAddMessage($_POST['naam'], $errorList, "Naam is verplicht", TRUE);
        ifEmptyAddMessage($_POST['email'], $errorList, "E-mail is verplicht", TRUE);
        ifEmptyAddMessage($_POST['telefoonnummer'], $errorList, "Telefoonnummer is verplicht", TRUE);
        ifEmptyAddMessage($_POST['adres'], $errorList, "Adres is verplicht", TRUE);
        ifEmptyAddMessage($_POST['plaats'], $errorList, "Plaats is verplicht", TRUE);
        ifEmptyAddMessage($_POST['huisnummer'], $errorList, "Huisnummer is verplicht", TRUE);
        // etc
        return empty($errorList);
    }

    /**
     * (location customers.pcs.php)
     *
     * Stores $_POST data in session. This function
     * should be called by handling functions before
     * any computations on the data is performed.
     *
     * Works in conjunction with returnValueFromSession
     * stored in general.lib.
     */
     function storeCustomerDataInSession(){
         $_SESSION['customerData'] = $_POST;
     }

     function clearCustomerDataInSession(){
         unset($_SESSION['customerData']);
     }

	?>
