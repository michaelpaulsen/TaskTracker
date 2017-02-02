<?php
class Task {
	public $id;
	public $title;
	public $period;
	public $points;

	private function bindRow($row) {
		$task = new Task();
		$person->id = $row["id"];
		$person->title = $row["title"];
		$person->priod = $row["priod"];
		$person->points = $row["points"];
		return $task;
	}

	static function getAll() {
		$conn = Database::getInstance();
		$result = $conn->getAllByTable('task');
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

	static function Insert($title,$period,$points) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("INSERT INTO task(catagory_id,title,period,points) VALUES (?,?,?);")) {
			$stmt->bind_param("sss",$title,$period,$points);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			if ($result->num_rows >= "1") {
				$row = $result->fetch_assoc();
				return self::bindRow($row);
			}
		}
	}
}
?>