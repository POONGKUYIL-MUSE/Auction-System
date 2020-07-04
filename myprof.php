<?php
session_start();
include "config.php";
include_once "loggedin.php";
$cuser = $_SESSION['username'];
$mail = $_SESSION['mail'];
?>

<html>
<head>
<style>
body {
  background-color: #dcdde1;
}
</style>
</head>
<body>

<?php
$sqlcheck = "SELECT * FROM registerdetails WHERE username='$cuser' AND email='$mail'";
$r = mysqli_query($conn,$sqlcheck);
while($f = mysqli_fetch_assoc($r)) {
echo "<form action='profprocess.php'>
	<hr>
	<h2>Personal Details</h2>
	Account Name : ".$f['username']."<br>
	Email name : ".$f['email']."<br>
	Age : ".$f['age']."<br>
	Mobile Number : ".$f['mobile']."<br>
	Residential Address : ".$f['address']."</textarea><br>
	City : ".$f['city']."<br>
	State : ".$f['state']."<br>
	Country : ".$f['country']."<br>
	<hr>
	<h2>Account Details</h2>
	Google Pay Account Name : ".$f['gpayname']."<br>
	Google Pay Mail name : ".$f['gpaymail']."<br>
	<hr>
	<input type='submit' value='EDIT' name='profSubmit'>
	<hr>
</form>";	
}
?>

</body>
</html>