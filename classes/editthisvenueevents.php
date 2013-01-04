<?PHP session_start();
//require ("/inks/functions.php");
//<!-- Classes: maintable / inserttable / act / VenueHdr / venuesite / editeventdate / Title / venueeditbody -->
// This document is for venue managers to select events to edit -->

//include ("businessweblink.php");

include ("classes/editvenueeventsclass.php");
//include("businessweblink.php");

if ($_GET["validvenue"]==true)
{
	if (session_is_registered("validvenue"))
	{
	}
	ELSE
	{
	session_register("validvenue");
	}
}
ELSE
{
	echo "No Venue ID";
}
$venueid=$_GET["validvenue"];
$venue=new venueevents();
//$venue->displayvenueinfo($venueid);
//echo $venue->vdisplay;
//$h->topidbar($text);
//echo "<div class=\"halfdiv\">";
echo "<div class=\"frontpagebox\" >";
$venue->displayvenueevents($venueid, $from, $to);
//echo $venue->vdisplay;
echo $venue->edisplay;
echo "</div></div>";
?>

</table>




