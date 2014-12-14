<?php

	class ReviewDataManager {

		public function getComments($recipeId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$recipeId = $connection->real_escape_string($recipeId);

			$resultArr = array();
			$count = 0;

			if ($result = $connection->query("SELECT * FROM CommentInfoTable WHERE recipeId = '$recipeId' ORDER BY submissionTS;")) {
				while ($row = $result->fetch_row()) {
					$resultArr[$count] = $row;
					$count++;
				}
			}

			$connection->close();

			return $resultArr;
		}

		public function insertComment($myCommentObj) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			$recipeId = $myCommentObj->recipeId;
			$userId = $myCommentObj->userId;
			$commentText = $myCommentObj->commentText;

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$userId = stripslashes($userId);
			$commentText = stripslashes($commentText);
			$recipeId = $connection->real_escape_string($recipeId);
			$userId = $connection->real_escape_string($userId);
			$commentText = $connection->real_escape_string($commentText);

			$result = $connection->query("INSERT INTO CommentInfoTable (recipeId, userId, commentText) VALUES ('$recipeId', '$userId', '$commentText');");
			$connection->close();

			return $result;
		}

		public function getFavStatus($userId, $recipeId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$userId = stripslashes($userId);
			$recipeId = $connection->real_escape_string($recipeId);
			$userId = $connection->real_escape_string($userId);

			$result = $connection->query("SELECT * FROM UserFavoriteTable WHERE userId = '$userId' AND recipeId = '$recipeId';");
			$rows = $result->num_rows;
			$connection->close();

			return ($rows >= 1);
		}

		public function insertFav($userId, $recipeId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$userId = stripslashes($userId);
			$recipeId = $connection->real_escape_string($recipeId);
			$userId = $connection->real_escape_string($userId);

			$result = $connection->query("INSERT INTO UserFavoriteTable (userId, recipeId) VALUES ('$userId', '$recipeId');");
			$connection->close();

			return $result;
		}

		public function deleteFav($userId, $recipeId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$userId = stripslashes($userId);
			$recipeId = $connection->real_escape_string($recipeId);
			$userId = $connection->real_escape_string($userId);

			$result = $connection->query("DELETE FROM UserFavoriteTable WHERE userId = '$userId' AND recipeId = '$recipeId';");
			$connection->close();

			return $result;
		}

		public function getFavList($userId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$userId = stripslashes($userId);
			$userId = $connection->real_escape_string($userId);

			$resultArr = array();
			$count = 0;

			if ($result = $connection->query("SELECT R.recipeId, R.userId, R.recipeName, R.submissionTS, R.overallRating FROM UserFavoriteTable F INNER JOIN RecipeInfoTable R ON F.recipeId = R.recipeId WHERE F.userId = '$userId' ORDER BY R.recipeName;")) {
				while ($row = $result->fetch_row()) {
					$resultArr[$count] = $row;
					$count++;
				}
			}

			$connection->close();

			return $resultArr;
		}
	}

?>