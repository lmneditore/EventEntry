<?PHP
session_start();

$title = "Venue Calendar";
//$stylesheet = "http://www.louisvillemusicnews.net/lmn/stylesheets/LMNStylewhite.css";
//echo "<LINK REL=\"stylesheet\"  HREF=\"".$stylesheet."\"  TYPE=\"text/css\">";
//include("/inks/LMHeader.php");
$str1="$thesevenuenames";
$venuechunk = "%".$str1."%";
$sql4 = "SELECT DISTINCT Venues.VenueName, Venues.VenueID, MainEvents.VenueID 
FROM Venues
LEFT JOIN MainEvents
On Venues.VenueID=MainEvents.VenueID
WHERE VenueName LIKE '$venuechunk'
ORDER BY VenueName";
$result4 = @mysql_query($sql4) or die("couldn't execute query.");
 //displayLMHeader();?>
<table border="0" width="365" class="centertable>
<TR><TD class="searchhdr">Live Music Venues</td></tr>
<?PHP
Do
{
$validvenue=$thisrow["VenueID"];
$venuename=$thisrow["VenueName"];
$value=$venuename;
	if (!$venuename)
	{
	}
	ELSE
	{
	echo "<TR><TD colspan=3 class=\"venuesearchinstructions\">";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?validvenue=".$validvenue;
	$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	echo "<br></td></tr>\n";
	}
}
while ($thisrow = @mysql_fetch_array($result4));

echo "<TR><TD colspan=\"3\" class=\"venuesearchinstructions\">";
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";

$value="Search Again";
lmbackup($value);
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
echo "&nbsp";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "</td></tr>";
mysql_close($connection4);
?>
</table>


