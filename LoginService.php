<?php

	require_once('./LoginDataManager.php');

	class LoginService {
		
		public function validate($username, $password) {
			if (empty($username) || empty($password)) 
				return false;
			else {
				$myLoginDataManager = new LoginDataManager();

				if ($myLoginDataManager->getLoginInfo($username,$password)) {
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