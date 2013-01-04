<?php
session_start();
require ("/inks/functions.php");
require ("editvars.php");
$title = "Act Edit Calendar";
$stylesheet = "http://www.louisvillemusicnews.net/lmn/LMNStyles.css";
//include("/inks/LMHeader.php");
$sql3="Create TEMPORARY TABLE ACTSHOWS Select DISTINCT ScheduleOfEvents.MainEVID
FROM ScheduleOfEvents
WHERE ScheduleOfEvents.ActID=$thisactID
GROUP BY MainEVID";

$result3 = @mysql_query($sql3) or die("couldn't execute temp query.");


$sql5 = "SELECT MainEvents.EventDate as EventDate, ACTSHOWS.MainEVID, MainEvents.MainEVID, MainEvents.KindOfEvent, Venues.VenueName, Venues.VenueID, Acts.ActName, Acts.ActID, MainEvents.EventTitle, SeriesTitle, Stages.StageName, DATE_FORMAT(MainEvents.EventDate, '%W, %M %d, %Y') AS FDate
FROM ACTSHOWS
LEFT JOIN ScheduleOfEvents
On ScheduleOfEvents.MainEVID=ACTSHOWS.MainEVID
LEFT JOIN MainEvents
On MainEvents.MainEVID=ScheduleOfEvents.MainEVID
LEFT JOIN Venues 
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN Acts
On ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Series
ON MainEvents.SeriesID=Series.SeriesID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE (MainEvents.EventDate>=CurDate())
ORDER BY MainEvents.EventDate";

$Venue1="None";
$Date1="1999-12-31";


$result4 = @mysql_query($sql5) or die("couldn't execute second query.");
$thisrow = @mysql_fetch_array($result4);

If ($thisrow["MainEVID"])
{
echo ("<table bgcolor=\"#FEFCD8\" border=1 bordercolor=\"#FEFCD8\" align=\"center\" width=\"365\"><TH class=\"searchhdr\"> Shows </font><TH>\n");
printf("<tr><TD class=\"eventdate\" colspan=3>%s</td></tr><tr><td class=\"venue\"><a href=\"http://www.louisvillemusicnews.net/lmn/lmhdr.php?thisid=10&thiseventMainEVID=%s\">%s</a> </td></tr></tr><tr><td class=\"act\">%s </td></tr>\n",$thisrow["FDate"],$thisrow["MainEVID"],$thisrow["VenueName"],$thisrow["ActName"]);
$Date1=$thisrow["EventDate"];
$Venue1=$thisrow["VenueName"];


?>


<?PHP 

While ($thisrow = @mysql_fetch_array($result4)) 

If ($Date1==($thisrow["EventDate"]))/*Start Date Check Loop*/
{

	if 
	
	($Venue1==($thisrow["VenueName"]))
	{
	printf("<tr><td class=\"act\">%s </td></td></tr>\n",$thisrow["ActName"]);
	$Venue1=($thisrow["VenueName"]);
   }/*End IF Venue Check*/
   ELSE /*Venue Is Different*/
   {
   /*Start ELSE Venue Check Print Venue Name*/
   printf("<tr><td class=\"venue\"><a href=\"".$mainhdr."?thisid=10&thiseventMainEVID=%s\">%s</a> </td></td></tr>\n",$thisrow["MainEVID"],$thisrow["VenueName"]);
			$Venue1=($thisrow["VenueName"]);
			$MainEVID=$thisrow["MainEVID"];

      		IF ($thisrow["EventTitle"]) { /*Start EVENT TITLE Check*/
			printf("<tr><td class=\"title\">%s </td></td></tr>\n",($thisrow["EventTitle"]));
			}/*END EVENT TITLE IF Check*/
			else {/*Start EVENT TITLE ELSE Check*/
			}/*End EVENT TITLE ELSE Check*/
				
			printf("<tr><td class=\"act\">%s </td></td></tr>\n",$thisrow["ActName"]);
				
			}/*END ELSE Venue Check BLOCK*/
}/*End DATE IF Block*/
Else 
{ /*BEGIN DATE ELSE Date is different Loop*/
Printf("<tr><TD class=\"eventdate\" colspan=3>%s</td></tr>",$thisrow["FDate"]);
printf("<tr><td class=\"venue\"><a href=\"".$mainhdr."?thisid=10&thiseventMainEVID=%s\">%s</a> </td></td></tr>\n",$thisrow["MainEVID"],$thisrow["VenueName"]);

      		IF ($thisrow["EventTitle"]) { /*Start EVENT TITLE Check*/
			printf("<tr><td class=\"title\">%s </td></td></tr>\n",($thisrow["EventTitle"]));
			}/*END EVENT TITLE IF Check*/
			else {/*Start EVENT TITLE ELSE Check*/
			}/*End EVENT TITLE ELSE Check*/

		printf("<tr><td class=\"act\">%s</td></td></tr>\n",$thisrow["ActName"]);
		$Venue1=($thisrow["VenueName"]);
		$Date1=($thisrow["EventDate"]);
		$MainEVID=$thisrow["MainEVID"];
			
} /*END DATE CHECK LOOP*/
}
ELSE
{
echo "<table bgcolor=\"#FEFCD8\" border=1 bordercolor=\"#FEFCD8\" align=\"center\" width=\"365\">";
ECHO "<tr><td class=\"act\">There are no shows listed for this act.</td></tr>";
}

	

	?>

</table>




