<?php

	require_once('./RecipeObj.php');

	class ReviewDataManager {

		public function getComments($recipeId) {
			// establish connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$recipeId = $connection->real_escape_string($recipeId);

			$resultArr = array();
			$count = 0;

			if ($result = $connection->query("SELECT * FROM CommentInfoTable WHERE recipeId = '$recipeId';")) {
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

			return $result;
		}
	}

?>