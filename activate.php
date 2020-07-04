<?php
	include "config.php";
	if(!empty($_GET["id"])) {
	$query = "UPDATE registerdetails set status = 'active' WHERE id='" . $_GET["id"]. "'";
	$result = mysqli_query($query);
		if(!empty($result)) {
			$message = "Your account is activated.";
		} else {
			$message = "Problem in account activation.";
		}
	}
?>