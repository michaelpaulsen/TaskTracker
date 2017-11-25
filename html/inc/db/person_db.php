<?php
class Person {
	const ROLE_ADMIN = "admin";
	const ROLE_USER = "user";
	public $id;
	public $username;
	public $password;
	public $email;
	public $name;
	public $role;
	public $color;

	private function bindRow($row) {
		$person = new Person();
		$person->id = $row["id"];
		$person->username = $row["username"];
		$person->password = $row["password"];
		$person->email = $row["email"];
		$person->name = $row["name"];
		$person->role = $row["role"];
		$person->color = $row["color"];
		return $person;
	}

	static function getAll() {
		$conn = Database::getInstance();
		$result = $conn->getAllByTable('person');
		if ($result && $result->num_rows > 0) {
			$people = Array();
			while($row = $result->fetch_assoc()) {
				$people[] = self::bindRow($row);
			}
			return $people;
		} else {
			return null;
		}
	}

	static function getByUsername($username) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("SELECT * FROM Person WHERE username=?")) {
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result->num_rows >= "1") {
				$row = $result->fetch_assoc();
				return self::bindRow($row);
			}
			return null;
		}
	}

	static function getBy($key, $value) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("SELECT * FROM Person WHERE ?=?")) {
			$stmt->bind_param("ss", $key, $value);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result->num_rows >= "1") {
				$row = $result->fetch_assoc();
				return self::bindRow($row);
			}
			return null;
		}
	}

	static function getByRole($role) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("SELECT * FROM Person WHERE role=?")) {
			$person = new Person();
			$stmt->bind_param("s", $role);
			$stmt->execute();
			$row = $stmt->fetch();
			$stmt->close();
			return self::bindRow($row);
		}
		return null;
	}
	static function Insert($username,$password,$email,$name,$role,$color = "ffffff") {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("INSERT INTO Person(username,password,email,name,role,color) VALUES (?,?,?,?,?,?);")) {
			$stmt->bind_param("ssssss", $username,$password,$email,$name,$role,$color);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result->num_rows >= "1") {
				$row = $result->fetch_assoc();
				return self::bindRow($row);
			}
		}
	}

static function update( $id,$username,$password,$email,$name,$role,$color) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("UPDATE `task_tracker`.`person` SET `username` = ?, `password`= ?, `email` = ?,`name`= ?,`role` = ?, `color` = ? WHERE `person`.`id` = ?;") ;
		if ($stmt !== false) {
			$stmt->bind_param("ssssssi",$username,$password,$email,$name,$role,$color,$id);
			$status = $stmt->execute();
			$stmt->close();
			
			return $status;
		}
	}


static function delete( $id) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("DELETE FROM `task_tracker`.`person` WHERE `person`.`id` = ?") ;
		if ($stmt !== false) {
			$stmt->bind_param("i",$id);
			$status = $stmt->execute();
			$stmt->close();
			return $status;
		}
	}

}


?>