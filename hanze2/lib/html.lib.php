 <?php
    /*
	 * static_selectlist 	generates HTML for a selectlist given a 
	 * 					    associatice array of the form {display, return}.
	 * 	  
	 * return			HTML select-list
	 * 
	 * input			$data: assoc. array {{display, return}, ..}
	 * 					$name:	name-attribute of the <select> element
	 * 					$selected: default selected value in <select> element
	 * 			
	 *  Wrtitten on 20-08-2015
	 */
function static_selectlist($data, $name, $preselected = null){
		
		
		$html_output = "";
		$html_output .= "<select name=\"{$name}\" >\n";
		$html_output .= "\t";
		
		if(!$preselected){
			$html_output .= "<option value=\"\" >";
			$html_output .= "-please select a value-";	
			$html_output .= "</option>\n";
		};
		
			foreach ($data as $displayValue => $returnValue) {
				
				$html_output .= "\t"; // make indent
				
				if ($returnValue == $preselected) {
						$html_output .= "<option value=\"". $returnValue ."\" selected>";
				} else {
						$html_output .= "<option value=\"". $returnValue ."\" >";
				}
			
				$html_output .= $displayValue;	
				$html_output .= "</option>\n";
				
			}
			
		$html_output .= "</select>\n";
		
			return $html_output;
		}
?>