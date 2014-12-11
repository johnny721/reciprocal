<?php

	class RecipeDataManager{

		public function getRecipeInfo($recipeId) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$recipeId = stripslashes($recipeId);
			$recipeId = $connection->real_escape_string($recipeId);

			// SQL query to get recipe info
			$result = $connection->query("SELECT * FROM RecipeInfoTable WHERE recipeId='$recipeId';");
			$connection->close();

			if ($result->num_rows != 0) {
				$row = $result->fetch_row();
				return $row;
			} else {
				return null;
			}
		}
	}

?>