<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="formStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<div class="form-style">
		<h2>Sign Up</h2>
		<form method="post" action="process.php">
		
			<input type="text" name="username" placeholder="Enter Username" required>
			<input type="email" name="email" placeholder="Enter Email Id" required>
			<input type="number" name="mobile" placeholder="Enter Mobile Number" required>
			<input type="password" name="psw" placeholder="Enter Password" required>
		
			<center><input type="submit" name="submit" value="Sign Up"></center>
		</form>
		<hr id="hr1"><br>
		<center><a href="login.php">Sign In</a></center>
	</div>
</body>
</html>