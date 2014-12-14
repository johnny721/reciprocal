<?php

	require_once('./ReviewService.php');

	$myReviewService = new ReviewService();
	$userId = $_SESSION['userId'];
	$recipeId = $_GET['recipeId'];

	if (isset($_POST['favorite_submit'])) {
		$favResult = $myReviewService->addFav($userId, $recipeId);
	} elseif (isset($_POST['unfavorite_submit'])) {
		$favResult = $myReviewService->removeFav($userId, $recipeId);
	}

	if (isset($_SESSION['userId'])) {

?>

<div id="fv_container">
	<?php

		if (!$myReviewService->checkFavStatus($userId, $recipeId)) {

	?>
	<form method='POST'>
		<input class="btn btn-default" id="favorite_submit" name="favorite_submit" type="submit" value="Favorite">
	</form>
	<?php

		} else {

	?>
	<form method='POST'>
		<input class="btn btn-default" id="unfavorite_submit" name="unfavorite_submit" type="submit" value="Unfavorite">
	</form>
	<?php

		} 

		if (isset($_favResult) && $favResult == 1) {

	?>

	<div class="alert alert-danger fav_alert" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		Could not perform operation
	</div>

	<?php

		}

	?>

</div>

<?php

	} else {

?>

<div class="alert alert-danger fav_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	You must be logged in to favorite a recipe
</div>

<?php

	}

?>