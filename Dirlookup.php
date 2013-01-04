<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">



<?php

$title = "";

include("/inks/LMhdrw.inc");?>


</head>


<?PHP
function getDirList ($dirName) { 
$d = dir($dirName); 
while($entry = $d->read()) { 
if ($entry != "." && $entry != "..") { 
if (is_dir($dirName."/".$entry)) { 
getDirList($dirName."/".$entry); 
} else { 
echo $dirName."/".$entry."
\n"; 
} 
} 
} 
$d->close(); 
} 

getDirList("."); 

$dirName="../";
getDirList($dirName);
?>


