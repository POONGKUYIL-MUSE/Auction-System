<?php
session_start();
$cuser = $_SESSION['username'];
$cprod = $_SESSION['prodId'];
include "config.php";
include "loggedin.php";

if(isset($_POST['redirect'])) {

$sql = "UPDATE seller SET sales=true WHERE prodId='$cprod'";
if(mysqli_query($conn,$sql)) {
	header('location:home.php');
}
else {
	echo "wrong --> ".$conn->error;
}


}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Successful Payment</title>
	<style>
		input[type=submit] {
			background-color: black;
			color: white;
			border: none;
			width: 500px;
			height: 100px;
			font-size: 20px;
			margin: 200px 500px;
			cursor: pointer;
		}
	</style>
</head>
<body>

<form action='' method='post'><input type='submit' name='redirect' value='Successfully Paid. Redirect to Home Page'></form>
</body>
</html>