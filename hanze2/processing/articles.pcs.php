<?php

	/**
	 * This function adds a new record to the table Article	 *
	 */
	function addArticle() {
		// make database connection available
		global $db_conn;
		
        // store data that has been entered in session;
        storeArticleDataInSession();
        // set redirectlocations for succesfull completion
        $succesRedirectLocation = "index.php?action=showArticles";
        $succesMessage  = "Opgeslagen";
        // set redirectlocation for failure
        $failRedirectLocation   = "index.php?action=showAddArticle";
        $failureMessage  = "Error, niet opgeslagen";
		
		// check if required fields have a value;
        if(!requiredArticleFieldsHaveValue()){
            // stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        };

		// retrieve data from post and store in variable
		$artikelnummer	= $_POST['artikelnummer'];
		$productnaam	= $_POST['productnaam'];
		$categorie 		= $_POST['categorie'];
		$prijs 			= $_POST['prijs'];
		$voorraad		= $_POST['voorraad'];
		$omschrijving	= $_POST['omschrijving'];

        // Initialize the SQL statement
        $sql  = "INSERT INTO artikel (artikelnummer, productnaam, categorie, prijs, voorraad, omschrijving)
				 VALUES  ('$artikelnummer','$productnaam','$categorie','$prijs','$voorraad','$omschrijving')";

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
	 * This function updates article records according to wcode
     * as given in $_POST['artikelnr']
	 */
	function updateArticle() {

		global $db_conn;
        // store data that has been entered in session
        storeArticleDataInSession();

        // set redirectlocations for succesfull completion
        $succesRedirectLocation = "index.php?action=showArticles";
        $succesMessage  = "Record modified successfully";
        // set redirectlocation for failure
        $failRedirectLocation   = "index.php?action=showEditArticle&artikelnummer=". $_POST['artikelnummer'];
        $failureMessage  = "Record not modified.";

        // check if required fields have a value;
        if(!requiredArticleFieldsHaveValue()){
            // stop processing and issue a redirect
            add_to_message_stack($failureMessage);
            immediate_redirect_to($failRedirectLocation);
        };

		// retrieve data from post and store in variable
		$artikelnummer	= $_POST['artikelnummer'];
		$productnaam	= $_POST['productnaam'];
		$categorie 		= $_POST['categorie'];
		$prijs 			= $_POST['prijs'];
		$voorraad		= $_POST['voorraad'];
		$omschrijving	= $_POST['omschrijving'];
		
		$sql = "UPDATE artikel
				SET artikelnummer = '$artikelnummer',
					productnaam = '$productnaam',
					categorie = '$categorie',
					prijs = '$prijs',
					voorraad = '$voorraad',
					omschrijving = '$omschrijving'
				WHERE artikelnummer = $artikelnummer;";

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
	 * This function removes record with artikelnr $_GET['artikelnr'] from the table Artikelen
	 */
	function deleteArticle() {
	    // make database connection available
		global $db_conn;

        # after completing this action, the following URL is loaded
        $redirectlocation ="index.php?action=showArticles";

		 // Extract values from get;
		$artikelnummer = $_GET['artikelnummer'];
		
		$sql = "DELETE FROM artikel WHERE artikelnummer = $artikelnummer";
		
		$result = mysqli_query($db_conn, $sql);

		if($result == FALSE){
			print "Failed to execute statement\n";
		}
		add_to_message_stack("Record deleted");
		immediate_redirect_to($redirectlocation); // return to articles
	}

    /**
     * checks werther values in the POST super
     * global have a set value. Writes errormessage to messagestack and boolean
     * false if there are problems. Otherwise returns true;
     */
    function requiredArticleFieldsHaveValue(){
        $errorList = array(); // here we define errors that may arrise

        // check and add messages to errorList, see general.lib.php
        ifEmptyAddMessage($_POST['artikelnummer'], $errorList, "Article Number is verplicht", TRUE);
        ifEmptyAddMessage($_POST['productnaam'], $errorList, "Productnaam is verplicht", TRUE);
        ifEmptyAddMessage($_POST['categorie'], $errorList, "Categorie is verplicht", TRUE);
        ifEmptyAddMessage($_POST['prijs'], $errorList, "Prijs is verplicht", TRUE);
        ifEmptyAddMessage($_POST['voorraad'], $errorList, "Voorraad is verplicht", TRUE);
        ifEmptyAddMessage($_POST['omschrijving'], $errorList, "Omschrijving is verplicht", TRUE);

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
     function storeArticleDataInSession(){
         $_SESSION['articleData'] = $_POST;
     }

     function clearArticleDataInSession(){
         unset($_SESSION['articleData']);
     }

	?>
