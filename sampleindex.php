<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
p{
border: 2px solid black;
text align: center;
outline: solid 10px;
padding: 3px;
}

* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: #333;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #555;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}
#Home {background-color: red;}
#Register {background-color: green;}
#Contact {background-color: blue;}
#About {background-color: orange;}
</style>
</head>
<body>

<button class="tablink" onclick="openPage('Home', this, '#333')" id="defaultOpen">Home</button>
<button class="tablink" onclick="openPage('Register', this, '#333')">Register/login</button>
<button class="tablink" onclick="openPage('Contact', this, '#333')">Contact</button>
<button class="tablink" onclick="openPage('About', this, '#333')">About</button>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
</div>

<div id="Register" class="tabcontent">
<h3>REGISTER</h3>
</div>

<div id="Contact" class="tabcontent">
  <h3>Contact</h3>
</div>

<div id="About" class="tabcontent">
  <h3>About</h3>
</div>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
</body>
</html>
