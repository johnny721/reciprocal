<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Submit Recipe", $buffer);
	echo $buffer;

?>

<div class="styled_box" id="sr_container">
	<form action="" method="POST">
		<div class="sr_field">
			<div>
				<label>Recipe Name</label>
			</div>
			<div>
				<input id="sr_name" name="sr_name" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Ingredients</label>
			</div>
			<div>
				<input id="sr_ingredients" name="sr_ingredients" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Cook Time</label>
			</div>
			<div>
				<input id="sr_time_hr" name="sr_time_hr" type="text">
				<span>hours</span>
				<input id="sr_time_min" name="sr_time_min" type="text">
				<span>minutes</span>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Cuisine</label>
			</div>
			<div>
				<input id="sr_cuisine" name="sr_cuisine" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Type</label>
			</div>
			<div>
				<select id="sr_type" name="sr_type">
					<option value="volvo">Volvo</option>
				</select>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Description</label>
			</div>
			<div>
				<textarea id="sr_description" name="sr_description" rows="10" cols="60"></textarea>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label>Link to Picture</label>
			</div>
			<div>
				<input id="sr_piclink" name="sr_piclink" type="url">
			</div>
		</div>
		<input class="btn btn-default" id="sr_submit" name="sr_submit" type="submit" value="Submit Recipe">
	</form>
</div>

<?php

	include('./footer.php');

?>