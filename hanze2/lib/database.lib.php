<?php

    /**
     * This file contains all functions necessary to connect to
     * and disconnect from a database
	 */

	/**
	 * This function connects to the MySQL server
	 * and uses the global array $config. The
     * function also selects the right database-schema
	 *
	 */
	function databaseConnect() {
       global $config;

       # report exceptions, but don't throw them, and we are not interested in
       # wether we use indexes.
       mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT ^ MYSQLI_REPORT_INDEX);

       $db_conn = mysqli_connect($config['mysql']['hostname'],
         						 $config['mysql']['username'],
         						 $config['mysql']['password'],
          						 $config['mysql']['database']);

        // check connection
       if (mysqli_connect_errno()) {
	       	$errormessage = "Connect failed ". mysqli_connect_error();
	       	add_to_message_stack($errormessage, true);
	        exit();
       }
        	return $db_conn;
		}

	/**
	 * This functions closes the connection to the database
	 *
	 */
	function databaseDisconnect($db_conn) {
        mysqli_close($db_conn);
    }

?>
