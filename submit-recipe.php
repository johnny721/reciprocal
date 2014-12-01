<?php

	ob_start();
	include('header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Submit a Recipe", $buffer);
	echo $buffer;

?>

	<form action="" method="POST">
		<div>
			<label>Recipe Name</label>
			<input id="recipe_name" name="recipe_name" type="text">
		</div>
		<div>
			<label>Ingredients</label>
			<input id="recipe_name" name="recipe_name" type="text">
		</div>
		<div>
			<label>Cook Time</label>
			<input id="recipe_time_hr" name="recipe_time_hr" type="text">
			<span>Hours</span>
			<input id="recipe_time_min" name="recipe_time_min" type="text">
			<span>Minutes</span>
		</div>
		<div>
			<label>Cuisine</label>
			<input id="recipe_cuisine" name="recipe_cuisine" type="text">
		</div>
		<div>
			<label>Type</label>
			<select id="recipe_type" name="recipe_type">
				<option value="volvo">Volvo</option>
			</select>
		</div>
		<div>
			<label>Description</label>
			<input id="recipe_description" name="recipe_description" type="text">
		</div>
		<div>
			<label>Link to Picture</label>
			<input id="recipe_name" name="recipe_name" type="url">
		</div>
		<input class="btn btn-default" id="recipe_submit" name="recipe_submit" type="submit" value="Submit Recipe">
	</form>

<?php

	include('footer.php');

?>