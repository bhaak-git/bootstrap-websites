<?php

	/**
     *
	 * This function makes a report of all the records in the
     * artikel table. It outputs HTML and can sort records in the
     * table based on a predefined field and sortation order.
	 */
	function displayAllArticles() {
		global $db_conn; #references connection to the database
		
		$sql = "SELECT * FROM artikel ORDER BY artikelnummer";
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();

		if($result == 0){
		    // if things go wrong we sent a message to the screen
		    add_to_message_stack("Query could not be Executedparsed. This message is logged", true);
            // and a message to the system log. Note we do not give information
            // about SQL to the user.
            log_message("Query is empty: ". $sql);

		} else {
?>
			<h1>Artikelen</h1>
			<br/>
			<input type="button" onclick="document.location.href='?action=showAddArticle'" value="Artikel toevoegen" />
			<br/>
			<table class="table table-bordered">
				<tr>
					<th class="col-xs-1">Artikelnummer</th>
					<th class="col-xs-2">Productnaam</th>
					<th class="col-xs-2">Categorie</th>
					<th class="col-xs-1">Prijs</th>
					<th class="col-xs-1">Voorraad</th>
					<th class="col-xs-5">Omschrijving</th>
					<th class="col-xs-2">Action</th>
				</tr>

<?php			do {
?>
				<tr>
					<td class="col-xs-1"><?php echo $row['artikelnummer'];?></td>
					<td class="col-xs-2"><?php echo $row['productnaam'];?></td>
					<td class="col-xs-2"><?php echo $row['categorie'];?></td>
					<td class="col-xs-1">&#8364;<?php echo $row['prijs']; ?>,-</td>
					<td class="col-xs-1"><?php echo $row['voorraad'];?></td>
					<td class="col-xs-5"><?php echo $row['omschrijving'];?></td>
					<td class="col-xs-2"><a href="index.php?action=showEditArticle&amp;artikelnummer=<?php echo $row['artikelnummer'];?>">Edit</a>|<a class="delete" href="javascript:confirmAction('Are you sure?', 'index.php?action=deleteArticle&amp;artikelnummer=<?php echo $row['artikelnummer'];?>');">Remove</a></td>
				</tr>
<?php			} while ($row = $result->fetch_assoc()); ?>
				</table>
				</div>
			</form>
		</div>
<?php		}
	}

	/**
	 * This functions shows the add Article form	 *
	 */
	function displayAddArticle() {
		?>
		<h1>Artikel toevoegen</h1>
		<form method="post" action="index.php?action=insertArticle">
			<table>
				<tr>
					<td>Artikelnummer:</td>
					<td><input type="text" name="artikelnummer" value="<?php echo returnValueFromSession('articleData', 'artikelnummer', null);?>"/></td>
				</tr>
				<tr>
					<td>Productnaam:</td>
					<td><input type="text" name="productnaam" value="<?php echo returnValueFromSession('articleData', 'productnaam', null);?>"/></td>
				</tr>
				<tr>
					<td>Categorie:</td>
					<td><input type="text" name="categorie" value="<?php echo returnValueFromSession('articleData', 'categorie', null);?>"/></td>
				</tr>
				<tr>
                    <td>Prijs:</td>
                    <td><input type="text" name="prijs" value="<?php echo returnValueFromSession('articleData', 'prijs', null);?>"/></td>
                </tr>
				<tr>
					<td>Voorraad:</td>
					<td><input type="text" name="voorraad" value="<?php echo returnValueFromSession('articleData', 'voorraad', null);?>"/></td>
				</tr>
				<tr>
                    <td>Omschrijving:</td>
                    <td><input type="text" name="omschrijving" value="<?php echo returnValueFromSession('articleData', 'omschrijving', null);?>"/></td>
                </tr>
                <tr>
					<td></td>
					<td><input type="submit" value="Save" /></td>
				</tr>
			</table>
		</form>
		<?php
	}

	/**
	 * This functions shows the edit Article form
	 * This form is automatically filled with data given by ID
	 */

	function displayEditArticle() {

        global $db_conn;

		$artikelnummer = $_GET['artikelnummer'];

        $sql = "SELECT * FROM artikel WHERE artikelnummer = '$artikelnummer'";
		$result = mysqli_query($db_conn, $sql);
		$row = $result->fetch_assoc();
?>
		<h1>Artikel aanpassen</h1>
		<form method="post" action="index.php?action=updateArticle">
			<table>
                    <tr>
                       <td>Productnaam:</td>
                       <td><input type="text" name="productnaam" value="<?php echo $row['productnaam'];?>"/></td>
                   </tr>
                   <tr>
                       <td>Categorie:</td>
                       <td><input type="text" name="categorie" value="<?php echo $row['categorie'];?>"/></td>
                   </tr>
                   <tr>
                       <td>Prijs:</td>
                       <td><input type="text" name="prijs" value="<?php echo $row['prijs'];?>"/></td>
                   </tr>
                   <tr>
                       <td>Voorraad:</td>
                       <td><input type="text" name="voorraad" value="<?php echo $row['voorraad'];?>"/></td>
                   </tr>
                   <tr>
                       <td>Omschrijving:</td>
                       <td><input type="text" name="omschrijving" value="<?php echo $row['omschrijving'];?>"/></td>
                   </tr>
                   <tr>
                       <td></td>
                       <td><input type="submit" value="Save" /></td>
                   </tr>
                   <input type="hidden" name="artikelnummer" value="<?php echo $row['artikelnummer'];?>" />
               </table>
		</form>
<?php
	}
?>
