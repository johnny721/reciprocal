<?php

	ob_start();
	include('header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Log In", $buffer);
	echo $buffer;

?>

<div id="login_container">
	<div id="login_space">
	</div><div class="styled_box" id="login_login">
		<h3 class="no_top_margin">Already a user?</h3>
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
	</div><div id="login_space">
	</div><div class="styled_box" id="login_register">
		<h3 class="no_top_margin">First time here?</h3>
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
	</div><div id="login_space">
	</div>
</div>

<?php

	include('footer.php');

?>