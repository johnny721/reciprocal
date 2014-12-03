<?php
class LoginDataManager{

	public function getLoginInfo($username, $password){
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysqli_connect("localhost", "root", "", "cs2043team4aDB");
		// SQL query to fetch information of registerd users and finds user match.

		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = $connection->real_escape_string($username);
		$password = $connection->real_escape_string($password);

		$query = $connection->query("select * from UserRecordTable where password='$password' AND userName='$username'");
		$rows = $query->num_rows;
		$connection->close(); // Closing Connection
		if ($rows == 1)
			return true;
		else
			return false;
		}
}
?>