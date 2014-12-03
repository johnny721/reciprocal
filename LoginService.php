<?php

require_once('./LoginDataManager.php');

class LoginService{
	public function validate($username, $password){
		$loginerror=''; 

		if (empty($username) || empty($password)) 
			$loginerror = "Username or Password is invalid";
		else{
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			$loginDBManager = new LoginDataManager();

			if ($loginDBManager->getLoginInfo($username,$password)){//not sure if this is how it should be	
				$_SESSION['login_user']=$username; // Initializing Session
				$loginerror="success!";
			} 
			else {
				$loginerror = "Username or Password is invalid";
			}
		}

		return $loginerror;
	}
}

?>