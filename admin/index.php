<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/globals.php';
?>
<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/comhead.php"; ?>
		<title>sign-in</title>
	</head>
	<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php"; ?>
		<form action="/admin/admin_dashboard.php" id="signInForm" method="post">
<?php
	$people = Person::getAll();
	foreach ($people as $person ){ 
		if ($person->role == Person::ROLE_ADMIN) {	
			echo '<div class = "longInBtnWrapper password">';
			echo'<lable class="sigin_lable"> password for  '. $person -> name.'</lable>';
			echo'<input type="password" required name = "password">';
			echo '<button style="background-color: #'. $person->color. '; " ser ="inputAfterText" name="username" type="submit" value="' .  $person->username . '"> sign-in </button>';
			echo '</div>';
		}
	}
?>
		</form>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php"; ?>
	</body>
</html>