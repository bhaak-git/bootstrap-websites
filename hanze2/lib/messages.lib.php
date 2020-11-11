<?php
	/*
	 * This library contains functions for message output to 
	 * the default output (browser). A HTML div container 
	 * is generated and populated with a message. Multiple
	 * messages can be added to a message-stack. Every
	 * message has a maximum lifetime and is stored in session. 
	 * 
	 * The message-stack is made up of message-arrays
	 * Each message-array has the following structure:
	 *  	{message, timestamp} 
	 * 
	 */
	 

	define('MAXSECONDSMESSAGE', 5, true); //max time a message is available

	function print_messages(){
		
		update_message_stack();	// removes messages that no longer need to be displayed
		
		$html_output  = "<div id=\"messages\">";
		
		if(isset($_SESSION['message'])){
			
			foreach($_SESSION['message'] as $key=>$message){
				$html_output .= date("H:i:s",$message[1]) . " - " .$message[0];
				$html_output .= '<hr/>';
			}
			
		}
		$html_output .= "</div>";
		
		echo $html_output;
 		
	}
	
	/*
	 * Messages that have overstaid their welcome
	 * must be deleted
	 */
	function update_message_stack(){
		if(isset($_SESSION['message'])){
			foreach($_SESSION['message'] as $key=>$message){
						
					if( $message[1] + MAXSECONDSMESSAGE < time()){
						unset($_SESSION['message'][$key]);
					};
					
				}
		}		
	}
	
	function add_to_message_stack($message, $write_to_log = false){
			
		update_message_stack(); // remove messages that no longer need to be displayed
		
		// $_SESSION['message'] is an array of message-arrays
		// each message-array is made up of a message, followed by a timestamp
		$_SESSION['message'][] = array($message,time()); // add new message to the stack
		
		if($write_to_log){
			// also see lib/general.lib.php
			error_log(date("c",time()) . "\t" . "add_to_message_stack():\t". $message . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");
		}
        					
	}
    
    function log_message($message){
        error_log(date("c",time()) . "\t" . "log_message():\t". $message . "\n", 3, "log/php_".date("d-m-Y", time()) . ".log");
    }
    
    function log_var_dump(&$variable){
        //source: http://justinsilver.com/technology/writing-to-the-php-error_log-with-var_dump-and-print_r/
        ob_start();                             // start buffer capture
        var_dump( $variable );                  // dump the values
        $contents = ob_get_contents();          // put the buffer into a variable
        ob_end_clean();                         // end capture
        log_message( "log_var_dump(): ".$contents );        // log contents of the result of var_dump( $variable )
    }
?>