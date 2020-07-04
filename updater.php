<?php
session_start();
$cuser = $_SESSION['username'];
include "config.php";
$title = $img = $status = $startdate = $enddate = $starttime = $endtime = '';

//current time
date_default_timezone_set('Asia/Kolkata');
$cdate = date('Y-m-d');
$ctime = date('H:i');

 $sql = "SELECT * from seller";
    $result = mysqli_query($conn,$sql);
    if(!$result) {
    	die('could not load the record');
    }
    while($row = mysqli_fetch_assoc($result)) {
    	$prodId = $row['prodId'];
    	$sellername = $row['username'];
    	$biddername = $row['biddername'];
    	$bidamt = $row['hbidamt'];
		$title = $row['title'];
		$status = $row['status'];
		$startdate = $row['startdate'];
		$enddate = $row['enddate'];
		$starttime = $row['starttime'];
		$endtime = 	$row['endtime'];
	
		//checking for the status of the product
		//status - yet
		if($startdate > $cdate && $enddate > $cdate) {
			$status = 'yet';
			//echo "in1";
		} 
		//staus - finished
		if($enddate < $cdate && $startdate < $cdate) {
			$status = 'finished'; 
			//echo "in2";
		}
		//status - active
		if($startdate < $cdate && $enddate > $cdate) {
			$status = 'active'; 
			//echo "in3";
		}
		else if($startdate == $cdate && $enddate > $cdate) {
			if($starttime > $ctime) { $status = 'yet'; //echo "in4"; 
		}
			if($starttime < $ctime) { $status = 'active'; //echo "in4"; 
		}
		}
		else if($startdate == $cdate && $enddate == $cdate) {
			if($endtime < $ctime) { $status = 'finished'; //echo "in5";
		}
			if($endtime > $ctime) { $status = 'active';  //echo "in5";
		}
 		}
 		else if($startdate < $cdate && $enddate == $cdate) {
 			if($endtime < $ctime) { $status = 'finished';  //echo "in6";
 		}
			if($endtime > $ctime) { $status = 'active';  //echo "in6";
		}	
 	}

	//echo $status." ";
	$sql1 = "UPDATE seller set status='$status' where prodId = '$prodId'";
	if(mysqli_query($conn,$sql1)){
	}else {
		echo $conn->error;
	}
	/*if($status == 'finished') {
		$sql2 = "INSERT INTO finished(prodId,sellername,biddername,bidamt) VALUES('$prodId','$sellername','$biddername','$bidamt')";
		if(mysqli_query($conn,$sql2)) {} else {echo $conn->error;}
	}*/

	//alert notifications
	/*$sqlalert = "SELECT * FROM seller WHERE status='finished'";
	if($res = mysqli_query($conn,$sqlalert)) {
		while($row = mysqli_fetch_assoc($res)) {
			$biddername = $row['biddername'];
		}
	}
	if($biddername == $cuser) {
		echo "same";
	}
	else {
		echo "not same";
	}*/
}
		/*$rsql = "SELECT * FROM seller";
		$res = mysqli_query($conn,$rsql);
		if(!$res) {
			die("smtng wrong");
		}
		while($r = mysqli_fetch_assoc($res)) {
			echo $r['status'].
			"<br>";
		}*/





?>