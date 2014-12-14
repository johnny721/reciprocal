<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Submit Recipe", $buffer);
	echo $buffer;

	if (isset($_SESSION['username'])) {

		// handle submit recipe
		if (isset($_POST['sr_submit'])) {
			require_once('./RecipeObj.php');
			require_once('./RecipeService.php');

			// get SESSION data
			$userId = $_SESSION['userId'];

			// get POST data
			$recipeName = $_POST['sr_name'];
			$description = $_POST['sr_description'];
			$cuisine = $_POST['sr_cuisine'];
			$ingredients = $_POST['sr_ingredients'];
			$timeMinutes = $_POST['sr_time_hr'] * 60 + $_POST['sr_time_min'];
			$preparation = $_POST['sr_preparation'];
			$imageLink = $_POST['sr_imageLink'];

			// create object
			$myRecipeObj = new RecipeObj();
			$myRecipeObj->userId = $userId;
			$myRecipeObj->recipeName = $recipeName;
			$myRecipeObj->description = $description;
			$myRecipeObj->cuisine = $cuisine;
			$myRecipeObj->ingredients = $ingredients;
			$myRecipeObj->timeMinutes = $timeMinutes;
			$myRecipeObj->preparation = $preparation;
			$myRecipeObj->imageLink = $imageLink;

			$myRecipeService = new RecipeService();
			$submitResult = $myRecipeService->validateSubmitRecipe($myRecipeObj);

			if ($submitResult["code"] == 0) {
				$recipeId = strval($submitResult["insert_id"]);
				header("Location: ./view-recipe.php?recipeId=$recipeId");
			} elseif ($submitResult["code"] == 1) {

?>

<div class="alert alert-danger sr_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	Unable to submit recipe
</div>

<?php

			} elseif ($submitResult["code"] == 2) {

?>

<div class="alert alert-danger sr_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	Not all required fields are filled
</div>

<?php

			}
		}

?>

<div class="styled_box" id="sr_container">
	<form action="" method="POST">
		<div class="sr_field">
			<div>
				<label for="sr_name">Recipe Name *</label>
			</div>
			<div>
				<input id="sr_name" name="sr_name" type="text" maxlength="100" value="<?php echo isset($_POST['sr_submit']) ? htmlspecialchars($_POST['sr_name']) : '' ?>">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_description">Description *</label>
			</div>
			<div>
				<textarea id="sr_description" name="sr_description" rows="5" cols="60" maxlength="1000"><?php echo isset($_POST['sr_submit']) ? htmlspecialchars($_POST['sr_description']) : '' ?></textarea>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_cuisine">Cuisine</label>
			</div>
			<div>
				<select id="sr_cuisine" name="sr_cuisine" value="<?php echo isset($_POST['sr_submit']) ? $_POST['sr_cuisine'] : '' ?>">
					<option value="">None</option>
					<option value="american">American</option>
					<option value="asian">Asian</option>
					<option value="french">French</option>
					<option value="greek">Greek</option>
					<option value="indian">Indian</option>
					<option value="italian">Italian</option>
					<option value="jewish">Jewish</option>
					<option value="mexican">Mexican</option>
					<option value="middle eastern">Middle Eastern</option>
					<option value="spanish">Spanish</option>
				</select>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_ingredients">Ingredients *</label>
			</div>
			<div>
				<textarea id="sr_ingredients" name="sr_ingredients" rows="5" cols="60" maxlength="1000"><?php echo isset($_POST['sr_submit']) ? htmlspecialchars($_POST['sr_ingredients']) : '' ?></textarea>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_time_hr">Cook Time *</label>
			</div>
			<div>
				<select id="sr_time_hr" name="sr_time_hr" value="<?php echo isset($_POST['sr_submit']) ? $_POST['sr_time_hr'] : '' ?>">
				<?php

				foreach (range(0, 48) as $h) {
					echo "<option value='$h'>$h</option>";
				}

				?>
				</select>
				<span>hours</span>
				<select id="sr_time_min" name="sr_time_min" value="<?php echo isset($_POST['sr_submit']) ? $_POST['sr_time_min'] : '' ?>">
				<?php

				foreach (range(0, 11) as $n) {
					$m = 5 * $n;
					echo "<option value='$m'>$m</option>";
				}

				?>
				</select>
				<span>minutes</span>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_preparation">Preparation *</label>
			</div>
			<div>
				<textarea id="sr_preparation" name="sr_preparation" rows="10" cols="60" maxlength="5000"><?php echo isset($_POST['sr_submit']) ? htmlspecialchars($_POST['sr_preparation']) : '' ?></textarea>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_imageLink">Link to Image</label>
			</div>
			<div>
				<input id="sr_imageLink" name="sr_imageLink" type="url" size="59" maxlength="200" value="<?php echo isset($_POST['sr_submit']) ? $_POST['sr_imageLink'] : '' ?>">
			</div>
		</div>
		<input class="btn btn-default" id="sr_submit" name="sr_submit" type="submit" value="Submit Recipe">
	</form>
</div>

<?php

	} else {

?>

<div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	You must be logged in to submit a recipe
</div>

<?php

	}

	include('./footer.php');

?>

<script type="text/javascript">
	$(function()) {
		// javascript to keep values after POST submission
		$("#sr_cuisine").val("<?php echo $_POST['sr_cuisine']; ?>");
		$("#sr_time_hr").val("<?php echo $_POST['sr_time_hr']; ?>");
		$("#sr_time_min").val("<?php echo $_POST['sr_time_min']; ?>");
	}
</script>