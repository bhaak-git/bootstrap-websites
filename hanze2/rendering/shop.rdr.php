<?php
	/**
	 * Generates the HTML required to show the shop. This page will submit
	 * to shop.pcs.php. POST data is stored in $_SESSION['shopData']
	 *
	 */
	function displayShop(){
		global $db_conn; #references connection to the database

    	// the query
    	$sql  = "SELECT * FROM artikel";

		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		if($result == 0){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("displayShop() - Query is empty. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is empty: ". $sql);
		} else {
?>			<table class="table table-bordered">
				<tr>
					<th class="col-xs-1">Artikelnummer</th>
					<th class="col-xs-1">Productnaam</th>
					<th class="col-xs-1">Categorie</th>
					<th class="col-xs-6">Omschrijving</th>
					<th class="col-xs-1">Prijs</th>
					<th class="col-xs-2">Action</th>
				</tr>
<?php			do {
?>				<tr>
					<td class="col-xs-1"><?php echo $row['artikelnummer'];?></td>
					<td class="col-xs-1"><?php echo $row['productnaam'];?></td>
					<td class="col-xs-1"><?php echo $row['categorie'];?></td>
					<td class="col-xs-6"><?php echo $row['omschrijving'];?></td>
					<td class="col-xs-1">&#8364;<?php echo $row['prijs'];?></td>
					<td class="col-xs-2"> <a href="index.php?action=showShoppingCart&addarticle=<?php echo $row['artikelnummer'];?>">Add to Shopping Cart</a> </td>
				</tr>
<?php			} while ($row = $result->fetch_assoc());
				echo "</table>";
			}
		}
?>
