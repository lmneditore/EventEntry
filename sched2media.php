<?php
session_start();
$typebreak="<BR>";
include("/inks/LMHeader.inc");
$sql="SELECT Acts.ActName, OldActs.ActName AS OldActName, Stages.StageName, OldStages.StageName AS OldStageName, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, ScheduleOfEvents_Old.Stime as OldStime, ScheduleOfEvents_Old.Etime as OldEtime, ScheduleOfEvents_Old.sent2media AS oldsent2media, ScheduleOfEvents.sent2media
FROM ScheduleOfEvents
LEFT JOIN ScheduleOfEvents_Old 
ON ScheduleOfEvents.ScheduleID=ScheduleOfEvents_Old.ScheduleID
LEFT JOIN Acts as OldActs 
ON ScheduleOfEvents_Old.ActID=OldActs.ActID
LEFT JOIN Acts 
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages 
ON ScheduleOfEvents.StageID=Stages.StageID
LEFT JOIN Stages AS OldStages
ON ScheduleOfEvents_Old.StageID=OldStages.StageID
WHERE ScheduleOfEvents.MainEVID='50258'";

$schedresult=@mysql_query($sql,$connection4) OR DIE ("Unable to run query on MainEVID=".$thismainevid."");
$scheds=@mysql_fetch_array($schedresult);
Global $message;
DO
{
if ($scheds["sent2media"]=='0000-00-00')//Current record has not been sent
{
	if ($scheds["oldsent2media"]==NULL) // THERE IS NO OLD RECORD, print the act name and other info
	{
	$message .="Act Name: ";
	$message .=$scheds["ActName"];
		if ($scheds["StageName"]==NULL)
		{
		}
		ELSE// Print the Stage Name
		{
		$message .="Stage: ".$scheds["StageName"];
		}
			if ($scheds["Stime"]==NULL)
		{
		}
		ELSE
		{
		$message .="Start: ".$scheds["Stime"];
		}
		IF ($scheds["Etime"]==NULL)
		{
		}
		ELSE
		{
		$message .="End:  ".$scheds["Etime"];
		}
		$message .=$typebreak;
	}
	ELSE // THERE IS AN OLD RECORD
	{
		$message .="Act Name: ".$scheds["ActName"]."<---- CHANGED".$typebreak."&nbsp;&nbsp;&nbsp;&nbsp;";
		if ($scheds["StageName"]==NULL)// No Stage
		{
			if ($scheds["OldStageName"]==NULL)//No Stage
			{
			}
			ELSE// Old Stage
			{
			$message .="Stage: No New Stage Assignment - Old Stage was ".$scheds["OldStageName"];
			}
		}
		ELSE// Print the Stage Name
		{
		if ($scheds["OldStageName"]==NULL)// No Old Stage
			{
			$message .="Stage: ".$scheds["StageName"]."<--- New stage assignment";
			}
			ELSE// Is old stage
			{
			$message .="Stage: ".$scheds["StageName"]."<--- Changed. Old Stage Assignment was ".$scheds["OldStageName"];
			}
		}
		if ($scheds["Stime"]==NULL)// No Start Time
		{
			If ($scheds["OldStime"]==NULL) // No old start Time
			{
			}
			ELSE // Is Old start Time
			{
			$message .="No New Start Time has been set - old start was ".$scheds["OldStime"];
			}
		}
		ELSE// There is a start time
		{
			If ($scheds["OldStime"]==NULL)// No Old Start Time
			{
			$message .="Start: ".$scheds["Stime"];
			}
			ELSE// Is old start time
			{
			$message .="Start: ".$scheds["Stime"]."<--Changed. Old start was ".$scheds["OldStime"];
			}// end old start
		}//end of start time
			$message .=$typebreak;
	}// End of is Old Record
}// END of sent2media ==0000-00-00
ELSE// Sent2media<>'0000-00-00
{// INFO HAS BEEN SENT, Print Nothing
echo "All info has been sent";
} // end of $scheds fetch
}
WHILE ($scheds=@mysql_fetch_array($schedresult));
echo $message;	?>
