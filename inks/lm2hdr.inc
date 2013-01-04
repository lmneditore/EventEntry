<?php
$connection2 = @mysql_connect("louisvillemusicnews.ipowermysql.com", "louisvil", "ADW7FSxg") or die("couldn't connect");

$db4 = @mysql_select_db("louisvillemusic2", $connection2) or die("couldn't select database.");

?>