<?php

	// start session if not started
	if (session_id() == '') {
		session_start();
	}

	function startsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	function echoActiveClass($requestUri) {
		$current_file = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/'));

		if (startsWith($current_file, $requestUri) && $requestUri != '/')
			echo 'class="active"';
		elseif ($current_file == $requestUri)
			echo 'class="active"';
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>%TITLE% | Reciprocal</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<div id="main">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Reciprocal</a>
					</div>
					<div clss="collapse nav-bar-collapse">
						<ul class="nav navbar-nav">
							<li <?php echoActiveClass("/")?>><a href="./">Home</a></li>
							<li <?php echoActiveClass("/browse-recipes.php")?>><a href="./browse-recipes.php">Browse Recipes</a></li>
							<li <?php echoActiveClass("/search-recipes.php")?>><a href="./search-recipes.php">Search Recipes</a></li>
							<li <?php echoActiveClass("/view-recipe.php")?>><a href="./view-recipe.php">View Recipe</a></li>
							<?php if (isset($_SESSION['username'])) { ?>
							<li <?php echoActiveClass("/submit-recipe.php")?>><a href="./submit-recipe.php">Submit Recipe</a></li>
							<?php } ?>
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							<?php if (!(isset($_SESSION['username']))) { ?>
							<li <?php echoActiveClass("/login.php")?>><a href="./login.php">Register / Log In</a></li>
							<?php } else { ?>
							<li><a href="./logout.php">Log Out</a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>