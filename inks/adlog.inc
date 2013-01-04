<?php
if($adid)
{
$url = urldecode($QUERY_STRING);
$day = date("Y-m-d"); 


$connection4 = @mysql_connect("louisvillemusicnews.ipowermysql.com", "louisvil", "ADW7FSxg") or die("couldn't connect");

$db4 = @mysql_select_db("louisvillemusic2", $connection4) or die("couldn't select database.");
$sql1="INSERT INTO adtrack (adid, hitdate,querystring) VALUES ('$adid','$day','$url')";
$result4 = @mysql_query($sql1, $connection4) or die("couldn't execute insert2 query.");
}
ElSE
{
echo "No Adid";
}

mysql_close($connection4);
?>
