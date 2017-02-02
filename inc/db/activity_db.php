<?php
class Activity{
	public $id;
	public $Person_id;
	public $task_id;
	public $timestamp;
	public $note;
	private function bindRow($row) {
		$activity = new Activity();
		$activity->id = $row["id"];
		$activity->Person_id = $row["person_id"];
		$activity->task_id = $row["task_id"];
		$activity->timestamp = $row["timestamp"];
		return $activity;
	}

static function getAll() {
		$conn = Database::getInstance();
		$result = $conn->getAllByTable('task');
		if ($result && $result->num_rows > 0) {
			$tasks = Array();
			while($row = $result->fetch_assoc()) {
				$people[] = self::bindRow($row);
			}
			return $tasks;
		} else {
			return null;
		}
	}
	static function Insert($person_id,$task_id,$timestamp,$note) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("INSERT INTO activity(person_id,task_id,timestamp,note)VALUES (?,?,?,?);")) {
			$stmt->bind_param("ssss",$person_id,$task_id,$timestamp,$note);
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