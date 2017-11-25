<?php
class Task {
	const PEROID_DAILY = "daily";
	const PEROID_SEMIWEEKLY = "semiweekly";
	const PEROID_WEEKLY = "weekly";
	const PEROID_SEMIMONTHLY = "semimonthly";
	const PEROID_MONTHLY = "monthly";
	public $id;
	public $category_id;
	public $title;
	public $period;
	public $points;
	private function bindRow($row) {
		/*
			id
			
		*/
		$Task = new Task();
		$Task->id = $row["id"];
		$Task->categoryId = $row["category_id"];
		$Task->title = $row["title"];
		$Task->period = $row["period"];
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
			return [];
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
	static function getPeroids() {
		return array(self::PEROID_DAILY, self::PEROID_SEMIWEEKLY, self::PEROID_WEEKLY, self::PEROID_SEMIMONTHLY, self::PEROID_MONTHLY);
	}
	
	
	static function Insert( $category_id, $title, $period, $points ) {
		$conn = Database::getInstance();

		if ($stmt = $conn->prepare("INSERT INTO Task(category_id, title, period, points) VALUES (?,?,?,?);") ) 	{

			$stmt->bind_param("ssss", $category_id, $title, $period, $points);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result && $result->num_rows >= "1") {
var_dump(1);
				$row = $result->fetch_assoc();
				return self::bindRow($row);
			}
		}else{
		}
	}
	

static function update( $id,$title,$category_id,$peroid,$points) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("UPDATE `task_tracker`.`Task` SET `category_id` =?, `title` =?, `peroid` =? `pints` =? WHERE `Task`.`id` = ?;") ;
		if ($stmt !== false) {
			$stmt->bind_param("ssssi",$title,$category_id,$peroid,$points,$id);
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