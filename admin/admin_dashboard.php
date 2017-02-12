<?php
	require_once  $_SERVER['DOCUMENT_ROOT'] . '/inc/globals.php';
	assertAdmin();
	$person = Person::getByUsername($_SESSION['username']);
?>
<html>
	<head>
		<?php include_once ($_SERVER['DOCUMENT_ROOT'] . "/inc/comhead.php"); ?>
		<title>dashboard</title>
	</head>
	<body>
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php"?>
	<div class="container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">person</a></li>
			<li><a data-toggle="tab" href="#catagory">category</a></li>
			<li><a data-toggle="tab" href="#task">task</a></li>
			<li><a data-toggle="tab" href="#activity">activity</a></li>
		</ul>
		<br/>
		<div class="tab-content">
			<div id="home" role="tabpanel" class="active tab-pane">
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/admin/admin_person.php"?>
			</div>
			<div id="catagory" role="tabpanel" class="tab-pane">
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/admin/admin_category.php"?>
			</div>
			<div id="task" role="tabpanel" class="tab-pane">
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/admin/admin_task.php"?>
			</div>
			<div id="activity" role="tabpanel" class="tab-pane">
			</div>
		</div>
			
	</div>
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php"?>
</body>	
</html>