<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "View Recipe", $buffer);
	echo $buffer;

	if (isset($_GET['recipeId'])) {
		require_once('./RecipeService.php');

		// get GET data
		$recipeId = $_GET['recipeId'];

		$myRecipeService = new RecipeService();
		$viewRecipeResult = $myRecipeService->validateViewRecipe($recipeId);

		if (!is_null($viewRecipeResult)) {
			require_once('./AccountService.php');

			$myAccountService = new AccountService();
			$recipeUsername = $myAccountService->getUsernameById($viewRecipeResult->userId);

?>

<div class="styled_box" id="vr_container">
	<div>
		<h3 class="no_top_margin"><?php echo($viewRecipeResult->recipeName); ?></h3>
		<h5>by <?php echo($recipeUsername); ?> | <?php echo(date('F jS, Y', strtotime($viewRecipeResult->submissionTS))); ?></h5>
	</div>
	<img id="vr_image" src="<?php echo($viewRecipeResult->imageLink); ?>" onerror="this.style.display='none';">
	<div class="vr_field">
		<p class="bold">Description</p>
		<p><?php echo($viewRecipeResult->description); ?></p>
	</div>
	<?php if (!empty($viewRecipeResult->cuisine)) { ?>
	<div class="vr_field">
		<p class="bold">Cuisine</p>
		<p><?php echo(ucfirst($viewRecipeResult->cuisine)); ?></p>
	</div>
	<?php } ?>
	<div class="vr_field">
		<p class="bold">Ingredients</p>
		<p><?php echo($viewRecipeResult->ingredients); ?></p>
	</div>
	<div class="vr_field">
		<p class="bold">Cook Time</p>
		<p>
		<?php
			$timeHours = (int)($viewRecipeResult->timeMinutes / 60);
			if ($timeHours != 0) {
				echo($timeHours);
		?> hours 
		<?php
			}
			echo($viewRecipeResult->timeMinutes % 60);
		?> minutes
		</p>
	</div>
	<div class="vr_field">
		<p class="bold">Preparation</p>
		<p><?php echo($viewRecipeResult->preparation); ?></p>
	</div>
</div>

<?php

		} else {

?>

<div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	Recipe could not be found
</div>

<?php

		}
	} else {

?>

<div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	No recipe selected
</div>

<?php

	}

	include('./footer.php');

?>