<?php
include "config.php";
session_start();
$currentUser = $_SESSION['username'];

$sb = $bnamt= '';
$biddername = 'null';
$bidamt = 0;

//random prod id generator
$digitNeeded = 6;
$randNo = '';
$count = 0;
while($count<$digitNeeded){
	$randomDigit = mt_rand(0,9);
	$randNo .= $randomDigit;
	$count++;
}
//$randoNo has the prod id

//store in php variables
if(isset($_POST['submit'])){
$listing = $_POST['listing'];
//$listtype = $_POST['listType'];
$title = $_POST['title'];
$subtitle = $_POST['subtitle'];
$desc = $_POST['description'];
$starttime = $_POST['starttime'];
$startdate = $_POST['startdate'];
$endtime = $_POST['endtime'];
$enddate = $_POST['enddate'];

//checking for listing type
if(isset($_POST['sbamt']) && isset($_POST['bnamt'])){
$startbid = $_POST['sbamt'];
$bnamt = $_POST['bnamt'];
//$fixedamt = null;
//$quan = null;
}

/*if(isset($_POST['fixedamt']) && isset($_POST['quan'])) {
$startbid = null;
$bnamt = null;
$startdate = null;
$enddate = null;
$starttime = null;
$endtime = null;
$fixedamt = $_POST['fixedamt'];
$quan = $_POST['quan'];	
$bidamt = $_POST['fixedamt'];
}
*/

//getting the image
$check = getimagesize($_FILES['img']['tmp_name']);
if($check !== false) {
	$image = $_FILES['img']['tmp_name'];
	$imgContents = addslashes(file_get_contents($image));	//image is stored in $imgContents
}

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


$sql = "insert into seller (username,title,subtitle,description,listing,listtype,sbamt,bnamt,startdate,starttime,enddate,endtime,img,status,launchtime,prodId,biddername,hbidamt) values ('$currentUser','$title','$subtitle','$desc','$listing','$listtype','$startbid','$bnamt','$startdate','$starttime','$enddate','$endtime','$imgContents','$status',NOW(),'$randNo','$biddername','$bidamt')";

if(mysqli_query($conn,	$sql)) {
	header('location:home.php');
}
else {
	echo $conn->error;
}


}


/*
echo $_POST['listing']."<br>";
echo $_POST['listType']."<br>";
echo $_POST['title']."<br>";
echo $_POST['subtitle']."<br>";
echo $_POST['description']."<br>";
echo $_POST['startbid']."<br>";
echo $_POST['bnprice']."<br>";
echo $_POST['fixedprice']."<br>";
echo $_POST['fixedQuan']."<br>";
echo $_POST['starttime']."<br>";
echo $_POST['startdate']."<br>";
echo $_POST['endtime']."<br>";
echo $_POST['enddate']."<br>";
*/


?>

