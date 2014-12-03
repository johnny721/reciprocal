<?php

	class LoginDataManager{

		public function getLoginInfo($username, $password){
			// establishing connection
			$connection = mysqli_connect("localhost", "root", "", "cs2043team4aDB");

			// protect against injection attacks
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = $connection->real_escape_string($username);
			$password = $connection->real_escape_string($password);

			// SQL query to fetch information of registerd users and finds user match
			$query = $connection->query("select * from UserRecordTable where password='$password' AND userName='$username'");
			$rows = $query->num_rows;
			$connection->close(); // closing Connection
			
			if ($rows == 1)
				return true;
			else
				return false;
			}
	}

?>