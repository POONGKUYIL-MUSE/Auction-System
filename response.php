<?php
include "config.php";
session_start();
$fromTime = date('Y-m-d H:i:s');
$toTime = $_SESSION['endTime'];

$timeFirst = strtotime($fromTime);
$timeSecond = strtotime($toTime);

$differenceInSeconds = $timeSecond - $timeFirst;
if($differenceInSeconds > -1) {
	echo gmdate("H:i:s",$differenceInSeconds);
}
if($differenceInSeconds < 0) {
	echo "expired";
}
?>