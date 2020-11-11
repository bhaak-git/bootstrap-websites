<?php

    define('TECHERRORMESSAGE', "A technical problem prohibited succesfull completion of the request. Please contact the administrator.", TRUE);

	/**
	 * Here we setup a custom error-handler. This code originates from php.net
	 * and is modified very little. Depending on the type of error, a custom
	 * message is added to the message stack and displayed accordingly.
	 *
	 * Also a custom error logging file (i.e. to the file system) is defined via
	 * the error_log function
	 */
	function fcErrorHandler($errno, $errstr, $errfile, $errline){

        global $config;

		// log the error to the filesystem.
		error_log(date("c",time()) . "\t" . $errstr . "\n", 3, "{$config['loglocation']}/php_".date("d-m-Y", time()) . ".log");

		// initialize HTML output
		$html_output = "";

	    if (!(error_reporting() & $errno)) {
	        // This error code is not included in error_reporting
	        return;
	    }

	    switch ($errno) {
	    case E_USER_ERROR:
	        $html_output .= "ERROR [$errno] $errstr";
	        $html_output .= "  Fatal error on line $errline in file $errfile";
	        $html_output .=  ", PHP " . PHP_VERSION . " (" . PHP_OS . ")";
	        $html_output .= "Aborting...";
	        add_to_message_stack($html_output);

			// write the custom error to filesystem.
			error_log(date("c",time()) . "\t" . "{$errno}\t". $html_output . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");

            // quit processing on ERRORS
			exit(1);
	        break;

	    case E_USER_WARNING:
	        $html_output .= "WARNING [$errno] $errstr";
	        add_to_message_stack($html_output);
			error_log(date("c",time()) . "\t" . "{$errno}\t". $html_output . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");
	        break;

	    case E_USER_NOTICE:
	        $html_output .= "NOTICE [$errno] $errstr";
	        add_to_message_stack($html_output);
			error_log(date("c",time()) . "\t" . "{$errno}\t". $html_output . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");
	        break;

	    default:
	        $html_output .= "Unknown error type: [$errno] $errstr";
			add_to_message_stack($html_output);
			error_log(date("c",time()) . "\t" . "{$errno}\t". $html_output . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");
	        break;
	    }

	    /* Don't execute PHP internal error handler */
	    return true;
	}

	/**
	 * This function generates the standard HTML header
	 */
   function displayHeader() {
      global $config;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Main core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="css/subalpine.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

    <meta name="description" content="Downhat Gym Shop">
    <meta name="author" content="FL Devteam">
		<title><?php echo $config['pagetitle'];?></title>

    <script type="text/javascript" src="js/general.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/main.min.js"></script>

	</head>
  <body>
<?php
  }


	/**
	 * This function generates the standard HTML footer
	 */
	function displayFooter() {

		global $config;

        // add a <div> region with messages to the page.
        print_messages(); // see lib/messages.lib.php

	?>
      </div>
        <footer class="footer">
          <div class="container">
            <p class="text-muted">&copy; 2015 FL Devteam. All rights reserved.</p>
          </div>
        </footer>
			</body>
		</html>
	<?php
	}

	/**
	 * This function displays the HTML navigation bar
	 */
	function displayNavigation() {
?>

<nav class="navbar navbar-inverse navbar-static-top unconstrained">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://downhatgym.nl/">Downhat Gym</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php?action=home">Start</a></li>
        <?php if(hasRole(array('BACKEND'))){ ?>
          <li><a href="index.php?action=showCustomers">Klanten</a></li>
          <li><a href="index.php?action=showArticles">Artikelen</a></li>
  			<?php } ?>

        <?php if(hasRole(array('BACKEND', 'CUSTOMER'))){ ?>
  				<li><a href="index.php?action=showShop">Winkel</a></li>
  			<?php } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
  			<?php if(!isAuthenticated()){ ?>
  				<li><a href="index.php?action=showLogin">Login</a></li>
  			<?php } else { ?>

  			    <li><a href="index.php?action=logout">Uitloggen</a></li>
  			    <li><a href="index.php?action=showShoppingCart">Winkelwagen</a></li>
  			<?php } ?>

      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<div class="container-fluid unconstrained">
  <div class="banner"></div>
</div>
<div class="container">


<?php
	}

	/**
	 * This functions renders the homepage
	 */
	function displayHome() {

    	global $db_conn; #references connection to the database

    	$featureditemsmax = 12;
    	// the query
    	$sql  = "SELECT * FROM artikel";

		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		if($result == 0){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("displayHome() - Query is empty. This message is logged", true);
        	// and a message to the system log. Note we do not give information
        	// about SQL to the user.
        	log_message("Query is empty: ". $sql);
		} else {
?>
          <div class="col-md-12">
            <div class="row">
<?php         do {

?>				<div class="col-sm-6 col-lg-4 col-md-6">
                    <div class="thumbnail">
                      <img src="data/images/<?php echo $row['artikelnummer']; ?>.jpg">
                      <div class="caption">
                        <h4 class="pull-right">&#8364;<?php echo $row['prijs']; ?>,-</h4>
                        <h4><a href="index.php?action=<?php if(hasRole(array('BACKEND', 'CUSTOMER'))){ echo "showShop";} else { echo "showLogin"; }?>"><?php echo $row['productnaam']; ?></a>
                        </h4>
                        <p><?php echo $row['omschrijving']; ?></p>
                      </div>
                    </div>
                </div>
<?php         } while ($row = $result->fetch_assoc());

        }
?>
            </div>
          </div>
<?php
   global $db_conn;

       echo "<br/>";

     if($db_conn->connect_error){
         $message = "There is a problem with the current databaseconnection";
         echo $message;
           log_message($message);

     }

  }


	/**
	 * This function is determines the current action
	 * if no action is given in the url, the standard action will be taken from the config
	 *
	 */
	function getCurrentAction() {
		global $config; // in conf/config.conf.php

		if(isset($_GET['action'])) {
			return $_GET['action'];
		}
		else {
			return $config['defaultaction'];
		}
	}


	/**
	 * This function redirects to the given location.
	 * Be sure to call the function before any output
	 * to HTML is generated.
	 *
	 */
	function immediate_redirect_to($redirectlocation){
		header("location: {$redirectlocation}");
		exit;

	}

    /**
     * check for given variable if value is empty
     * and appends message to the array if this is the case
     *
     */
     function ifEmptyAddMessage(&$variable, &$errorList, $message, $addToStack){
         if(empty($variable)){
             $errorList[] = $message;

             if($addToStack){
                 add_to_message_stack($message,FALSE);
             }
         }
     }

     /**
      * (location general.lib.php)
      *
      * Returns a defaultvalue, if no value is found in dataEntry point of
      * the $_SESSION variable.
      *
      * When forms are submitted the handling actions save formdate, i.e.
      * the contents of the POST variable are stored as an assosiative array in the
      * $_SESSION variable. The key used should match $dataEntry.
      *
      * $name corresponds to the value of the key in the POST message. In general
      * this is equal to the name attribute of the input field.
	  *
	  * update DIRN: modified eval. statement in if to empty($_SESSION[$dataEntry][$name]
      */
      function returnValueFromSession($dataEntry, $name, $defaultValue){

          if(!empty($_SESSION[$dataEntry][$name])){
            $sessionData = $_SESSION[$dataEntry][$name];
          }

          if(empty($sessionData)){
              //log_message("sessionData empty, returning default value");
              return $defaultValue;
          } else {
              //log_message("sessionData not empy, returning sessiondata");
              return $sessionData;
          }
      }

?>
