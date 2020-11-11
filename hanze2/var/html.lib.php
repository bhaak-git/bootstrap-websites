<?php

	/*
	 * rowdata 	neemt een lijst ($input) elementen
	 * 			en plaats ieder element binnen 
	 * 			$defaulttag tags.
	 * 		
	 * return 	een string omsloten
	 * 			door <tr>-tags, waarbinnen de elementen
	 * 			zijn omsloten door $defaulttags
	 * 
	 * input	$input: string of associative array
	 * 			$defaulttag: (optioneel) dit is de tag
	 * 				om de elementen van $input
	 * 
	 *  Geschreven door DIRN op 08-10-2014
	 */
	function rowdata($input, $defaulttag = "<td>"){

		$html_output = "<tr>\n";
		
		if(is_array($input)){
			foreach ($input as $key => $value) {
				$html_output .= $defaulttag . $value . str_replace('<', '</',$defaulttag) . "\n";
			}
					
		} else {
			$html_output = $input;
		}
		
		$html_output .= "</tr>\n";
			
		return $html_output;
	}
	
	
	/*
	 * fetch_headers 	neemt een arrayobject (het resultaat) van
	 * 					mysqli_query() en haalt hieruit de namen
	 * 					van de kolommen in de query.
	 * 
	 * return			associatieve array met kolomnaam => kolomnaam
	 * 
	 * input			resultaat van mysqli_query()
	 * 			
	 *  Geschreven door DIRN op 08-10-2014
	 */
	function fetch_headers($arrayobject){
		
		$result = array();
		foreach (mysqli_fetch_fields($arrayobject) as $key => $object) {
			
			$result[$object->name]= $object->name;
			
		}
		
		return $result;
	}
	
	
	/*
	 * make_selectlist 	genereert een HTML select-list op basis van een ingegeven query.
	 * 					De query dient van de vorm {display, return} te zijn.
	 * 	 * 
	 * return			HTML van de select-lijst
	 * 
	 * input			$connection: geopende mysql connectie
	 * 					$query: string met SQL query
	 * 					$name:	name-attribute van het <select> element
	 * 					$selected: default selected value in <select> element
	 * 			
	 *  Geschreven door DIRN op 08-10-2014
	 */
	function make_selectlist($query, $name, $preselected = null){
		global $db_conn;
		
		$connection = $db_conn;
		
		#  set defult selected value
		if (isset($_POST[$name])){
				$selected = $_POST[$name]; 
			} 
					
		$result = mysqli_query($connection, $query);
		
		if(!$result){
			$error_message  = "Database error in function make_selectlist";
			$error_message .= mysqli_error(); 
			add_to_message_stack($error_message);
		} 
		
		$headers = fetch_headers($result); // assume $display, $return type
		$headers = array_keys($headers);
		
		$html_output = "";
		$html_output .= "<select name=\"{$name}\" >\n";
		$html_output .= "\t";
		
		if(!$preselected){
			$html_output .= "<option value=\"\" >";
			$html_output .= "-please select a value-";	
			$html_output .= "</option>\n";
		};
		
			while($row = mysqli_fetch_assoc($result)){
				
				$html_output .= "\t"; // make indent
				
				if ($row[$headers[1]]==$preselected) {
						$html_output .= "<option value=\"". $row[$headers[1]] ."\" selected>";
				} else {
						$html_output .= "<option value=\"". $row[$headers[1]] ."\" >";
				}
			
				$html_output .= $row[$headers[0]];	
				$html_output .= "</option>\n";
				
			}
			
		$html_output .= "</select>\n";
		
		mysqli_free_result($result);
		
		return $html_output;
		}
		
	/*
	 * make_table 		genereert een HTML-table op basis van een ingegeven query.
	 * 						
	 * return			HTML van het gevraagde overzicht
	 * 
	 * input			$connection: geopende mysql connectie
	 * 					$query: string met SQL query
	 * 					
	 * 			
	 *  Geschreven door DIRN op 08-10-2014
	 */	
	function make_table ($connection, $query){
		
		$html_output = "";
		$html_output .= "<table border=\"1\">";
			
		$result = mysqli_query($connection, $query);
		$headers = fetch_headers($result);
					
		$html_output .= rowdata($headers, '<th>');						
				
		while ($row =  mysqli_fetch_assoc($result)){
			$html_output .= rowdata($row);
		};
					
		mysqli_free_result($result);
					
		$html_output .= "</table>";
				
		return $html_output;
	}
?>

