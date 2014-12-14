<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Browse Recipes", $buffer);
	echo $buffer;

	require_once('./RecipeService.php');
	require_once('./AccountService.php');

	$myRecipeService = new RecipeService();
	$myAccountService = new AccountService();

?>

<div class="styled_box" id="yr_submissions">
	<table class="table">
		<caption class="no_top_margin">All Recipes</caption>
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

			$recArray = $myRecipeService->getRecipeList();

			foreach($recArray as $rec) {

		?>
			<tr>
				<td>
				<?php

					$link = './view-recipe.php?recipeId='.$rec->recipeId;
					$recipeName = $rec->recipeName;
					echo "<a href='$link'>$recipeName</a>"

				?>
				</td>
				<td><?php echo($myAccountService->getUsernameById($rec->userId)); ?></td>
				<td><?php echo(date('M j, Y g:i A', strtotime($rec->submissionTS))); ?></td>
				<td>
				<?php
					if (!empty($rec->overallRating))
						echo($rec->overallRating);
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

	include('./footer.php');

?>