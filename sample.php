<?php
include "config.php";

if(isset($_POST['sub'])) {
	echo $_POST['demo'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method='post' action=''>
	<input type="text" name='demo'> hi </p>
	<input type='submit' name='sub' value='sub'>
</form>
</body>
</html>