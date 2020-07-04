<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	
		body {
  			background-color: #dcdde1;
		}
		.container {
			margin: 40px 40px;
		}
		button {
			border: none;
			outline: 0;
			padding: 12px;
			color: white;
			background-color: #000;
			text-align: center;
			cursor: pointer;
			width: 20%;
			font-size: 18px;
		}
		button:hover {
			opacity: 0.7;
		}
		hr{
			overflow: visible;
			padding: 0;
			border: none;
			border-bottom: medium solid silver;
			color: grey;
			text-align: center;
		}
		hr:after {
			content: '';
			display: inline-block;
			position: relative;
			top: -0.7em;
			font-size: 1.5em;
			padding: 0 0.25em;
			background: white;
		}
		h3 {
			color: red;
			font-family: 'Century Schoolbook';
		}
		input[type=text] {
			padding: 10px;
			width: 100%;
			font-size: 20px;
			font-family: Raleway;
			border-radius: 1px soldi #aaaaaa;
		}
		input.invalid{
			background-color: #ffdddd;
		}
		#response {
			color: green;
			font-size: 20px;
			font-family: Raleway;
		}
		#hbid {
			color: indigo;
			font-family: Raleway;
			font-size: 40px;
		}
		a{
			text-decoration: none; 
			color: indigo;

		}
	</style>
	<script src="payScript.js"></script>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['username'])) {
include_once "loggedin.php";
include "config.php";

$startdate = $starttime = $enddate = $endtime = '';

//$sql = "select * from seller where status = 'active'";


$cuser = $_SESSION['username'];
if(isset($_GET['cprod'])){
	$cprod = $_GET['cprod'];


	//Extracting max bid amount of current user 
	$userhb = "SELECT MAX(bidamt) FROM activebid WHERE user='$cuser' AND prodId='$cprod'";
	$r = mysqli_query($conn,$userhb);
	while($rr = mysqli_fetch_assoc($r)) {
		$myhb = $rr['MAX(bidamt)'];
	}
	
	$sql = "SELECT * FROM seller WHERE prodId = '$cprod'";
	$result = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($result)) {
		/*echo "<table border='1'><tr>
		<td rowspan='3'><img src='data:image/jpeg;base64,".base64_encode($row['prodImg'])."' width='350' height='350'/></td>
		<td><h1><font color='brown'>".$row['prodName']."</font></h1></td></tr><tr><td>".$row['prodCost']."</td></tr><tr><td>".$row['prodDesc']."
		</table>";*/

		//if($row['sbamt']!=0){
			echo "<br><a href='home.php'><button>Back</button></a>
			<br>
			<div class='container'><table border='0' cellspacing='30' width='100%'><tr>
			<td width='30%'><img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='350' height='350' style='border:border-box;'/></td>
			<td width='100%'>
			<table border='0' width='100%' height='100%'>
			<tr><td colspan='2'><h1>".$row['title'].
			"</h1><h2>".$row['subtitle']."</h2><!--<span style='float:right;'>".$row['status']."</span>--><hr></td></tr>
			<tr><td width='50%'>
			<div><h3>Current Price : ".$row['hbidamt']."/-</h3></div>	
			<div><h3>Your Maximum Bid ".$myhb."/-</h3></div>
			<form method='post' action='processbid.php?cprodId=".$row['prodId']."'>
			<input type='number' id='bidamt' name='bidamt' min='".$row['sbamt']."'>&nbsp;&nbsp;&nbsp;<button id='bidbtn' name='bidbtn'>BID</button><br><span>Your minimum bid amount is ".$row['sbamt']	."</span>
			</form>
			<div id='response'></div>
			</td><td>
			<div id='hbid'>Highest Bidder : </div><br>
			<a href='bidhistory.php?cprod=".$row['prodId']."'>BID HISTORY</a>

			</td></tr></table></table>

			<table width='100%'>
			<tr><td width='50%'><h3>Details</h3>
			<div><b>Product ID : </b>".$row['prodId']."</div>
			<div><b>Product Owner : </b>".$row['username']."</div>
			<div><b>Start Date and Time : </b>".$row['startdate']." ".$row['starttime']."</div>
			<div><b>End Date and Time : </b>".$row['enddate']." ".$row['endtime']."</div>
			</td>
			<td><div><h3>Description</h3></div>
			<div>".$row['description']."</div>
			</td></tr>
			</table></div>";
			//echo $row['prodName'];
			//echo $row['prodDesc'];
			//echo $row['prodCost'];
		/*}
		else {
			echo "<br><a href='home.php'><button>Back</button></a>
			<br>
			<div class='container'><table border='1' cellspacing='30' width='100%'><tr>
			<td width='30%'><img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='350' height='350' style='border:border-box;'/></td>
			<td width='100%'>
			<table border='1' width='100%' height='100%'>
			<tr><td colspan='2'><h1>".$row['title'].
			"</h1><h2>".$row['subtitle']."</h2><!--<span style='float:right;'>".$row['status']."</span>--><hr></td></tr>
			</table>
			<table border='1' width='100%'>
			<tr><td width='80%'><h4>Amount for single piece : ".$row['fixedamt']."</h4>
			<h4>Available items : <span id='avail'>".$row['quan']."</span></h4>
			<h4>How much you need : <input type='number' id='quan' value='".$row['quan']."'></h4></td>
			<td><div id='checkout'><button id='buyButton'>Checkout</button></div></td></tr>
			</table>                                      
			<table width='100%' border='1'>
			<tr><td width='50%'><h3>Details</h3>
			<div><b>Product ID : </b>".$row['prodId']."</div>
			<div><b>Product Owner : </b>".$row['username']."</div>
			</td>
			<td><div><h3>Description</h3></div>
			<div>".$row['description']."</div>
			</td></tr>
			</table></div>";
		}*/
	}




	$sql1 = "SELECT * FROM seller WHERE prodId = '$cprod'";
	$res = mysqli_query($conn,$sql1);
	while($row1=mysqli_fetch_assoc($res)){
		$startdate = $row1['startdate'];
		$starttime = $row1['starttime'];
		$enddate = $row1['enddate'];
		$endtime = $row1['endtime'];
	}
	date_default_timezone_set('Asia/Kolkata');
	$smon = substr($startdate,5,2);
	$sday = substr($startdate,8,2);
	$syr = substr($startdate,0,4);
	$emon = substr($enddate,5,2);
	$eday = substr($enddate,8,2);
	$eyr = substr($enddate,0,4);
	$ehr = substr($endtime,0,2);
	$emin = substr($endtime,3,2);
	$esec = substr($endtime,6,2);
	//echo "<br>".$duration."<br>";
	//echo $days."<br>".date('M')."<br>";
	//echo date('M')." $days ".date('Y H:i:s');
	echo "<script>
	var clear = '';
	var countDownDate = new Date('".$emon." ".$eday.", ".$eyr." ".$ehr.":".$emin.":".$esec."').getTime();
	var x = setInterval(function() {
	var now = new Date().getTime();
	var distance = countDownDate - now;
	var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	document.getElementById('response').innerHTML = '<b> Remaining Time : ' + days + 'd ' + hours + 'h '
	  + minutes + 'm ' + seconds + 's ';
	if (distance < 0) {
		clearInterval(x);
	    document.getElementById('response').innerHTML = 'EXPIRED';
	    document.getElementById('bidbtn').disabled = true;
	    document.getElementById('bidamt').disabled = true;
	}
	},1000);</script>";
}

} //eof session
else {
	echo "<script>alert('Not a Proper login');</script>";
	header("location:index.php");
}

?>

</body>
</html>