<?php
//count checker code
include "config.php";
session_start();
$cuser = $_SESSION['username'];

$sqlcheck = "SELECT * FROM seller WHERE status='finished'";
$r = mysqli_query($conn, $sqlcheck);
while($c = mysqli_fetch_assoc($r)) {
	//cuser --> seller

	if($cuser == $c['username']) {
		$sqlSelect = "SELECT COUNT(prodId) AS c FROM seller WHERE status='finished' AND username='$cuser' AND sales=true AND confirmation='false'";
		$res = mysqli_query($conn,$sqlSelect);
		while($row = mysqli_fetch_assoc($res)) {
			if($row['c'] != 0) { echo $row['c']."ss//";
			}
			
		}
	}
	//cuser -> bidder
	else if( $cuser == $c['biddername']) {
		$sqlSelect = "SELECT COUNT(hbidamt) AS c FROM seller where status='finished' AND biddername='$cuser' AND sales=false AND confirmation='false'";
		$res = mysqli_query($conn,$sqlSelect);
		while($row = mysqli_fetch_assoc($res)) {	
			if($row['c'] != 0) { echo $row['c']."dd//";
			 }
		}
	}

}

?>