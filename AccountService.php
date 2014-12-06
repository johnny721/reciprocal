<?php

	require_once('./AccountDataManager.php');

	class AccountService {
		
		public function validateLogin($username, $password) {
			if (empty($username) || empty($password)) 
				return false;
			else {
				$myAccountDataManager = new AccountDataManager();

				if ($myAccountDataManager->checkLoginInfo($username, $password)) {
					$_SESSION['login_user']=$username; // set session login_user
					return true;
				}
				else {
					return false;
				}
			}
		}

		public function validateRegister($username, $password, $verify, $email) {
			if (empty($username) || empty($password) || empty($verify) || empty($email))
				return false;
			else if (strcmp($password, $verify) != 0)
				return false;
			else {
				$myAccountDataManager = new AccountDataManager();

				if ($myAccountDataManager->createAccount($username, $password, $email)) {
					$_SESSION['login_user']=$username; // set session login_user
					return true;
				}
				else {
					return false;
				}
			}
		}
	}

?>