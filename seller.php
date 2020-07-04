<?php
session_start();
if(isset($_SESSION['username'])) {
$cuser = $_SESSION['username'];
include_once "loggedin.php";
include "config.php";

//check for they have a gpay account
$sql = "SELECT gpayname,gpaymail FROM registerdetails WHERE username='$cuser'";
$r = mysqli_query($conn,$sql);
$rr = mysqli_fetch_assoc($r);
if($rr['gpayname'] != '' && $rr['gpaymail'] != '' ){
/*if(isset($_POST['submit'])) {
	$cuser = $_SESSION['username'];
	$prodName = $_POST['prodName'];
	$prodCost = $_POST['prodCost'];
	$prodDesc = $_POST['prodDesc'];
	
	$check = getimagesize($_FILES['prodImg']['tmp_name']);
	if($check !== FALSE) {
		$image = $_FILES['prodImg']['tmp_name'];
		$imgContent = addslashes(file_get_contents($image));
		
		$sql = "INSERT INTO seller(sellerName, prodName, prodCost, prodDesc, prodImg, timeOfSell) 
		VALUES ('$cuser','$prodName','$prodCost','$prodDesc','$imgContent',NOW())";
		if($conn->query($sql) === TRUE) {
			echo "done";
		}
		else {
			echo "undone".$conn->error;
		}
	}
	else {
		echo "pls select an image";
	}
}*/
?>

<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #dcdde1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}
/*
#subBtn {
	display : hide;
}*/

input[type=text] {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: red;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: red;
}
</style>

</head>
<body>

<form id="regForm" action="processSell.php" method='post' enctype='multipart/form-data'>
  
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
	<h1>Step1:</h1>
	<h3>Category : </h3>
	<div><select id="listing" name='listing' size='6'>
		<option value="DEMO_LISTING">DEMO LISTING</option>
		<option value="Art">Art</option>
		<option value="Antiques">Antiques</option>
		<option value="Automotives">Automotives</option>
		<option value="Baby">Baby</option>
		<option value="Books">Books</option>
		<option value="Business&Industrial">Business & Industrial</option>
		<option value="Cameras&Photo">Cameras & Photo</option>
		<option value="CellPhones">Cell Phones</option>
		<option value="Clothing&Shoes">Clothing & Shoes</option>
		<option value="Coins&Paper">Coins & Paper Money</option>
		<option value="Collectibles">Collectibles</option>
		<option value="Computers">Computers</option>
		<option value="ConsumerElectronics">Consumer Electronics</option>
		<option value="Crafts">Crafts</option>
		<option value="Dolls&Bears">Dolls & Bears</option>
		<option value="Dvd&Movies">DVDs & Movies</option>
		<option value="Entertainment">Entertainment</option>
		<option value="EverythingElse">Everything Else</option>
		<option value="Health&Beauty">Health & Beauty</option>
		<option value="Home&Garden">Home & Garden</option>
		<option value="Jewelry">Jewelry & Watches</option>
		<option value="Music">Music</option>
		<option value="MusicalInstruments">Musical Instruments</option>
		<option value="Poetry&Glass">Poetry & Glass</option>
		<option value="RealEstate">Real Estate</option>
		<option value="SpecialityServices">Speciality Services</option>
		<option value="SportingGood">Sporting Goods</option>
		<option value="SportsFanClub">Sports Fan Club</option>
		<option value="Stamps">Stamps</option>
		<option value="Tickets">Tickets</option>
		<option value="Toys&Hobbies">Toys & Hobbies</option>
		<option value="Travel">Travel</option>
		<option value="VideoGames">Video Games</option>
	</select>
	</div>
    <!--<p><input placeholder= "enter name..." oninput="this.className = ''" name="name"></p>-->
  	<!--<div style='border-color: red;'>
  		<p>Listing Type</p>
  		<input type='radio' name='listType' value='auction' oninput="document.getElementById('listfield1').style.display='show'; document.getElementById('listfield2').style.display='none'; document.getElementById('listfield3').style.display='show'; ">Auction
  		<input type='radio' name='listType' value='fixed' oninput="document.getElementById('listfield1').style.display='none'; document.getElementById('listfield2').style.display='show'; document.getElementById('listfield3').style.display='none'; ">Fixed Price
  	</div>-->
  </div>
  <div class="tab">
  	<h1>Step2:</h1><br>
    <!--<p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>-->
    <div>
    <h4>Standard Listing Fields</h4>
    <table border='0'><tr><th>Title</th><td><input type='text' name='title' ></td></tr>
    <tr><th>Subtitle</th><td><input type='text' name='subtitle'></td></tr>
    <tr><th>Description</th><td><textarea rows="8" cols="90" name='description'></textarea></td></tr></table>
	</div>

	<div id='listfield1'>
	<h4>Listing Fields</h4>
	<table border='0'>	<tr><th>Starting Bid</th><td><input type='number' name='sbamt'></td></tr>
	<tr><th>Buy Now Price</th><td><input type='number' name='bnamt'></td></tr>
	</table></div>
	
	<!--<div id='listfield2'>
	<h4>Listing Fields</h4>
	<table border='0'><tr><th>Price</th><td><input type='number' name='fixedamt' ></td></tr>
	<tr><th>Quantity</th><td><input type='number' name='fixedQuan' ></td></tr>
	</table>
	</div>-->
	
	<div>
	<h4>Images</h4>
	<input type='file' name='img'>
	</div>
		
	<div id="listfield3"><h4>Start and End Date</h4>	
	<table border='0'>	<tr><th>Start Date</th><td><input type='date' name='startdate'> <input type='time' name='starttime'></td></tr>
	<tr><th>End Date</th><td><input type='date' name='enddate'> <input type='time' name='endtime'></td></tr>
	</table>
  	</div>
  </div>
  <br><br>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <button type='submit' id='subBtn' name='submit'>Submit</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    //document.getElementById("nextBtn").innerHTML = "Submit";
    document.getElementById('subBtn').style.display = "show";
    document.getElementById('nextBtn').style.display='hide';
  } else {
    //document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById('subBtn').style.display = "hide";
    document.getElementById('nextBtn').style.display='show';
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

</body>
</html>

<?php
} else {
	echo "<script>window.alert('First Set your Gpay Account Details on My Profile Tab');
	location.replace('home.php')</script>";
	//header('location:home.php');
}
}
else {
	echo "<script>window.alert('Not a Proper login');
	location.replace('index.php');</script>";
	//header("location:index.php");
}
?>