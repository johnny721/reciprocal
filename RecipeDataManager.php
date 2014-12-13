<?php

	require_once('./RecipeObj.php');

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

		public function insertRecipe($myRecipeObj) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// get object attributes
			$userId = $myRecipeObj->userId;
			$recipeName = $myRecipeObj->recipeName;
			$description = $myRecipeObj->description;
			$cuisine = $myRecipeObj->cuisine;
			$ingredients = $myRecipeObj->ingredients;
			$timeMinutes = $myRecipeObj->timeMinutes;
			$preparation = $myRecipeObj->preparation;
			$imageLink = $myRecipeObj->imageLink;

			// protect against injection attacks
			$userId = stripslashes($userId);
			$recipeName = stripslashes($recipeName);
			$description = stripslashes($description);
			$cuisine = stripslashes($cuisine);
			$ingredients = stripslashes($ingredients);
			$timeMinutes = stripslashes($timeMinutes);
			$preparation = stripslashes($preparation);
			$imageLink = stripslashes($imageLink);
			$userId = $connection->real_escape_string($userId);
			$recipeName = $connection->real_escape_string($recipeName);
			$description = $connection->real_escape_string($description);
			$cuisine = $connection->real_escape_string($cuisine);
			$ingredients = $connection->real_escape_string($ingredients);
			$timeMinutes = $connection->real_escape_string($timeMinutes);
			$preparation = $connection->real_escape_string($preparation);
			$imageLink = $connection->real_escape_string($imageLink);

			// SQL query to insert recipe
			$result = $connection->query("INSERT INTO RecipeInfoTable (userId, recipeName, description, cuisine, ingredients, timeMinutes, preparation, imageLink) VALUES ('$userId', '$recipeName', '$description', '$cuisine', '$ingredients', '$timeMinutes', '$preparation', '$imageLink');");
			$insertId = $connection->insert_id;
			$connection->close();

			return $insertId;
		}
	}

?>