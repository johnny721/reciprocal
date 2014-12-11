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
	}

?>