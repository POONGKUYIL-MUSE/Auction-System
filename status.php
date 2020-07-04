<?php

?>
<html>
<head>
<script>
	
</script>
</head>
<body>
<?php
	echo "<script>
	function myFunc() {
		var x = document.getElementById('demo').innerHTML;
		document.getElementById('status').innerHTML = x;
	}</script>";
?>
<p id='demo'>hi</p>
<h2 id='status'></h2>
<button type='submit' onclick='myFunc()'>Sub</button>
</body>
</html>