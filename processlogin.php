<?php
include "config.php";
if(isset($_POST['submit'])) {
	$usr = $_POST['username'];
	$psw = $_POST['psw'];

	$user_check = "SELECT * FROM registerdetails WHERE username='$usr' LIMIT 1";

	$results = mysqli_query($conn,$user_check);
	$authenticate = mysqli_fetch_assoc($results);
	if($authenticate['username'] === $usr && $authenticate['password'] === $psw) {
		session_start();
		$_SESSION['username']=$usr;
		$_SESSION['mail'] = $authenticate['email'];
		header('location:home.php');
	}
	else {
		header('location:index.php');
	}
}
?>
