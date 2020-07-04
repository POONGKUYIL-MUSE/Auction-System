<?php
$conn = new mysqli('localhost','root','','auction');
if($conn->connect_error) {
	die('not connected to db');
}
else {
	//echo "connected";
}
?>