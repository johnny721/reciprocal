<?php

	if (session_id() == '') {
		session_start();
	}

	// handle login
	if (isset($_POST['login_submit'])) {
		require_once('./AccountService.php');

		// get POST data
		$username = strtolower($_POST['login_username']);
		$password = $_POST['login_password'];

		$myAccountService = new AccountService();
		$loginResult = $myAccountService -> validateLogin($username, $password);
	}

	// handle register
	if (isset($_POST['register_submit'])) {
		require_once('./AccountService.php');

		// get POST data
		$username = strtolower($_POST['register_username']);
		$password = $_POST['register_password'];
		$verify = $_POST['register_verify'];
		$email = strtolower($_POST['register_email']);

		$myAccountService = new AccountService();
		$registerResult = $myAccountService -> validateRegister($username, $password, $verify, $email);
	}

	// header & dynamic page title
	ob_start();
	include_once('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	$buffer = str_replace("%TITLE%", "Log In", $buffer);
	echo $buffer;

	if (!(isset($_SESSION['username']))) {

?>

<div id="login_container">
	<div id="login_space">
	</div><div id="login_register">
		<div class="styled_box">
			<h3 class="no_top_margin">First time here?</h3>
			<form action="" method="POST">
				<div class="login_field">
					<input id="register_username" name="register_username" placeholder="choose a username" type="text">
				</div>
				<div class="login_field">
					<input id="register_password" name="register_password" placeholder="password" type="password">
				</div>
				<div class="login_field">
					<input id="register_verify" name="register_verify" placeholder="verify password" type="password">
				</div>
				<div class="login_field">
					<input id="register_email" name="register_email" placeholder="email" type="email">
				</div>
				<input class="btn btn-default" id="register_submit" name="register_submit" type="submit" value="Register">
			</form>
		</div>
		<?php if (isset($_POST['register_submit']) && $registerResult != 0) {?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<?php if ($registerResult == 1) { ?>
			Could not register account
			<?php } else if ($registerResult == 2) { ?>
			Not all fields are filled
			<?php } else if ($registerResult == 3) { ?>
			Passwords do not match
			<?php } ?>
		</div>
		<?php } ?>
	</div><div id="login_space">
	</div><div id="login_login">
		<div class="styled_box">
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
		</div>
		<?php if (isset($_POST['login_submit']) && $loginResult != 0) {?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			<?php if ($loginResult == 1) { ?>
			Invalid username or password
			<?php } else if ($loginResult == 2) { ?>
			Not all fields are filled
			<?php } ?>
		</div>
		<?php } ?>
	</div><div id="login_space">
	</div>
</div>

<?php

	} else {

?>

<div class="alert alert-success" role="alert">
	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	<span class="sr-only">Success:</span>
	You are now logged in. Redirecting you to the home page...
</div>

<?php

		header( "refresh:2; url=./" ); 

	}

	include('./footer.php');

?>