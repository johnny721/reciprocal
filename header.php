<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
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
							<li <?=echoActiveClassIfRequestMatches("")?>><a href="./">Home</a></li>
							<li <?=echoActiveClassIfRequestMatches("browse-recipes")?>><a href="./browse-recipes.php">Browse Recipes</a></li>
							<li <?=echoActiveClassIfRequestMatches("search-recipes")?>><a href="./search-recipes.php">Search Recipes</a></li>
							<li <?=echoActiveClassIfRequestMatches("view-recipe")?>><a href="./view-recipe.php">View Recipe</a></li>
							<li <?=echoActiveClassIfRequestMatches("submit-recipe")?>><a href="./submit-recipe.php">Submit Recipe</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li <?=echoActiveClassIfRequestMatches("login")?>><a href="./login.php">Register / Log In</a></li>
						</ul>
					</div>
				</div>
			</nav>