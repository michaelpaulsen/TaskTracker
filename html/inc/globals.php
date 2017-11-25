<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/db/db.php';

session_start();


function assertLoggedIn($s_url = "/dashboard.php",$f_url = "/") {
	$_SESSION['erer'] = NULL;
	
	if (!isset($_SESSION['username'])){
		if(isset($_POST['username'])){
			
			$person = Person::getByUsername($_POST['username']);
			
			if(isset($person->password)){
				if($person->password == $_POST['password']){
					
					$_SESSION['username'] = $_POST['username'];
					header("Location: $s_url");
					die();
				
				}else{
					
					$_SESSION['erer'] = "wrong password";
					header("Location: $f_url");
					die();
				
				}
			}else
			if(!isset($person)){
				
				$_SESSION['erer'] = "user Name Not found";
				header("Location: $f_url");
				die();
			}else{
				$_SESSION['username'] = $_POST['username'];
				header("Location: $s_url");
				die();
			}
		}
	}
	if (!isset($_SESSION['username'])){
		header("Location: $f_url");
		die();
		//$_SESSION['erer'] = "No user name";// Redirecting To Home Page
		//die();
	}
}
function assertAdmin() {
	if ( !isset($_SESSION['username']) ) {
		assertLoggedIn($_SERVER['DOCUMENT_ROOT'] . "/admin/admin_dashboard.php",$_SERVER['DOCUMENT_ROOT'].'/admin');
	}
	$person = Person::getByUsername($_SESSION['username']);
	if($person->role != Person::ROLE_ADMIN){
		header("Location:" . $_SERVER['DOCUMENT_ROOT'] . "/"); // Redirecting To Home Page
		//die();
	}
}


if(isset($_SESSION['erer'])){
	echo $_SESSION['erer'];
}
?>