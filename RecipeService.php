<?php

	require_once('./RecipeObj.php');
	require_once('./RecipeDataManager.php');

	class RecipeService {
		
		public function validateViewRecipe($recipeId) {
			$myRecipeDataManager = new RecipeDataManager();
			$recipeInfo = $myRecipeDataManager->getRecipeInfo($recipeId);

			if (!is_null($recipeInfo)) {
				$myRecipeObj = new RecipeObj();

				$myRecipeObj->recipeId = $recipeInfo[0];
				$myRecipeObj->userId = $recipeInfo[1];
				$myRecipeObj->recipeName = $recipeInfo[2];
				$myRecipeObj->description = $recipeInfo[3];
				$myRecipeObj->cuisine = $recipeInfo[4];
				$myRecipeObj->ingredients = $recipeInfo[5];
				$myRecipeObj->preparation = $recipeInfo[6];
				$myRecipeObj->timeMinutes = $recipeInfo[7];
				$myRecipeObj->imageLink = $recipeInfo[8];
				$myRecipeObj->submissionTS = $recipeInfo[9];

				return $myRecipeObj;
			} else {
				return null;
			}
		}

		public function validateSubmitRecipe($myRecipeObj) {
			// get object attributes
			$userId = $myRecipeObj->userId;
			$recipeName = $myRecipeObj->recipeName;
			$description = $myRecipeObj->description;
			$cuisine = $myRecipeObj->cuisine;
			$ingredients = $myRecipeObj->ingredients;
			$timeMinutes = $myRecipeObj->timeMinutes;
			$preparation = $myRecipeObj->preparation;
			$imageLink = $myRecipeObj->imageLink;

			if (empty($userId) || empty($recipeName) || empty($description) || empty($ingredients) || $timeMinutes == 0 || empty($preparation)) {
				$array = array("code" => 2, "insert_id" => null);
			} else {
				$myRecipeDataManager = new RecipeDataManager();
				$insertId = $myRecipeDataManager->insertRecipe($myRecipeObj);
				if ($insertId != 0) {
					$array = array("code" => 0, "insert_id" => $insertId);
				} else {
					$array = array("code" => 1, "insert_id" => null);
				}
			}

			return $array;
		}
	}

?>