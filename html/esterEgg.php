<?php 
	$max = $_GET["max"];
	$num = $_GET["num"];
	if($num > $max){
		$num = $max; 
	}
$percent =($num/$max)*100
?>
<html>
	<head>
	<title>percent cal</title>
	</head>
	<body>
		<form method="get">
		<input type="number" name="max" value ="<?php echo $max ?>"/><p style="display:inline">1-9000000000<br /></p>	
		<input type="number" name="num" value ="<?php echo $num ?>"/><p style="display:inline">1-<?php echo $max; ?><br /></p>
			<br />
		<input type="submit"/>
		</form>
<?php
		echo " crent num = $num <br />". "max num = $max <br />";
		echo " num =" .$percent ."%";
		
?>
			<progress value=" <?php echo $num ?> " max=" <?php echo $max ?>"> </progress>
	</body>
</html>