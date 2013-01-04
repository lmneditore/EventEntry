<?PHP
session_start();
require ("functions.php");
?>
<body bgcolor="#0F3925">
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/webmanager/classes/lmstyles.css" TYPE="text/css">
<?PHP

$title = "Louisville Acts";

//include("/inks/LMHeader.php");
?>
<?PHP


$str1="$theseactnames";

$actchunk = "%".$str1."%";



$sql4 ="SELECT DISTINCT Acts.ActName, Acts.ActID, ScheduleOfEvents.ActID,Venues.Region, ScheduleOfEvents.MainEVID, MainEvents.EventDate
FROM Acts
LEFT JOIN ScheduleOfEvents
ON Acts.ActID = ScheduleOfEvents.ActID
LEFT JOIN MainEvents
ON ScheduleOfEvents.MainEVID = MainEvents.MainEVID
LEFT JOIN Venues
ON MainEvents.VenueID = Venues.VenueID
WHERE ScheduleOfEvents.ActID >0
AND MainEvents.EventDate>=CurDate()
AND Region='1'
AND Acts.ActName LIKE '$actchunk'
GROUP BY ActName";


$result4 = @mysql_query($sql4) or die("couldn't execute query.");
$thisrow = @mysql_fetch_array($result4);
?>
<body >
<table bgcolor="#f5e3a1" border=1 bordercolor="blue" align="center" cellpadding="1" valign="top" width="360">
<TH class="IssueHdr" colspan="2"> Currently Listed Acts</TH>
<tr><TD><table>
<?PHP
DO 
{
If ($thisrow["ActID"])
{
$thisActID=$thisrow["ActID"];
$thisActName=$thisrow["ActName"];

?>
<tr><TD class="Act" align="center" width="180"><?PHP echo $thisActName;?></td><TD class="Act" align="center" width="180"><FORM action="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php"><input type="hidden" name="thisActID1" value="<?PHP echo $thisActID;?>">
<input type="hidden" name="thisActName1" value="<?PHP echo $thisActName;?>"> <input type="submit" name="submit" value="Select" action="GET"></form></td></tr>
<tr></tr>

<?PHP
}
Else
{
echo "<tr><td class = \"Act\" colspan=\"2\">There are no acts like ".$theseactnames." listed. </td></tr>";
}
}
While ($thisrow = @mysql_fetch_array($result4));

mysql_close($connection4);
?>

</td></tr>
</table>
</td></tr>
<TR><TD colspan="2" align="Center"><INPUT TYPE="Button" VALUE="Back" onClick="history.go(-1)"></td></tr>
</table>


