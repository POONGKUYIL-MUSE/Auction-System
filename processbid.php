<?php
session_start();
$cuser = $_SESSION['username'];
include "config.php";

$cprodId='';

if(isset($_GET['cprodId'])) {
	$cprodId = $_GET['cprodId'];
}

$sellerCheck = "SELECT username FROM seller WHERE prodId='$cprodId'";
$rsc = mysqli_query($conn,$sellerCheck);
while($r = mysqli_fetch_assoc($rsc)) {
	$checked = $r['username'];
}

//checking for the bidder not to be a seller
if($cuser!=$checked) {

	if(isset($_POST['bidbtn'])){
	$bidamt = $_POST['bidamt'];
	}

	$sql = "INSERT INTO activebid (prodId,user,bidamt,bidtime) VALUES ('$cprodId','$cuser','$bidamt',NOW())";
	if(mysqli_query($conn,$sql)) {
		//header("location:description.php?cprod=$cprodId");	
		//$cprice = "SELECT MAX(bidamt),user FROM activebid WHERE prodId='$cprodId' ";
		$cprice = "SELECT * FROM activebid WHERE bidamt = ( SELECT MAX(bidamt) FROM activebid WHERE prodId='$cprodId')";
		$rcprice = mysqli_query($conn,$cprice);
		while($row = mysqli_fetch_assoc($rcprice)) { 
			$hbidamt = $row['bidamt'];
			$huser = $row['user'];
			$sbamt = $row['bidamt']+1;
		}
		$updcprice = "UPDATE seller SET sbamt='$sbamt',hbidamt='$hbidamt',biddername='$huser' where prodId='$cprodId'";
		if(mysqli_query($conn,$updcprice)) {
			header("location:description.php?cprod=$cprodId");
		} else {
			echo "<script>alert('your bidding amount cannot be updated due to some technical issues');</script>";
			echo "<script>location.replace('description.php?cprod=$cprodId');</script>";
		}
	}
	else {
		die('could not insert');
		echo "<script>alert('your data cannot be inserted due to some technical issues');</script>";
		echo "<script>location.replace('description.php?cprod=$cprodId');</script>";
	}
//echo $cprodId." ".$bidamt." ".$cuser;

}//end of the seller check 
else {
	echo "<script>alert('Seller itself cannot bid on their product');</script>";
	echo "<script>location.replace('description.php?cprod=$cprodId');</script>";
}


?>