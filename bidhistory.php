<?php
session_start();
include_once "loggedin.php";
include "config.php";


$cuser = $_SESSION['username'];
if(isset($_GET['cprod'])) {
	$cprod = $_GET['cprod'];

?>

<html>
<head><style>
body {
  background-color: #dcdde1;
}
button {
	border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 10%;
  font-size: 18px;
}
button:hover {
  opacity: 0.7;
}
.container {
	border: 2px solid #333;
	border-radius : 5px;
	/*margin-top : 40px;*/
	margin:40px 40px;
}
.title {
	color : white;
	background-color: #333;
	font-size : 40px;
	padding: 10px;
}
.dtable {
	font-size : 20px;
	padding: 10px;
}

</style></head>
<body>
<?php

	$seller = "SELECT * FROM seller WHERE prodId='$cprod'";
	$res = mysqli_query($conn,$seller);
	while($row = mysqli_fetch_assoc($res)){
		$sellername = $row['username'];
		$title = $row['title'];
		$sbamt = $row['sbamt'];
		$startdate = $row['startdate'];
		$enddate = $row['enddate'];
		$starttime = $row['starttime'];
		$endtime = $row['endtime'];
		$hbidname = $row['biddername'];
		$cprice = $row['hbidamt'];
	}
	
	//echo $sellername.$title.$stitle.$sbamt.$startdate."<br>";
	echo "<br><a href='description.php?cprod=".$cprod."'><button>Back</button></a>
	<div class='container'><div class='title'>
	History For ".$title."</div><div>
	<table border='0' class='dtable'>
	<tr align='left'><th>Current Price</th><td>".$cprice."</td></tr>
	<tr align='left'><th>Starting Price</th><td>".$sbamt."</td></tr>
	<tr align='left'><th>Start Date/Time</th><td>".$startdate.$starttime."</td></tr>
	<tr align='left'><th>End Date/Time</th><td>".$enddate.$endtime."</td></tr>
	<tr align='left'><th>Seller</th><td>".$sellername."</td></tr>
	<tr align='left'><th>High Bidder</th><td>".$hbidname."</td></tr>
	</table>
	</div><hr>
	<div>
	<table border='0' width='100%' class='dtable'>
	<tr><th width='33.33%'>Date/Time</th>
	<th width='33.33%'>Username</th>
	<th width='33.33%'>Bid</th></tr>";

	if($sellername == $cuser) {
		$activebid = "SELECT * FROM activebid WHERE prodId='$cprod' ORDER BY bidamt DESC";
	}
	else {
		$activebid = "SELECT * FROM activebid WHERE prodId='$cprod' AND user='$cuser' ORDER BY bidamt DESC";
	}

	//$activebid = "SELECT * FROM activebid WHERE prodId='$cprod' ORDER BY bidamt DESC";
	$res = mysqli_query($conn,$activebid);
	while($row = mysqli_fetch_assoc($res)) {
		//echo $row['user']." ".$row['bidamt']." ".$row['bidtime']."<br>";
		echo "
		<tr align='center'><td>".$row['bidtime']."</td>
		<td>".$row['user']."</td>
		<td>".$row['bidamt']."</td></tr>";
	}
	echo "</table></div></div>";

}
?>
</body>
</html>
