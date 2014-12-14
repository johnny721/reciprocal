<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Your Recipes", $buffer);
	echo $buffer;

	require_once('./ReviewService.php');
	require_once('./AccountService.php');
	require_once('./RecipeService.php');

	$myReviewService = new ReviewService();
	$myAccountService = new AccountService();
	$myRecipeService = new RecipeService();

	if (isset($_SESSION['userId'])) {

?>

<div class="styled_box" id="yr_submissions">
	<table class="table">
		<caption class="no_top_margin">Your Submissions</caption>
		<thead>
			<tr>
				<th>Recipe Name</th>
				<th>Username</th>
				<th>Submitted On</th>
				<th>Overall Rating</th>
			</tr>
		</thead>
		<tbody>
		<?php

			$subArray = $myRecipeService->getSubmissionList($_SESSION['userId']);

			foreach($subArray as $sub) {

		?>
			<tr>
				<td>
				<?php

					$link = './view-recipe.php?recipeId='.$sub->recipeId;
					$recipeName = $sub->recipeName;
					echo "<a href='$link'>$recipeName</a>"

				?>
				</td>
				<td><?php echo($myAccountService->getUsernameById($sub->userId)); ?></td>
				<td><?php echo(date('M j, Y g:i A', strtotime($sub->submissionTS))); ?></td>
				<td>
				<?php
					if (!empty($sub->overallRating))
						echo($sub->overallRating);
					else
						echo('No Rating');
				?>
				</td>
			</tr>
			<?php

			}

			?>
		</tbody>
	</table>
</div>

<div class="styled_box" id="yr_fav">
	<table class="table">
		<caption class="no_top_margin">Your Favorites</caption>
		<thead>
			<tr>
				<th>Recipe Name</th>
				<th>Username</th>
				<th>Submitted On</th>
				<th>Overall Rating</th>
			</tr>
		</thead>
		<tbody>
		<?php

			$favArray = $myReviewService->getFavList($_SESSION['userId']);

			foreach($favArray as $fav) {

		?>
			<tr>
				<td>
				<?php

					$link = './view-recipe.php?recipeId='.$fav->recipeId;
					$recipeName = $fav->recipeName;
					echo "<a href='$link'>$recipeName</a>"

				?>
				</td>
				<td><?php echo($myAccountService->getUsernameById($fav->userId)); ?></td>
				<td><?php echo(date('M j, Y g:i A', strtotime($fav->submissionTS))); ?></td>
				<td>
				<?php
					if (!empty($fav->overallRating))
						echo($fav->overallRating);
					else
						echo('No Rating');
				?>
				</td>
			</tr>
			<?php

			}

			?>
		</tbody>
	</table>
</div>


<?php

	} else {

?>

<div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	You must be logged in to view your recipes.
</div>

<?php

	}
	
	include('./footer.php');

?>