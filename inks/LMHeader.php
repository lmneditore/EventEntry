<?php
//$connection4 = @mysql_connect("louisvillemusicnews.ipowermysql.com", "louisvil", "ADW7FSxg") or die("couldn't connect");
$connection4 = @mysql_connect("louisvillemusicnews.ipowermysql.com", "root", "") or die("couldn't connect");
$db4 = @mysql_select_db("louisvillemusic_com") or die("couldn't select database.");
?> 