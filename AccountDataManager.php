<?php

	class AccountDataManager {

		public function checkLoginInfo($username, $password) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = $connection->real_escape_string($username);
			$password = $connection->real_escape_string($password);

			// SQL query to find matching user
			$query = $connection->query("SELECT * FROM UserRecordTable WHERE username='$username' AND password='$password';");
			$rows = $query->num_rows;
			$connection->close(); // closing connection
			
			if ($rows == 1)
				return true;
			else
				return false;
			}

		public function createAccount($username, $password, $email) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$username = stripslashes($username);
			$password = stripslashes($password);
			$email = stripcslashes($email);
			$username = $connection->real_escape_string($username);
			$password = $connection->real_escape_string($password);
			$email = $connection->real_escape_string($email);

			$query = $connection->query("INSERT INTO UserRecordTable (username, password, email) VALUES ('$username', '$password', '$email');");
			$connection->close();

			return $query;
		}

		public function getIdByUsername($username) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$username = stripslashes($username);
			$username = $connection->real_escape_string($username);

			$query = $connection->query("SELECT userId FROM UserRecordTable WHERE username='$username';");
			$row = $query->fetch_row();
			$connection->close();
			
			return $row[0];
		}
	}
?>