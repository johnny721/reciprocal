<?php

	require_once('./CommentObj.php');
	require_once('./ReviewDataManager.php');

	class ReviewService {

		public function getCommentList($recipeId) {

			$myReviewDataManager = new ReviewDataManager();

			$commentArr = $myReviewDataManager->getComments($recipeId);

			if (is_null($commentArr)) {
				return NULL;
			}

			$commentObjectArr = array();

			for ($count = 0; $count < sizeOf($commentArr); $count++) {
				$commentObjectArr[$count] = new CommentObj();
				$commentObjectArr[$count]->commentId = $commentArr[$count][0];
				$commentObjectArr[$count]->recipeId = $commentArr[$count][1];
				$commentObjectArr[$count]->userId = $commentArr[$count][2];
				$commentObjectArr[$count]->commentText = $commentArr[$count][3];
				$commentObjectArr[$count]->submissionTS = $commentArr[$count][4];
			}

			return array_reverse($commentObjectArr);
		}

		public function validateSubmitComment($myCommentObj) {

			if (empty($myCommentObj->commentText)) {
				return 2;
			} else {
				$myReviewDataManager = new ReviewDataManager();

				if ($myReviewDataManager->insertComment($myCommentObj))
					return 0;
				else
					return 1;
			}
		}

		public function checkFavStatus($userId, $recipeId) {
			$myReviewDataManager = new ReviewDataManager();

			return $myReviewDataManager->getFavStatus($userId, $recipeId);
		}

		public function addFav($userId, $recipeId) {
			$myReviewDataManager = new ReviewDataManager();

			if ($myReviewDataManager->insertFav($userId, $recipeId))
				return 0;
			else
				return 1;
		}

		public function removeFav($userId, $recipeId) {
			$myReviewDataManager = new ReviewDataManager();

			if ($myReviewDataManager->deleteFav($userId, $recipeId))
				return 0;
			else
				return 1;
		}
	}

?>