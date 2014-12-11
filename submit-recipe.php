<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Submit Recipe", $buffer);
	echo $buffer;

	if (isset($_SESSION['username'])) {

?>

<div class="styled_box" id="sr_container">
	<form action="" method="POST">
		<div class="sr_field">
			<div>
				<label for="sr_name">Recipe Name *</label>
			</div>
			<div>
				<input id="sr_name" name="sr_name" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_description">Description *</label>
			</div>
			<div>
				<input id="sr_description" name="sr_description" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_ingredients">Ingredients *</label>
			</div>
			<div>
				<input id="sr_ingredients" name="sr_ingredients" type="text">
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_time_hr">Cook Time *</label>
			</div>
			<div>
				<select>
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
				</select>
				<input id="sr_time_hr" name="sr_time_hr" type="text">
				<span>hours</span>
				<input id="sr_time_min" name="sr_time_min" type="text">
				<span>minutes</span>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_preparation">Preparation *</label>
			</div>
			<div>
				<textarea id="sr_preparation" name="sr_preparation" rows="10" cols="60"></textarea>
			</div>
		</div>
		<div class="sr_field">
			<div>
				<label for="sr_imagelink">Link to Image</label>
			</div>
			<div>
				<input id="sr_imagelink" name="sr_imagelink" type="url">
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