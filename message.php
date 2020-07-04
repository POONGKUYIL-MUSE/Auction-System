<?php
//session_start();
//$cuser = $_SESSION['username'];
include "config.php";

$msgS = "Hurray! You have been paid for a product. Check out your account";
$msgB = "Hurray! Your the Higgest Bidder. ";
$sales = "false";

$sqlSelect = "SELECT * FROM seller WHERE status='finished' AND listtype='auction'";
$res = mysqli_query($conn,$sqlSelect);
while($row = mysqli_fetch_assoc($res)) {
	$prodId = $row['prodId'];
	$sellername = $row['username'];
	$biddername = $row['biddername'];
	$bidamt = $row['hbidamt'];
	$img = $row['img'];
	$imgContent = addslashes($img);
	//$img = $row['img'];
}

$sqlSel = "SELECT * FROM registerdetails where prodId='$prodId' and sellername='$sellername' and biddername='$biddername'";
$res = mysqli_query($conn,$sqlSel);
$row = mysqli_fetch_assoc($res);

//neglecting the similar records
if( $prodId != $row['prodId'] AND $sellername != $row['sellername'] AND $biddername != $row['biddername']) {
$sqlUpd = "INSERT INTO finished(prodId, sellername, biddername, bidamt, msgS, msgB, sales,img) VALUES ('$prodId','$sellername','$biddername','$bidamt','$msgS','$msgB','$sales','$imgContent')";
if(mysqli_query($conn,$sqlUpd)) {
echo "done";
}
else {
	echo "Error in insertion due to ==>> ".$conn->error;
}
}
else {
	echo "wrong".$conn->error;
}
//echo "hi";
/*
inbox table:
sn
prodid
sellername
biddername
msgSeller - fdmd
msgBidder
msgStatusS
msgStatusB
message 
 seller : 
   after bidder checkout
 bidder :
   asking for checkout (sellername, prodId, bidamt)
*/?>