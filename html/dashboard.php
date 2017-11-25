<?php
	require_once '/inc/globals.php';
	assertLoggedIn();
	$person = Person::getByUsername($_SESSION['username']);
?>
<html>
	<head>
		<?php 
		include "/inc/comhead.php";	
		?>
		<title>dashboard</title>
	</head>
<body>
<?php include "/inc/header.php"?>
<?php
	echo "hello " . $person->name;
?>


<?php include "/inc/footer.php"?>
	
</body>	
</html>