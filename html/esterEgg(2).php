<?php $maxpersent = $_GET["max"];?>

<html>
	<head>
		<title></title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				<?php for( $i = 1; i <= 10; $i += 1){ ?>
				$(".text").append(<?php echo $maxpersent?>)
			<?php } ?>
			});
		</script>


	</head>
	<body>
		<form method="get">
		<input type="num" name="max" />
		
		</form>
		<h1>
			persent
		
		</h1>
		<p class="text">
		</p>
	
	</body>
</html>