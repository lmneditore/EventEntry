<?php
include("/inks/LMHeader.inc");?>
<?
$countsched="SELECT Count(*) AS COUNT FROM ScheduleOfEvents 
WHERE MainEVID='$thismaineventevid'";
$countresult=@mysql_query($countsched,$connection4) OR DIE ("Couldn't count the schedule");
$fetchcount=@mysql_fetch_array($countresult);
$numacts=$fetchcount["COUNT"];
$schedsql="SELECT ActName FROM ScheduleOfEvents 
LEFT JOIN Acts ON
ScheduleOfEvents.ActID=Acts.ActID
WHERE MainEVID='$thismaineventevid'
ORDER BY ProgramOrder DESC";

$result=@mysql_query($schedsql,$connection4) OR DIE ("Unable to find this schedule for events $thismaineventevid");
$sched=@mysql_fetch_array($result);


$i=0;
DO
{
	if (isset($sched))
	{
		if ($numacts==1)
		{
		echo "<DIV class=\"headliner\">".$sched["ActName"]."</DIV><BR>";
		echo "<DIV class=\"more\"><a href=\"ThisEvent.php?thiseventMainEVID=$thismaineventevid\"  target=\"_blank\">...more...</a></DIV>";
		break;
		}
		ELSEIF ($i==0)
		{
		echo "<DIV class=\"headliner\">".$sched["ActName"]."</DIV><BR>";
		$i=$i+1;
		}
		ELSEIF($i==($numacts-1))
		{
		echo "<DIV class=\"actlist\">".$sched["ActName"]."</DIV><BR>";
		echo "<DIV class=\"more\"><a href=\"ThisEvent.php?thiseventMainEVID=$thismaineventevid\"  target=\"_blank\">...more...</a></SPAN>";
		$i=$i+1;
		}
		ELSE
		{
		echo "<DIV class=\"actlist\">".$sched["ActName"]."</DIV><BR>";
		$i=$i+1;
		}
	}
	ELSE
	{
		if (isset($thismaineventevid))
		{
		echo "<DIV class=\"more\"><a href=\"ThisEvent.php?thiseventMainEVID=$thismaineventevid\"  target=\"_blank\">...more...</a></DIV>";
		}
		ELSE
		{
		echo "Nothing happening";
		}
	}
}
WHILE ($sched=@mysql_fetch_array($result));
@mysql_close($connection4);
?>