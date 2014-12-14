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
				$myRecipeObj->overallRating = $recipeInfo[10];

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

		public function getSubmissionList($userId) {
			$myRecipeDataManager = new RecipeDataManager();

			$recipeArr = $myRecipeDataManager->getSubmissionList($userId);

			if (is_null($recipeArr)) {
				return NULL;
			}

			$recipeObjectArr = array();

			for ($count = 0; $count < sizeOf($recipeArr); $count++) {
				$recipeObjectArr[$count] = new RecipeObj();
				$recipeObjectArr[$count]->recipeId = $recipeArr[$count][0];
				$recipeObjectArr[$count]->userId = $recipeArr[$count][1];
				$recipeObjectArr[$count]->recipeName = $recipeArr[$count][2];
				$recipeObjectArr[$count]->submissionTS = $recipeArr[$count][3];
				$recipeObjectArr[$count]->overallRating = $recipeArr[$count][4];
			}

			return $recipeObjectArr;
		}

		public function getRecipeList() {
			$myRecipeDataManager = new RecipeDataManager();

			$recipeArr = $myRecipeDataManager->getRecipeList();

			if (is_null($recipeArr)) {
				return NULL;
			}

			$recipeObjectArr = array();

			for ($count = 0; $count < sizeOf($recipeArr); $count++) {
				$recipeObjectArr[$count] = new RecipeObj();
				$recipeObjectArr[$count]->recipeId = $recipeArr[$count][0];
				$recipeObjectArr[$count]->userId = $recipeArr[$count][1];
				$recipeObjectArr[$count]->recipeName = $recipeArr[$count][2];
				$recipeObjectArr[$count]->submissionTS = $recipeArr[$count][3];
				$recipeObjectArr[$count]->overallRating = $recipeArr[$count][4];
			}

			return array_reverse($recipeObjectArr);
		}
	}

?>