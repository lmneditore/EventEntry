<?PHP
session_start();
function getvenueinfo($thisvenueid)
{
include ("/inks/LMHeader.inc");
$sqlvenue="SELECT Venues.VenueName, Venues.ContactPh, Venues.MailAddress, Venues.City, Venues.State
FROM Venues
WHERE VenueID='$thisvenueid'";
$venue=@mysql_query($sqlvenue,$connection4) OR DIE ("Couldn't select Venue information");
$venuestuff=@mysql_fetch_array($venue);
global $venueinfo;
$venueinfo="Please consider the following dates for inclusion in your events calendar for:";
DO
{
$venueinfo .="<BR><BR>".$venuestuff["VenueName"];
$venueinfo .="<BR>".$venuestuff["MailAddress"];
$venueinfo .="<BR>".$venuestuff["City"];
$venueinfo .=", ".$venuestuff["State"];
$venueinfo .="<BR>Public Phone: ".$venuestuff["ContactPh"];
}
WHILE ($venuestuff=@mysql_fetch_array($venue));
@mysql_close($connection4);
}
echo $venueinfo;
?>