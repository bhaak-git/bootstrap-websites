<?php

	/**
     *
	 * This function makes a report of all the records in the
     * Shops table. It outputs HTML and can sort records in the
     * table based on a predefined field and sortation order.
	 */
	function displayAllCustomers() {
	    global $db_conn; #references connection to the database
	    
		$sql = "SELECT * FROM klanten ORDER BY klantnummer";
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		if($result == 0){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("Query is empty. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is empty: ". $sql);

		} else {
?>
			<h1>Klanten</h1>
			<br/>
			<input type="button" onclick="document.location.href='?action=showAddCustomer'" value="Klant toevoegen" />
			<br/>
			<table class="table table-bordered">
				<tr>
					<th class="col-xs-1">Klantnummer</th>
					<th class="col-xs-1">Naam</th>
					<th class="col-xs-2">E-mail</th>
					<th class="col-xs-1">Telefoonnummer</th>
					<th class="col-xs-1">Adres</th>
					<th class="col-xs-1">Plaats</th>
					<th class="col-xs-1">Huisnummer</th>
					<th class="col-xs-2">Action</th>
				</tr>

<?php			do {
?>
				<tr>
					<td class="col-xs-2"><?php echo $row['klantnummer'];?></td>
					<td class="col-xs-2"><?php echo $row['naam'];?></td>
					<td class="col-xs-3"><?php echo $row['email'];?></td>
					<td class="col-xs-2"><?php echo $row['telefoonnummer'];?></td>
					<td class="col-xs-2"><?php echo $row['adres'];?></td>
					<td class="col-xs-2"><?php echo $row['plaats'];?></td>
					<td class="col-xs-2"><?php echo $row['huisnummer'];?></td>
					<td class="col-xs-3"><a href="index.php?action=showEditCustomer&amp;klantnummer=<?php echo $row['klantnummer'];?>">Edit</a>|<a class="delete" href="javascript:confirmAction('Are you sure?', 'index.php?action=deleteCustomer&amp;klantnummer=<?php echo $row['klantnummer'];?>');">Remove</a></td>
				</tr>
<?php			} while ($row = $result->fetch_assoc()); ?>
				</table>
				</div>
			</form>
		</div>
<?php		}
	}


	/**
	 * This functions shows the add Customer form	 *
	 */
	function displayAddCustomer() {
		?>
		<h1>Klant toevoegen</h1>
		<form method="post" action="index.php?action=insertCustomer">
			<table>
				<tr>
					<td>Naam:</td>
					<td><input type="text" name="naam" value="<?php echo returnValueFromSession('customerData', 'naam', null);?>"/></td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td><input type="text" name="email" value="<?php echo returnValueFromSession('customerData', 'email', null);?>"/></td>
				</tr>
				<tr>
					<td>Wachtwoord:</td>
					<td><input type="password" name="password" value="<?php echo returnValueFromSession('customerData', 'password', null);?>"/></td>
				</tr>
				<tr>
                    <td>Telefoonnummer:</td>
                    <td><input type="text" name="telefoonnummer" value="<?php echo returnValueFromSession('customerData', 'telefoonnummer', null);?>"/></td>
                </tr>
                <tr>
                    <td>Adres:</td>
                    <td><input type="text" name="adres" value="<?php echo returnValueFromSession('customerData', 'adres', null);?>"/></td>
                </tr>
				<tr>
                <tr>
                    <td>Plaats:</td>
                    <td><input type="text" name="plaats" value="<?php echo returnValueFromSession('customerData', 'plaats', null);?>"/></td>
                </tr>
                <tr>
                    <td>Huisnummer:</td>
                    <td><input type="text" name="huisnummer" value="<?php echo returnValueFromSession('customerData', 'huisnummer', null);?>"/></td>
                </tr>
					<td></td>
					<td><input type="submit" value="Save" /></td>
				</tr>
			</table>
		<?php
	}

	/**
	 * This functions shows the edit Jobs form
	 * This form is automatically filled with data given by ID
	 */

	function displayEditCustomer() {
		global  $db_conn;;

		$klantnummer = $_GET['klantnummer'];

		$sql = "SELECT * FROM klanten WHERE klantnummer = $klantnummer";
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		if($result == 0){
			print "Query is empty\n";
		} else {

?>
			<h1>Klant aanpassen</h1>
			<form method="post" action="index.php?action=updateCustomer">
				<table>
                	<tr>
						<td>Naam:</td>
						<td><input type="text" name="naam" value="<?php echo $row['naam'];?>"/></td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td><input type="text" name="email" value="<?php echo $row['email'];?>"/></td>
					</tr>
					<tr>
	                    <td>Telefoonnummer:</td>
	                    <td><input type="text" name="telefoonnummer" value="<?php echo $row['telefoonnummer'];?>"/></td>
	                </tr>
	                <tr>
	                    <td>Adres:</td>
	                    <td><input type="text" name="adres" value="<?php echo $row['adres'];?>"/></td>
	                </tr>
					<tr>
	                <tr>
	                    <td>Plaats:</td>
	                    <td><input type="text" name="plaats" value="<?php echo $row['plaats'];?>"/></td>
	                </tr>
	                <tr>
	                    <td>Huisnummer:</td>
	                    <td><input type="text" name="huisnummer" value="<?php echo $row['huisnummer'];?>"/></td>
	                </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Save" /></td>
                    </tr>
                    <input type="hidden" name="klantnummer" value="<?php echo $row['klantnummer'];?>" />
            	</table>
			</form>
			<?php
	}
}
?>
