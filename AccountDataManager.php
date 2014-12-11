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
			$result = $connection->query("SELECT * FROM UserRecordTable WHERE username='$username' AND password='$password';");
			$rows = $result->num_rows;
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

			$result = $connection->query("INSERT INTO UserRecordTable (username, password, email) VALUES ('$username', '$password', '$email');");
			$connection->close();

			return $result;
		}

		public function getIdByUsername($username) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$username = stripslashes($username);
			$username = $connection->real_escape_string($username);

			$result = $connection->query("SELECT userId FROM UserRecordTable WHERE username='$username';");
			$row = $result->fetch_row();
			$connection->close();
			
			return $row[0];
		}

		public function getUsernameById($userId) {
			// establishing connection
			$connection = mysqli_connect("localhost", "cs2043team4a", "cs2043team4a", "cs2043team4aDB");

			// protect against injection attacks
			$userId = stripslashes($userId);
			$userId = $connection->real_escape_string($userId);

			$result = $connection->query("SELECT username FROM UserRecordTable WHERE userId='$userId';");
			$row = $result->fetch_row();
			$connection->close();
			
			return $row[0];
		}
	}
?>