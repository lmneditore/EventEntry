<?php
//"ip.php" example- display user IP address on any page
Header("content-type: application/x-javascript");
$serverIP=$_SERVER['REMOTE_ADDR'];
echo "<script language=\"javascript\" type=\"Text/Javascript\">document.write(\"Your IP address is: <b>".$serverIP."</b><\script>\")";
?>
