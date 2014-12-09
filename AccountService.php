<?php

	require_once('./AccountDataManager.php');

	class AccountService {
		
		public function validateLogin($username, $password) {
			if (empty($username) || empty($password)) 
				return 2;
			else {
				$myAccountDataManager = new AccountDataManager();

				if ($myAccountDataManager->checkLoginInfo($username, $password)) {
					// set session variable
					$_SESSION['username']=$username;
					$_SESSION['userId']=$myAccountDataManager->getIdByUsername($username);
					return 0;
				}
				else {
					return 1;
				}
			}
		}

		public function validateRegister($username, $password, $verify, $email) {
			if (empty($username) || empty($password) || empty($verify) || empty($email))
				return 2;
			else if (strcmp($password, $verify) != 0)
				return 3;
			else {
				$myAccountDataManager = new AccountDataManager();

				if ($myAccountDataManager->createAccount($username, $password, $email)) {
					// set session variable
					$_SESSION['username']=$username;
					$_SESSION['userId']=$myAccountDataManager->getIdByUsername($username);
					return 0;
				}
				else {
					return 1;
				}
			}
		}
	}

?>