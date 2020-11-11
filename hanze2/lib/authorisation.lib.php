<?php
	function authenticate($email, $password){

		global $db_conn;
		// email and password sent from form
		$email=$_POST['email'];
		$password=$_POST['password'];

		// To protect SQL injection (more detail about SQL injection)
		$email = stripslashes($email);
		$password = stripslashes($password);
		$email = mysqli_real_escape_string($db_conn, $email);
		$password = mysqli_real_escape_string($db_conn, $password);
		$sql = "SELECT * FROM klanten WHERE email='$email' and password='$password'";
		$result = mysqli_query($db_conn, $sql);

		// Mysql_num_row is counting table row
		$num_rows = mysqli_num_rows($result);
					
		// If result matched $email and $password, table row must be 1 row
		if($num_rows==1){

			// Register $email, $password"
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $password;
			$result = 1;
		}
		else {
			echo "Fout Email of Password";
		$result = 0;
		}

		return $result;
	}

	/**
	 * hasRole determines if the user-role exists in the $rolesList
	 *
	 * return boolean FALSE if the user is not authenticated.
	 *
	 * return boolean
	 */
	function hasRole(array $rolesList){
		if (isset($_SESSION['userData'])){
			// notice the use of the === operator in the following line
			// this is required because array_search may return numerical values that evaluate
			// to false. For instance index 0.
			return isAuthenticated() && !(array_search($_SESSION['userData']['role'], $rolesList, TRUE) === FALSE);
		} else {
			return FALSE;
		}
	}

	/**
	 * This function returns boolean TRUE if a user is
	 * authenticated
	 */
	function isAuthenticated(){

		if (isset($_SESSION['userData'])){
			return $_SESSION['userData']['authenticated'];
		} else {
			return FALSE;
		}
	}
	/**
	 * Sets a serverside cookie in which all relevant
	 * userdata is available. In the superglobal $_SESSION
	 * entry 'userData' will be made available. Here email,
	 * role and klantnummer is available via:
	 *
	 * $_SESSION['userData']['email], etc...
	 *
	 * also a fourth property authenticated is available. If this
	 * field contains boolean TRUE the user is authenticated.
	 */
	function setUserData($email, $authenticated = FALSE){
		// make database connection available
		global $db_conn;

		// query statement
		$sql = "SELECT * FROM klanten WHERE email = '$email'";
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		// set session data
		$_SESSION['userData'] = array("email" 			=> $email,
									  "role"			=> $row["role"],
								      "klantnummer"		=> $row["klantnummer"],
								      "authenticated" 	=> $authenticated);

		}

?>
