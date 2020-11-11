<?php
	/**
	 * Generates the HTML required to show the shoppingcart. This page will submit
	 * to shoppingcart.pcs.php. POST data is stored in $_SESSION['shoppingCart']
	 *
	 */
	function displayShoppingCart(){
		echo "Inhoud of the shoppingCart";

		$dataentryName = 'shoppingCartData';

		if(isset($_GET['addarticle'])){
			# add article to shoppingCart. Will result in orderline,
			# an array with artikelnummer, size and amount
			$artikelnummer = $_GET['addarticle'];

			$_SESSION[$dataentryName]['orderlines'][]=array("artikelnummer"=>$artikelnummer, "maat"=>null, "aantal"=>null);
		}?>

		<form method="post" action="index.php?action=processShoppingCart">
			<table class="table table-bordered">
				<tr>
					<th class="col-xs-1">Artikelnummer</th>
					<th class="col-xs-1">Omschrijving</th>
					<th class="col-xs-1">Maat</th>
					<th class="col-xs-1">Aantal</th>
				</tr>

			<?php
			// print contents of shoppingcart
			if(isset($_SESSION[$dataentryName]['orderlines'])){
				foreach ($_SESSION[$dataentryName]['orderlines'] as $key => $orderline) {
					// $key servers as primairy identifier in the orderlines array
					$artikelnummer = $orderline['artikelnummer'];
						?>
					<tr>
						<td><?php echo $artikelnummer;?></td>
						<td><?php echo retrieveDescription($artikelnummer);?></td>
						<td> <input type="text" name="<?php echo "orderlinemaat-{$key}"?>" value="<?php echo returnValueFromSession($dataentryName, "orderlinemaat-{$key}", 'M');?>"/></td>
						<td> <input type="text" name="<?php echo "orderlineaantal-{$key}"?>" value="<?php echo returnValueFromSession($dataentryName, "orderlineaantal-{$key}", 1);?>"/></td>
					</tr>
					<?php
				}
			} else {
				echo "Er zit niets in het winkelwagentje";
			}
?>
			</table>
			<input type="submit" style="float:right;" name="updateCartNextShop" value="Update en doorgaan met winkelen" />
<?php
			// conditionally display checkout button
			if(hasRole(array('CUSTOMER'))){
?>
			<input type="submit" style="float:right;" name="updateCartNextCheckout" value="Update en doorgaan naar afhandeling" />
<?php 		 
			}
?>
		</form>
<?php
	}

	/**
	 * Generates the HTML required to show the checkout. This page will submit
	 * to shoppingcart.pcs.php.
	 *
	 */
	function displayCheckout(){

		$dataentryName = 'shoppingCartData'; # entry in $_SESSION

		echo "<br/>";
		echo "Controleer uw adres. Bel naar +31683326237 als er iets niet klopt.";

		$customerData = retrieveCustomer($_SESSION['userData']['klantnummer']);

		?>
		<!-- Customer information block -->
		<table class="table table">
			<tr> <td>Naam: </td><td> <?php echo $customerData['naam'];?></td></tr>
			<tr> <td>Adres: </td><td> <?php echo $customerData['adres'];?></td></tr>
			<tr> <td>Huisnummer: </td><td> <?php echo $customerData['huisnummer'];?></td></tr>
			<tr> <td>Plaats: </td><td> <?php echo $customerData['plaats'];?></td></tr>
		</table>
		<br/>


		<!-- Report with orderlines -->
		<form method="post" action="index.php?action=placeOrder">
				<table class="table table-bordered">
					<tr>
						<th>Artikelnummer </th>
						<th>Categorie </th>
						<th>Maat </th>
						<th>Aantal </th>
						<th>Prijs</th>
						<th>Totaal</th>
					</tr>
			<?php
				$ordertotal = 0; # initialisation
				
				if(isset($_SESSION[$dataentryName]['orderlines'])){
					foreach ($_SESSION[$dataentryName]['orderlines'] as $key => $orderline) {
					// $key servers as primairy identifier in the orderlines array
					$artikelnummer = $orderline['artikelnummer'];
?>
						<tr>
							<td> <?php echo $artikelnummer;?></td>
							<td> <?php echo retrieveDescription($artikelnummer);?></td>
							<td> <?php echo $orderline['maat'];?></td>
							<td> <?php echo $orderline['aantal'];?></td>
							<td> &#8364;<?php echo retrievePrice($artikelnummer); ?>,-</td>
							<td> &#8364;<?php $subtotal = $orderline['aantal'] * retrievePrice($artikelnummer);
										$ordertotal += $subtotal;
										echo $subtotal;	?>,-</td>
						</tr>
					<?php
					}

				} else {
					echo "Er is niets in het winkelwagentje";
				}	?>
						<!-- Printing Ordertotal line -->
						 <tr>
						 	<td colspan="100%"></td>
						 </tr>
		    			 <tr>
		    			 	<td> &nbsp;</td>
							<td> &nbsp;</td>
							<td> &nbsp;</td>
							<td> &nbsp;</td>
							<td> Totaalprijs bestelling</td>
							<td> &#8364;<?php echo $ordertotal;?>,-</td>
						</tr>

				</table>
				<input style="float:right;" type="submit" name="placeOrder" value="Place Order" />
				</div>
			</form>
		<?php
	}

	/**
	 *  Given an article number, this function retrieves the description for the article
	 */
	 function retrieveDescription($artikelnummer){
	 	global $db_conn;

		 // the query that should be parsed
		$query = "SELECT * FROM artikel WHERE artikelnummer = '$artikelnummer'";
		
		$result = mysqli_query($db_conn, $query);

		if($result == FALSE){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("Query is empty. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is empty: ". $query);

		}

		$row = $result->fetch_assoc();

		return $row['categorie'];
		}

	 /**
	 *  Given an article number, this function retrieves the description for the article
	 */
	 function retrievePrice($artikelnummer){
	 	global $db_conn;

		 // the query that should be parsed
		$query = "SELECT * FROM artikel WHERE artikelnummer = '$artikelnummer'";
		
		$result = mysqli_query($db_conn, $query);

		if($result == FALSE){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("Query is empty. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is leeg: ". $query);

		}

		$row = $result->fetch_assoc();

		return $row['prijs'];
		}

	/**
	 *  Given a wcode, this function retrieves all the customerdata
	 */
	 function retrieveCustomer($klantnummer){
	 	global $db_conn;

		 // the query that should be parsed
		$query = "SELECT * FROM klanten WHERE klantnummer = '$klantnummer'";
		
		$result = mysqli_query($db_conn, $query);

		if($result == FALSE){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("Query is empty. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is empty: ". $query);

		}

		$row = $result->fetch_assoc();

		return $row;
		}

?>
