<?php
	require_once '/inc/globals.php';
?>
<html>
	<head>
<?php include "/inc/comhead.php"?>
		<title>sign-in</title>
	</head>
	<body>
<?php include "/inc/header.php"?>
		<form action="dashboard.php" id="signInForm" method="post">
<?php
	$people = Person::getAll();
	//$debug = $people = Person::getByUsername("test");
	//var_dump($debug);
	foreach ($people as $person ){
		if ($person->role != Person::ROLE_ADMIN) {
			if(!isset($person -> password)||empty($person -> password)){
?>
				<div class="longInBtnWrapper">
					<button style= "background-color:#<?php echo $person->color;?> " name="username" type="submit" value="<?php echo $person->username;?>"><?php echo $person->name;?></button>
				</div>
<?php
			}else{
?>
			<div class = "longInBtnWrapper password">
				<lable class="sigin_lable"> password for  <?php echo $person -> name?></lable>
				<input type="password" name = "password">
				<button style="background-color: #'<?php echo $person->color;?>; " ser ="inputAfterText" name="username" type="submit" value="<?php echo $person->username ?>"> sign-in </button>';
			</div>
			<?php
			}
		}
	}
	
?>
		</form>
	<?php include "/inc/footer.php"?>
	</body>
</html>