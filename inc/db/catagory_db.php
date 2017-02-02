<?php
class Category {
	public $id;
	public $title;
	public $person_id;

	private function bindRow($row) {
		$category = new Category();
		$category->id = $row["id"];
		$category->title = $row["title"];
		$category->person_id = $row["person_id"];
		return $category;
	}

	static function getAll() {
		$conn = Database::getInstance();
		$result = $conn->getAllByTable('category');
		if ($result && $result->num_rows > 0) {
			$categories = Array();
			while($row = $result->fetch_assoc()) {
				$categories[] = self::bindRow($row);
			}
			return $categories;
		} else {
			return null;
		}
	}

	static function getBy($key, $value) {
		$conn = Database::getInstance();
		if ($stmt = $conn->prepare("SELECT * FROM Category WHERE ?=?")) {
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

	static function Insert($title,$person_id = NULL) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("INSERT INTO category (title,person_id) VALUES (?,?);");
		if ($stmt !== false) {
			$stmt->bind_param("si",$title,$person_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
		}
		if ($result && $result->num_rows >= "1") {
			$row = $result->fetch_assoc();
			return self::bindRow($row);	
		}
	}

	static function update($id,$title,$person_id=NULL) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("UPDATE `task_tracker`.`category` SET `title`=?,`person_id`=? WHERE `category`.`id`=?;") ;
		if ($stmt !== false) {
			$stmt->bind_param("sii",$title,$person_id,$id);
			$status = $stmt->execute();
			$stmt->close();
			
			return $status;
		}
	}


	static function delete( $id) {
		$conn = Database::getInstance();
		$stmt = $conn->prepare("DELETE FROM `task_tracker`.`category` WHERE `category`.`id` = ?") ;
		if ($stmt !== false) {
			$stmt->bind_param("i",$id);
			$status = $stmt->execute();
			$stmt->close();
			return $status;
		}
	}

}
?>