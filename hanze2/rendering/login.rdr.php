<?php

	/**
     * This function creates HTML to display the login page.
	 *
	 */
	function displayLogin() {
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form class="form-signin" method="post" action="index.php?action=login">
						<h2 class="form-signin-heading">Inloggen</h2>
						<label for="inputEmail" class="sr-only">Login</label>
						<input name="email" type="text" id="inputName" class="form-control" placeholder="E-mail" required="" autofocus="">
						<label for="inputPassword" class="sr-only">Password</label>
						<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required="">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button><br/>
						<a href="index.php?action=showAddCustomer" class="btn btn-lg btn-primary btn-block">Registreren</a>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
?>
