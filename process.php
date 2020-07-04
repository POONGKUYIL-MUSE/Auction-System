<?php
include "config.php";
if(isset($_POST['submit'])) {
	$usr = $_POST['username'];
	$email = $_POST['email'];
	$psw = $_POST['psw'];
	$mbl = $_POST['mobile'];

	$sql = "INSERT INTO registerdetails (username,email,mobile,password,age,address,city,state,country,gpayname,gpaymail) VALUES ('$usr','$email','$mbl','$psw',0,'','','','','','')";
	$user_check = "SELECT * FROM registerdetails WHERE email='$email' LIMIT 1";

	$results = mysqli_query($conn,$user_check);
	$authenticate = mysqli_fetch_assoc($results);
	if($authenticate['username'] === $usr && $authenticate['email'] === $email) {
		echo "<script>
		window.alert('registered already'); 
		window.location.assign('index.php'); </script>";
	}
	else {
		$insRes = mysqli_query($conn,$sql);
		if(!empty($insRes)) {
		//if($conn->query($sql) === TRUE) {
			//user activation email 
			//$actualLink = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=".$insRes;
			/*$toEmail = $email;
			$subject = "Online Auction Account Activation";
			//$content = "Click this Link <a href='".$actualLink."'>".$actualLink."</a>";
			$content = "mycontent";
			$mailHeaders = "From: onlineauctionmuse@gmail.com \r\n";
			$mailHeaders .= "MIME-Version 1.0\r\n";
			$mailHeaders .= "Content-type: text/html\r\n";
			if(mail($toEmail,$subject,$content,$mailHeaders)) {
				$message = "you registered the activation";
				$type = "success";
			}*/
			//unset($_POST);
				session_start();
				$_SESSION['username'] = $usr;
				$_SESSION['mail'] = $email;
				header('location:myprof.php');
		} else {
			echo "problem in registration :( ".$conn->error;
		}
		
	}
			//echo "inserted";
			//header('location:login.php');
			/*$sql = "INSERT INTO accountdetails (username, datetime) VALUES ('$usr',NOW())";
			if($conn->query($sql) === TRUE) {
				$sql = "CREATE TABLE $usr(sn int(11) auto_increment primary key, amount int(11), usetype varchar(50), datetime TIMESTAMP)";
				if($conn->query($sql) === TRUE) {
					$sql = "INSERT INTO $usr(amount, usetype, datetime) VALUES (100000, 'CREDIT', NOW())";
					if($conn->query($sql) === TRUE) {
						header('location:login.php');
					}
				}
			}*/
}
else {
	echo $mbl." ".$conn->error;
}
//	}
//}
?>
