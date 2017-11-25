<?php

class Database extends MySQLi {
	const HOST = "localhost";
	const DATABASE = "task_tracker";
	const USER = "task_tracker";
	const PASSWORD = "password";
	private static $instance = null ;

	private function __construct($host, $user, $password, $database){ 
		parent::__construct($host, $user, $password, $database);
	}

	public static function getInstance(){
		if (self::$instance == null){
			self::$instance = new self(self::HOST, self::USER, self::PASSWORD, self::DATABASE);
		}
		return self::$instance;
	}
	public function getAllByTable($table) {
		$conn = Database::getInstance();
		$sql = "SELECT * FROM $table";
		$result = $conn->query($sql);
		return $result;
	}
}
include $_SERVER['DOCUMENT_ROOT'] . "/inc/db/person_db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/db/task_db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/inc/db/catagory_db.php";
?>