<?php
 function login(){
 	// setup
 	$succesRedirectLocation 		= "index.php";
	$failRedirectLocation 			= "index.php?action=showLogin";
	$succesMessage 			     	= "Login was succesfull";
	$failureMessage 		     	= "Login failed";

	$email 	= $_POST['email']; //
	$password	  = $_POST['password'];

	$authenticationResult = authenticate($email, $password);

	if ($authenticationResult != 0) {
	//	if (TRUE) { # for development purposes only
		 setUserData($email, TRUE);
		 add_to_message_stack($succesMessage);
		 immediate_redirect_to($succesRedirectLocation);
     exit();
	} else {
		add_to_message_stack($failureMessage);
        immediate_redirect_to($failRedirectLocation); /* Redirect browser */
        exit();
	};

 }

 function logout(){
 	 	// set redirectlocations for succesfull completion
        $succesRedirectLocation = "index.php";

        // remove all session variables
		session_unset();

		// destroy the session
		session_destroy();
		// stop processing and request redirect
		immediate_redirect_to($succesRedirectLocation);
 }
?>
