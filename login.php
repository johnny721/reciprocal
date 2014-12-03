<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	// handle login
	if (isset($_POST['login_submit'])) {
		require_once('./LoginService.php');

		// get POST data
		$username = $_POST['login_username'];
		$password = $_POST['login_password'];

		$myLoginService = new LoginService();
		$loginResult = $myLoginService -> validate($username, $password);
	}

	// handle register
	if (isset($_POST['register_submit'])) {
		//require_once('./RegisterService.php');
	}

	// header & dynamic page title
	ob_start();
	include_once('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	$buffer = str_replace("%TITLE%", "Log In", $buffer);
	echo $buffer;

?>

<div id="login_container">
	<div id="login_space">
	</div><div class="styled_box" id="login_register">
		<h3 class="no_top_margin">First time here?</h3>
		<form action="" method="POST">
			<div class="login_field">
				<input id="register_username" name="register_username" placeholder="choose a username" type="text">
			</div>
			<div class="login_field">
				<input id="register_password" name="register_password" placeholder="password" type="password">
			</div>
			<div class="login_field">
				<input id="register_verify_pw" name="register_verify_pw" placeholder="verify password" type="password">
			</div>
			<div class="login_field">
				<input id="register_email" name="register_email" placeholder="email" type="email">
			</div>
			<input class="btn btn-default" id="register_submit" name="register_submit" type="submit" value="Register">
		</form>
	</div><div id="login_space">
	</div><div class="styled_box" id="login_login">
		<h3 class="no_top_margin">Already a user?</h3>
		<form action="" method="POST">
			<div class="login_field">
				<input id="login_username" name="login_username" placeholder="username" type="text">
			</div>
			<div class="login_field">
				<input id="login_password" name="login_password" placeholder="password" type="password">
			</div>
			<input class="btn btn-default" id="login_submit" name="login_submit" type="submit" value="Log In">
		</form>
		<?php if (isset($_POST['login_submit']) && !$loginResult) {?>
		<div class="alert alert-danger" role="alert">
		  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		  <span class="sr-only">Error:</span>
		  Invalid username or password
		</div>
		<?php } ?>
	</div><div id="login_space">
	</div>
</div>

<?php

	include('./footer.php');

?>