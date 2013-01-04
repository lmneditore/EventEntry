<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">



<?php

$title = "";

//include("/inks/LMHeader.php");
?>


</head>


<?
$tablename="MainEvents";
$butablename="MainEvents_Old";
$cols=array();
$findcolumns="DESCRIBE $tablename";
$columns=@mysql_query($findcolumns,$connection4) OR DIE ("Couldn't complete findcolumns=".$findcolumns." query.");
$listcolumns=@mysql_fetch_array($columns);
//echo $listcolumns["Field"]." ".$listcolumns["Type"];

DO
{
$colname=$listcolumns["Field"];
$cols=array_merge($cols,"\$copy2oldsql[\"".$colname."\"]");
}
WHILE ($listcolumns=@mysql_fetch_array($columns));
$values="INSERT INTO ".$butablename." VALUES ('\".";
$values .=implode(".\"','\".",$cols);
$values .=".\"' );\n";

$sql="SELECT * FROM MainEvents WHERE (VenueID='13573' AND sent2media='0000-00-00')";
$result=@mysql_query($sql,$connection4) OR DIE("couldn't complete sql=".$slq." query.");
$copy2oldsql=@mysql_fetch_array($result);

DO
{
$allrec=$values;
}
WHILE ($copy2oldsql=@mysql_fetch_array($result));
echo $allrec;

?>


