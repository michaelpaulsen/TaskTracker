<?php
class Task {
	public $id;
	public $category_id;
	public $title;
	public $peroid;
	public $points;
		
	private function bindRow($row) {
		/*
			id
			
		*/
		$Task = new Task();
		$Task->id = $row["id"];
		$Task->categoryId = $row["category_id"];
		$Task->title = $row["title"];
		//$Task->peroid = $row["peroid"];
		$Task->points = $row["points"];
		return $Task;
	}

	static function getAll() {
		$conn = Database::getInstance();
		$result = $conn->getAllByTable('Task');
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

	static function getBy($key, $value) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("SELECT * FROM Task WHERE ?=?")) {
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
	static function Insert($username,$password,$email,$name,$role,$color = "ffffff") {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("INSERT INTO Task(username,password,email,name,role,color) VALUES (?,?,?,?,?,?);")) {
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
		$stmt = $conn->prepare("UPDATE `task_tracker`.`Task` SET `username` = ?, `password`= ?, `email` = ?,`name`= ?,`role` = ?, `color` = ? WHERE `Task`.`id` = ?;") ;
		if ($stmt !== false) {
			$stmt->bind_param("ssssssi",$username,$password,$email,$name,$role,$color,$id);
			$status = $stmt->execute();
			$stmt->close();
			
			return $status;
		}
	}


static function delete( $id) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("DELETE FROM `task_tracker`.`Task` WHERE `Task`.`id` = ?") ;
		if ($stmt !== false) {
			$stmt->bind_param("i",$id);
			$status = $stmt->execute();
			$stmt->close();
			return $status;
		}
	}

}
?>