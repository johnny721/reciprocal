<?php

	require_once('./CommentObj.php');
	require_once('./ReviewService.php');
	require_once('./AccountService.php');

	$myReviewService = new ReviewService();
	$myAccountService = new AccountService();

	if (isset($_POST['sc_submit']) && isset($_SESSION['userId'])) {
		// get GET data
		$recipeId = $_GET['recipeId'];

		// get SESSION data
		$userId = $_SESSION['userId'];

		// get POST data
		$commentText = $_POST['sc_ta'];

		// create object
		$myCommentObj = new CommentObj();
		$myCommentObj->recipeId = $recipeId;
		$myCommentObj->userId = $userId;
		$myCommentObj->commentText = $commentText;

		$commentResult = $myReviewService->validateSubmitComment($myCommentObj);

		if ($commentResult == 0) {

?>

<div class="alert alert-success sc_alert" role="alert">
	<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	<span class="sr-only">Success:</span>
	Your comment has been submitted
</div>

<?php

		} elseif ($commentResult == 1) {

?>

<div class="alert alert-danger sc_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	Your comment could not be submitted
</div>

<?php

		} elseif ($commentResult == 2) {

?>

<div class="alert alert-danger sc_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	Comment field is empty
</div>

<?php

		}
	} elseif (isset($_POST['sc_submit']) && empty($_SESSION['userId'])) {

?>

<div class="alert alert-danger sc_alert" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<span class="sr-only">Error:</span>
	You must be logged in to comment
</div>

<?php

	}

?>

<div class="styled_box" id="sc_container">
	<h4 class="no_top_margin">Submit Comment</h4>
	<form action="" method="POST" id="sc_form">
		<textarea id="sc_ta" name="sc_ta" rows='5' maxlength="1500"><?php echo isset($_POST['sc_submit']) ? htmlspecialchars($_POST['sc_ta']) : '' ?></textarea>
		<input class="btn btn-default" id="sc_submit" name="sc_submit" type="submit" value="Submit">
	</form>
</div>
<div class="styled_box" id="vc_container">
	<h4 class="no_top_margin">Comments</h4>
	<hr class="divider" />
	<?php
		$commentArray = $myReviewService->getCommentList($recipeId);

		if (sizeof($commentArray) == 0) {
			echo('No comments');
		}

		foreach($commentArray as $comment) {
	?>
	<div>
		<p><?php echo($comment->commentText); ?></p>
		<p>by <?php echo($myAccountService->getUsernameById($comment->userId)); ?> | <?php echo(date('M j, Y g:i A', strtotime($comment->submissionTS))); ?></p>
	</div>
	<hr class="divider" />
	<?php
		}
	?>
</div>