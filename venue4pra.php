<?PHP
Session_start();
include ("/inks/LMHeader.inc");
$sqlvenue="SELECT Venues.VenueName, Venues.ContactPh, Venues.MailAddress, Venues.City, Venues.State
FROM Venues
WHERE VenueID='$thisvenueid'";
$venue=@mysql_query($sqlvenue,$connection4) OR DIE ("Couldn't select Venue information");
$venue4pr=@mysql_fetch_array($venue);
DO
{
$messagev="Please consider the following dates for inclusion in your events calendar for: \n";
$messagev .="<BR><BR>".$venue4pr["VenueName"];
$messagev .="<BR>".$venue4pr["MailAddress"];
$messagev .="<BR>".$venue4pr["City"];
$messagev .=", ".$venue4pr["State"];
$messagev .="<BR>Public Phone: ".$venue4pr["ContactPh"];
}
WHILE ($venue4pr=@mysql_fetch_array($venue));
@mysql_close($connection4);

?>