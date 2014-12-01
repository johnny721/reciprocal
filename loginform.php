<?php

	ob_start();
	include('header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Log In", $buffer);
	echo $buffer;

?>

	<div id="login">
		<h2>Login</h2>
		<form action="" method="POST">
			<div class="field">
				<label>Username</label>
				<input id="login_username" name="login_username" type="text">
			</div>
			<div class="field">
				<label>Password</label>
				<input id="login_password" name="login_password" type="password">
			</div>
			<input class="btn btn-default" id="login_submit" name="login_submit" type="submit" value="Log In">
		</form>
	</div>
	<div id="register">
		<h2>Register</h2>
		<form action="" method="POST">
			<div class="field">
				<label>Username</label>
				<input id="register_username" name="register_username" type="text">
			</div>
			<div class="field">
				<label>Password</label>
				<input id="register_password" name="register_password" type="password">
			</div>
			<div class="field">
				<label>Email</label>
				<input id="register_email" name="register_email" type="email">
			</div>
			<input class="btn btn-default" id="login_submit" name="register_submit" type="submit" value="Register">
		</form>
	</div>

<?php

	include('footer.php');

?>