<?php
//session_start();
//include_once "message.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="navbarStyle.css">
</head>
<body>
<header>
<nav>  
<ul class="nav">
<li><a href="home.php" id="defaultOpen">Home</a></li>
<li><a href="myprof.php">MyProfile</a></li>
<li><a href="myacc.php">MyAccount</a></li>
<li><a href="seller.php">SELL</a></li>
<li><a href="onauc.php">Ongoing Auction</a></li>
<li><a href="inbox.php">INBOX <span id="demo" style="color:white;"></span></a></li>
<li><span style='background-color: #546de5; color: white; float: left; margin-left: 400px; margin-right: 10px; font-size: 17px; display: block; text-align: center; padding: 14px 16px;'><?php echo $_SESSION['username']; ?></span></li>
<li><a href="logout.php" style="background-color: red; color: white; margin-left:10px; margin-right: 10px;">Logout</a></li>
</ul>
</nav>
</header>
<script>
setInterval(function(){
	var xmlhttp2 = new XMLHttpRequest();
					xmlhttp2.open('GET','inboxupdater.php',false);
					xmlhttp2.send(null);
					document.getElementById('demo').innerHTML = xmlhttp2.responseText;
},1000);
</script>
</body>
</html>
<?php
?>