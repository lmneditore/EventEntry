<?php session_start();
include("/inks/LMhdrw.inc");
$sql="SELECT lmuser.email, lmuser.tel, lmuser.salutation,lmuser.fname, lmuser.lname, lmuser.actid, lmuser.venueid, mediaemail.businessname, mediaemail.contactname, mediaemail.title, mediaemail.emailaddress as mediaemail FROM lmuser
LEFT JOIN usermedia 
ON usermedia.userid=lmuser.user_id 
LEFT JOIN mediaemail ON
usermedia.mediaemailid=mediaemail.mediaemailid 
WHERE lmuser.user_id='$thisuserid'";
include("/inks/LMHeader.inc");
$sqlmedia="SELECT Venues.VenueName, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.Prices, MainEvents.EventStart, MainEvents.EventStart, MainEvents.ContactNumber, AgeRestrictions.AgeRestriction, MainEvents.DescriptionOfEvent, MainEvents.DoorsOpen, MainEvents.MainEVID, EventType.TypeofEvent, ScheduleOfEvents.status, MainEvents_Old.EventDate AS EventDate_Old, MainEvents_Old.MainEVID AS MainEVID_Old, ScheduleOfEvents_Old.status AS status_Old, Acts.ActName, Acts_01.ActName AS ActName_Old, eventchangetype.eventchangetype FROM Venues
LEFT JOIN MainEvents ON
Venues.VenueID=MainEvents.VenueID
LEFT JOIN ScheduleOfEvents
ON MainEvents.MainEVID=ScheduleOfEvents.MainEVID
LEFT JOIN AgeRestrictions ON
AgeRestrictions.AgeCodeID=MainEvents.AgeLimits
LEFT JOIN EventType
ON MainEvents.KindOfEvent=EventType.EventTypeID
LEFT JOIN ScheduleOfEvents_Old
ON MainEvents.MainEVID=ScheduleOfEvents_Old.MainEVID
LEFT JOIN MainEvents_Old ON
Venues.VenueID=MainEvents_Old.VenueID
LEFT JOIN Acts ON
ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Acts AS Acts_01 ON
ScheduleOfEvents_Old.ActID=Acts_01.ActID
LEFT JOIN eventchange ON 
MainEvents.MainEVID=eventchange.mainevid
LEFT JOIN eventchangetype ON
eventchange.typechange =eventchangetype.eventchangetypeid 
WHERE (Venues.VenueID='13573' AND (eventchange.sent2media='0000-00-00' OR eventchange.changedid IS NULL))
ORDER BY MainEvents.EventDate, MainEvents_Old.EventDate";
$results=@mysql_query($sqlmedia,$connection4) or die("Couldn't execute this query.");
$tomedia=@mysql_fetch_array($results);



echo "Please include the following events in your live events calendar.";
Echo "<BR>";
echo "<TABLE>";
echo "<TH>".$tomedia["VenueName"]."</th>";
echo "<TR><TD align=\"right\"> Questions? Call: </td><td align=\"left\">".$tomedia["ContactNumber"]."</td></tr>";
$thisdate="2002-01-01";
$thisact="Foo";
Do
{
    if ($tomedia["EventDate"]==$thisdate)
    {
       if ($tomedia["ActName"]==$thisact)
       {
       }
       ElSE
       {printf("<TR><TD align=\"right\">Act Name: </td><td align=\"left\"><b>%s</b></td></tr>",$tomedia["ActName"]);
$thisdate=$tomedia["EventDate"];
$thisact=$tomedia["ActName"];
      $thisdate=$tomedia["EventDate"];
      }
    }
    ELSE
    {
echo "<TR><TD><BR></td></tr>";
printf ("<TR><TD align=\"right\">Event Date: </td><td align=\"left\"><B>%s</b></td></tr>",$tomedia["FDate"]);

if ($tomedia["TypeofEvent"])
{
printf ("<TR><TD align=\"right\">Event Type:  </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["TypeofEvent"]);
}

if ($tomedia["EventTitle"])
{
printf ("<TR><TD align=\"right\">Title: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["EventTitle"]);
}

if ($tomedia["DescriptionOfEvent"])
{
printf ("<TR><TD align=\"right\">Description: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["DescriptionOfEvent"]);
}


if ($tomedia["Prices"])
{
printf ("<TR><TD align=\"right\">Prices: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["Prices"]);
}
if ($tomedia["EventStart"])
{
printf ("<TR><TD align=\"right\">Event Start: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["EventStart"]);

}
if ($tomedia["AgeRestriction"])
{
printf ("<TR><TD align=\"right\">Age Restriction: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["AgeRestriction"]);

}
if ($tomedia["DoorsOpen"])
{
printf ("<TR><TD align=\"right\">Doors: </td><td align=\"left\"><b>%s</b></td></tr>", $tomedia["DoorsOpen"]);

}

if ($tomedia["ActName"])
{
printf("<TR><TD align=\"right\">Act Name: </td><td align=\"left\"><b>%s</b></td></tr>",$tomedia["ActName"]);
}
ELSE
{
}
$thisdate=$tomedia["EventDate"];
$thisact=$tomedia["ActName"];
    }

}
WHILE ($tomedia=@mysql_fetch_array($results));
?>


