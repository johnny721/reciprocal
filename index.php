<?php

	ob_start();
	include('header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Home", $buffer);
	echo $buffer;

?>

	<div>
		<a class="btn btn-default" href="./login.php">Log In or Register</a>
	</div>
	<div id="search">
		<form action="" method="POST">
			<input id="search_term" name="search_term" type="text">
			<input class="btn btn-default" id="search_submit" name="search_submit" type="submit" value="Search">
		</form>
	</div>
	<div id="browse">
		<a class="btn btn-default" href="./browse.php">Browse Recipes</a>
	</div>
	<div id="submit">
		<a class="btn btn-default" href="./submit-recipe.php">Submit a Recipe</a>
	</div>

<?php

	include('footer.php');

?>