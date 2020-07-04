<?php
include "config.php";
session_start();
$cuser = $_SESSION['username'];

if(isset($_POST['profSubmit'])) {

	$accname = $_POST['acname'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$age = $_POST['age'];
	$mbl = $_POST['mbl'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$gpayname = $_POST['gpayname'];
	$gpaymail = $_POST['gpaymail'];

	$sql = "UPDATE registerdetails SET username='$accname',email='$email',age='$age',mobile='$mbl',address='$address',city='$city',state='$state',country='$country',gpayname='$gpayname',gpaymail='$gpaymail' WHERE username = '$cuser'";
	if(mysqli_query($conn,$sql)) {
		header('location:home.php');
	}
	else {
		echo $conn->error;
	}
}

?>
<html>
 <head>
        <title>Editing Profile</title>
        <link rel="stylesheet" href="uikit/css/uikit.min.css" />
       <!-- <script src="uikit/js/jquery.js"></script> -->
        
        <!-- Jquery JS File -->
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
        <!-- UI KIT JS File -->
        <script src="uikit/js/uikit.min.js"></script>
        <script src="uikit/js/uikit-icons.min.js"></script>     
</head>
<body>

<?php
$sqlcheck = "SELECT * FROM registerdetails WHERE username='$cuser'";
$r = mysqli_query($conn,$sqlcheck);
while($f = mysqli_fetch_assoc($r)) {
echo "<div class='uk-child-width-1-3@m uk-grid-small uk-grid-match' uk-grid>
    <div></div><div>
	<form action='' method='post'>
	<hr>
	<h2>Personal Details</h2>
	<div class='uk-margin'>Account Name : <input type='text' name='acname' required value='".$f['username']."' class='uk-input' ></div><br>
	<div class='uk-margin'>Email name : <input type='email' name='email' required value='".$f['email']."' class='uk-input' ></div><br>
	<div class='uk-margin'>Age : <input type='number' name='age' class='uk-input' value='".$f['age']."' ></div><br>
	<div class='uk-margin'>Mobile Number : <input type='number' name='mbl' required value='".$f['mobile']."' class='uk-input' ></div><br>
	<div class='uk-margin'>Residential Address : <textarea name='address' cols='20' rows='5' value='".$f['address']."' ></textarea></div><br>
	<div class='uk-margin'>City : <input type='text' name='city' value='".$f['city']."' class='uk-input' ></div><br>
	<div class='uk-margin'>State : <input type='text' name='state' value='".$f['state']."' class='uk-input' ></div><br>
	<div class='uk-margin'>Country : <input type='text' name='country' value='".$f['country']."' class='uk-input' ></div><br>
	<hr>
	<h2>Account Details</h2>
	<div class='uk-margin'>Google Pay Account Name : <input type='text' name='gpayname' value='".$f['gpayname']."' required class='uk-input' ></div><br>
	<div class='uk-margin'>Google Pay Mail name : <input type='email' name='gpaymail' value='".$f['gpaymail']."' required class='uk-input' ></div><br>
	<hr>
	<input type='submit' value='SAVE' name='profSubmit' class='uk-button uk-button-primary'>
	<hr>
</form></div>
<div></div>
</div>";	
}
?>

</body>
</html>