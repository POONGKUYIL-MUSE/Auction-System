<?php
session_start();
if(isset($_SESSION['username'])) {
include_once "loggedin.php";
//include_once "sample.php";
include "config.php";

?>

<html>
<head>

<style>
body {
	/*background-image: url("img/pattern6.jpg");
	height: 100%;
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover;
	background-blend-mode:lighten;*/
	background-color: #dcdde1;
}
	a{
		text-decoration:none;
		font-size: 23px;
	}
	.container {
		/*box-shadow: 0 4px 8px 0 rbga(0,0,0,0.2);
		max-width: 300px;
		margin: auto;
		text-align: center;*/
		margin:auto;

	}
	.stitle {
		font-size: 18px;
	}
	.price {
		color:red;
		font-size: 16px;
	}
	.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  /*margin: auto;*/

  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
</head>
<body>
		<div class="container">
<?php
	$sql3 = "SELECT * from seller";
    $result = mysqli_query($conn,$sql3);
    if(!$result) {
    	die('could not load the image');
    }
    while($row = mysqli_fetch_assoc($result)) {
?>
<div class="col-sm-3">
<table class='card' border='0' style='float:left; margin:20px; width: 500; height: 500;'>
		<tr><td colspan='2'>
		<a href='description.php?cprod=<?php echo $row["prodId"] ?>'>
    	<?php echo "<img src='data:image/jpeg;base64,".base64_encode($row['img'])."' width='250' height='250'/>"; ?></a></td></tr>
		<tr><td colspan='2'><a href='description.php?cprod=<?php echo $row["prodId"]; ?>'><?php echo $row['title']; ?></a></td></tr>
			<tr><td class="stitle">CURRENT BID</td><td class="stitle">STATUS</td></tr>
		<tr><td class="price">Rs. <?php echo $row['hbidamt']; ?></td><td><div id='statusshow' class="time"><?php echo $row['status']; ?></div></td></tr>
		<script>
			setInterval(function() {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open('GET','updater.php',false);
				xmlhttp.send(null);
				document.getElementById('statusshow').innerHTML = xmlhttp.responseText;

				
			},1000);

		</script>
		
	</table>
	</div>
<?php 
}
}
else {
	echo "<script>alert('Not a Proper login');</script>";
	header("location:index.php");
}
?>
</div>
</body>
</html>