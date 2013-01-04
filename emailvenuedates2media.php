<?php
session_start();
require ("/inks/functions.php");
if ($validvenue>0)
//include("/inks/LMHeader.php");

?>

<?php 
$venueid=$validvenue;
session_unregister("thiseventMainEVID");
$sql4 = "SELECT MainEvents.EventDate as EventDate, MainEvents.VenueID, MainEvents.MainEVID, MainEvents.KindOfEvent, Venues.VenueName as VenueName,ScheduleOfEvents.ScheduleID, Venues.VenueID, Acts.ActName, Venues.Mailaddress, Venues.City, Venues.State, Venues.ContactPh, MainEvents.EventTitle, MainEvents.status, Series.SeriesTitle, Stages.StageName, Stages.StageID,Prices, EventStart, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, ScheduleOfEvents.status as schedstatus
FROM MainEvents
LEFT JOIN Venues 
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN Series
ON MainEvents.SeriesID=Series.SeriesID
LEFT JOIN ScheduleOfEvents
ON MainEvents.MainEVID=ScheduleOfEvents.MainEVID
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
LEFT JOIN sourceconfirmed
ON MainEvents.MainEVID=sourceconfirmed.mainevid
LEFT JOIN DataSource
ON sourceconfirmed.source=DataSource.SourceID
WHERE (MainEvents.VenueID='$venueid')
ORDER BY EventDate"; 

$result = @mysql_query($sql4) or die("couldn't execute query.");
$thisrow=@mysql_fetch_array($result);
$thisvenue=$thisrow["VenueName"];
$thiscontactphone=$thisrow["ContactPh"];
$thisaddress=$thisrow["Mailaddress"];
$thiscity=$thisrow["City"];
$thisstate=$thisrow["State"];
?>


<?php
$message='The attached music event dates are for consideration for your live events calendar.\n\n
Thank you for your consideration.\n\n';
Do 
{
if ($thisrow["status"]=="DI")
{
printf( "Eventdate:&nbsp;%s\n",$thisrow["FDate"]);
printf ("Act: &nbsp; %s\n\n",$thisrow["ActName"]);
}

}
WHILE ($thisrow=@mysql_fetch_array($result));
 






';

?>





