<?php
$conn = new mysqli('localhost','root','','auction');
if($conn->connect_error) {
	die('could not connect');
}
else {
//	echo "conn";
}


$sql = "select * from seller";
$res = mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($res)){
	$startdate = $row['startdate'];
	$starttime = $row['starttime'];
	$enddate = $row['enddate'];
	$endtime = $row['endtime'];
}

echo $startdate." ".var_dump($startdate);
$smon = substr($startdate,5,2);

echo $smon." ".$sday." ".$syr;



/*
date_default_timezone_set('Asia/Kolkata');
$days = date('d')+$duration;
$mon = date('M');
//echo "<br>".$duration."<br>";
//echo $days."<br>".date('M')."<br>";
//echo date('M')." $days ".date('Y H:i:s');
echo "<script>
var countDownDate = new Date('".$mon." ".$days.", 2019 00:00:00').getTime();
</script>";
*/
?>
<!--<script>
//document.write('<br>Date js : ' + countDownDate);
var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
document.getElementById('demo').innerHTML = '<br>'+days + 'd ' + hours + 'h '
  + minutes + 'm ' + seconds + 's ';
if (distance < 0) {
	clearInterval(x);

    //document.getElementById('demo').innerHTML = 'EXPIRED';
}
},1000);
</script>
<html>
<body>
	<div id="demo"></div>
</body>
</html>-->