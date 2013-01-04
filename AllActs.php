<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<?php

$title = "All Listed Acts";
$stylesheet = "http://www.louisvillemusicnews.net/lmn/LMNStyles.css";
echo "<LINK REL=stylesheet HREF=\"$stylesheet\" TYPE=\"text/css\">";

//include("/inks/LMHeader.php");
?>
<?PHP


$str1="$theseactnames";

$actchunk = "%".$str1."%";



$sql4 ="SELECT DISTINCT Acts.ActName, Acts.ActID
FROM Acts
WHERE Acts.ActName LIKE '$actchunk'
GROUP BY ActName";


$result4 = @mysql_query($sql4) or die("couldn't execute query.");
?>
<body >
<table bgcolor="#f5e3a1" border=1 bordercolor="blue" align="center" cellpadding="1" valign="top">
<TH class="IssueHdr">Acts with Currently Listed Performances</TH>

<?PHP
While ($thisrow = @mysql_fetch_array($result4))
If ($thisrow["ActName"])
{
printf ("<tr><TD class=\"Act\" align=\"center\"><a href=\"http://www.louisvillemusicnews.net/eventediting/submitdateonly.php?submit=logthis?thisactID=%s&thisactname=%s\">%s</a></td></tr>",$thisrow["ActID"],$thisrow["ActName"], $thisrow["ActName"]);
}
Else
{
echo "<tr><td class = \"Act\">There are no records for any acts currently listed.</td></tr>";
}
mysql_close($connection4);
?>

</table>


