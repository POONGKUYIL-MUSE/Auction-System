<?php
include "config.php";
session_start();
$currentUser = $_SESSION['username'];

//messages
$msgS = "Hurray! You have been paid for a product. Check out your account";
$msgB = "Hurray! Your the Higgest Bidder. ";
$sales = "false";


$digitNeeded = 6;
$randNo = '';
$count = 0;
while($count<$digitNeeded){
	$randomDigit = mt_rand(0,9);
	$randNo .= $randomDigit;
	$count++;
}
//$randoNo has the prod id

if(isset($_POST['submit'])) {

	//store general details in php varaibles
	$listing = $_POST['listing'];
	//$listtype = $_POST['listType'];
	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$desc = $_POST['description'];
	//getting the image
	$check = getimagesize($_FILES['img']['tmp_name']);
	if($check !== false) {
		$image = $_FILES['img']['tmp_name'];
		$imgContents = addslashes(file_get_contents($image));	//image is stored in $imgContents
	}

	//checking for auction type
	if(isset($_POST['sbamt']) && isset($_POST['bnamt'])) {
		$biddername = 'null';
		$bidamt = 0;
		$fixedamt = null;
		$quan = null;
		$startbid = $_POST['sbamt'];
		$bnamt = $_POST['bnamt'];
		$startdate = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$starttime = $_POST['starttime'];
		$endtime = $_POST['endtime'];

		//fetching current date and time
		date_default_timezone_set('Asia/Kolkata');
		$cdate = date('Y-m-d'); //2019/08/18
		$ctime = date('H:i');	//07:40:04

		//checking for the status of the product
		if($cdate < $startdate || $ctime < $starttime) {
			$status = 'yet';
		}
		else if($cdate = $startdate) {
			if($ctime < $starttime) {
				$status = 'yet';
			}
			else if($ctime = $starttime) {
				$status = 'active';
			}
			else {
				$status = 'active';
			}
		}
		else {
			$status = 'active';
		}
	}
/*
	//checking for stock item type
	if(isset($_POST['fixedamt']) && isset($_POST['fixedQuan'])) {
		$startbid = $bnamt = $startdate = $enddate = $starttime = $endtime = null;
		$fixedamt = $_POST['fixedamt'];
		$quan = $_POST['fixedQuan'];
		$bidamt = $_POST['fixedamt'];
		$biddername = 'null';
		$status = 'active';
	}*/

	//inserting into db
	$sql = "insert into seller (username,title,subtitle,description,listing,listtype,sbamt,bnamt,startdate,starttime,enddate,endtime,img,status,launchtime,prodId,biddername,hbidamt,msgS,msgB,sales,confirmation) values ('$currentUser','$title','$subtitle','$desc','$listing','auction','$startbid','$bnamt','$startdate','$starttime','$enddate','$endtime','$imgContents','$status',NOW(),'$randNo','$biddername','$bidamt','$msgS','$msgB','$sales','false')";

	if(mysqli_query($conn,	$sql)) {
		header('location:home.php');
	}
	else {
		echo $conn->error;
	}
}

?>