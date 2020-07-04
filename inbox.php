<html>
<head>
  <link rel='stylesheet' type='text/css' href='inbox.css'>
  <script src="payScript.js"></script>
</head>
<body>

<?php
session_start();
include "config.php";
include "loggedin.php";
$cuser = $_SESSION['username'];


//confirmation action
if(isset($_POST['cnfrm'])) {
  $cprod = $_POST['prod'];
  //$sql = "SELECT * FROM seller WHERE sales='1' AND username='$cuser' AND prodId='$cprod'";
  $sql = "UPDATE seller SET confirmation='true' WHERE sales=true AND username='$cuser' AND prodId = '$cprod'";
  if((mysqli_query($conn,$sql))) {
    //echo "done";
    header('location:home.php');
  }
  else {
    echo $conn->error;
  }
}

//to show messages on a inbox for both seller as well as bidder
$sqlcheck = "SELECT * FROM seller WHERE status='finished' AND confirmation='false'";
$r = mysqli_query($conn, $sqlcheck);
while($c = mysqli_fetch_assoc($r)) {
  //cuser --> seller 
  if($cuser == $c['username']) {
    //echo "inn";
    $sqlSeller  = "SELECT * FROM seller WHERE username='$cuser' AND sales=true AND confirmation='false'";
    $r = mysqli_query($conn,$sqlSeller);
    while($rr = mysqli_fetch_assoc($r)) {
    ?>
      <div class='report'>
        <h1 class="heading"><?php echo $rr['msgS']; ?></h1>
        <div id='rimg'><?php echo "<img src='data:image/jpeg;base64,".base64_encode($rr['img'])."' width='200px' height='200px'>"; ?></div>
          <form method='post' action=''>
          <p class='details'>Product ID : <input name='prod' type='text' readonly style='border:none; font-size: 20px; border-bottom-color: transparent; background-color: transparent;' value="<?php echo $rr['prodId']; ?>">
           <p class="details">Biddername : <?php echo $rr['biddername']; ?></p>
           <p class="details">Bid Amount : <?php echo $rr['hbidamt']; ?></p>
           <input class='cnfrm' name='cnfrm' type='submit' value='CONFIRM'></form>
            
      </div>      
      
    <?php
    }
  }

  //cuser -> bidder
  else if($cuser == $c['biddername']) {
    //echo "in";
    

$sqlSelect = "SELECT * FROM seller WHERE biddername='$cuser' AND sales=false AND confirmation='false'";
$r = mysqli_query($conn,$sqlSelect);
while($rr = mysqli_fetch_assoc($r)) {                    
  $_SESSION['prodId'] = $rr['prodId'];
  $cprod = $rr['prodId'];
  $sqluser = "SELECT gpayname,gpaymail FROM registerdetails WHERE username=(SELECT username from seller where prodId='$cprod')";
    $ru = mysqli_query($conn,$sqluser);
    $fu = mysqli_fetch_assoc($ru);
?>
<br>
<div class="card">
<?php echo "<img src='data:image/jpeg;base64,".base64_encode($rr['img'])."' style='width:100%''>"; ?>
<h1><?php echo $rr['prodId']; ?></h1>
<h3><?php echo $rr['username']; ?></h3>
<!--<input type='number' readonly id='price' value="<?php //echo $rr['bidamt']; ?>">-->
<?php echo "<input type='number' id='priceamt' readonly value='".$rr['hbidamt']."'>"; ?>
<p><?php echo $rr['msgB']; ?></p>
<p>Google Pay</p>
<p>NAME : <?php echo $fu['gpayname']; ?></p>
<p>MAIL : <?php echo $fu['gpaymail']; ?></p>
<div id='checkout'><button id='buyButton'>Checkout</button></div>
</div>
<?php 
}
?>

<?php
  }
}

?>
</body>
</html>