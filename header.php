<?php 

function echoActiveClass($requestUri)
{
	$current_file = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1);

	if ($current_file == $requestUri)
		echo 'class="active"';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>%TITLE% | Reciprocal</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
							<li <?php echoActiveClass("")?>><a href="./">Home</a></li>
							<li <?php echoActiveClass("browse-recipes.php")?>><a href="./browse-recipes.php">Browse Recipes</a></li>
							<li <?php echoActiveClass("search-recipes.php")?>><a href="./search-recipes.php">Search Recipes</a></li>
							<li <?php echoActiveClass("view-recipe.php")?>><a href="./view-recipe.php">View Recipe</a></li>
							<li <?php echoActiveClass("submit-recipe.php")?>><a href="./submit-recipe.php">Submit Recipe</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li <?php echoActiveClass("login.php")?>><a href="./login.php">Register / Log In</a></li>
						</ul>
					</div>
				</div>
			</nav>