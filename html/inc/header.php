
<header>
<?php
if(isset($_SESSION['username'])){
	$person = Person::getByUsername($_SESSION['username']);
?>
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-md-3">
			LOGO
		</div>
		<div class="hidden-xs hidden-sm col-md-6 text-center">
			TITLE
		</div>
		<div class="col-xs-6 col-md-3 text-right">
			Hello <?php echo $person->name ?>!<br/>
			<a href = "/logout.php">log out</a>	
		</div>
	</div>
</div>
<?php
}	
?>

</header>