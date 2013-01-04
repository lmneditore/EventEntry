<?PHP
session_start();
require ("/inks/functions.php");
include ("/inks/LMHeader.inc");
$typebreak="\n";
$stylesheet="http://www.louisvillemusicnews.net/eventediting/venueedit.css";
function getvenueinfo($validvenue,$typebreak)
{
include ("/inks/LMHeader.inc");
global $venueinfo;
global $venuename;
$sqlvenue="SELECT Venues.VenueName, Venues.ContactPh, Venues.MailAddress, Venues.City, Venues.State
FROM Venues
WHERE VenueID='$validvenue'";
$venue=@mysql_query($sqlvenue,$connection4) OR DIE ("Couldn't select Venue information");
$venuedata=@mysql_fetch_array($venue);
$venuename=$venuedata["VenueName"];
session_register("venuename");

$venueinfo="Please consider the following dates for inclusion in your events calendar for:";
DO
{
$venueinfo .= $typebreak.$venuedata["VenueName"];
$venueinfo .= $typebreak.$venuedata["MailAddress"];
$venueinfo .=$typebreak.$venuedata["City"];
$venueinfo .=", ".$venuedata["State"];
$venueinfo .=$typebreak."Public Phone: ".$venuedata["ContactPh"];
}
WHILE ($venuedata=@mysql_fetch_array($venue));
@mysql_close($connection4);
}

function getoldmainevents($MainEVID)
{
global $oldmainevid;
global $olddate;
global $oldtitle;
global $oldstart;
global $oldprices;
global $oldonsale;
global $oldages;
global $olddoors;
global $oldfdate;
global $oldsponsor;
global $oldmainevid;
global $oldsdate;
global $oldstatus;
include ("/inks/LMHeader.inc");
$sqloldevent="SELECT MainEvents_Old.oldmainevid, MainEvents_Old.MainEVID, DATE_FORMAT(MainEvents_Old.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents_Old.sent2media, MainEvents_Old.EventDate, MainEvents_Old.EventTitle, MainEvents_Old.DoorsOpen, MainEvents_Old.EventStart, MainEvents_Old.EventEnd, DATE_FORMAT(MainEvents_Old.onsaledate, '%W, %M %e, %Y') as SDate, MainEvents_Old.Prices,  MainEvents_Old.onsaledate, MainEvents_Old.sponsor,  AgeRestrictions.AgeRestriction, MainEvents_Old.status
FROM MainEvents_Old
LEFT JOIN AgeRestrictions
ON MainEvents_Old.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents_Old.MainEVID='$MainEVID' AND MainEvents_Old.sent2media<>'0000-00-00')
ORDER BY MainEvents_Old.oldmainevid DESC ";
$result=@mysql_query($sqloldevent,$connection4) or die ("Couldn't run the old MainEvents query");
$oldshows=@mysql_fetch_array($result);
$i=0;
DO 
{
if ($i==($numrows-1))
{
}
ELSE
{
    IF ($i==0)
    {
$oldmainevid=$oldshows["oldmainevid"];
$olddate=$oldshows["EventDate"];
$oldtitle=$oldshows["EventTitle"];
$oldstart=$oldshows["EventStart"];
$oldprices=$oldshows["Prices"];
$oldonsale=$oldshows["onsaledate"];
$oldsdate=$oldshows["SDate"];
$oldages=$oldshows["AgeRestriction"];
$olddoors=$oldshows["DoorsOpen"];
$oldfdate=$oldshows["FDate"];
$oldsponsor=$oldshows["sponsor"];
$oldstatus=$oldshows["status"];
$i=$i++;
     }
     ELSE
     {
     $i=$i++;
     }
     }
     }
WHILE (@mysql_fetch_array($result));
mysql_close($connection4);
}
function scheduleinfo($MainEVID,$message)
{
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
WHERE ScheduleOfEvents.MainEVID='$MainEVID'";

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
			$message .="No new Start time has been set - old start was ".$scheds["OldStime"];
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
@mysql_close($connection4);
}//END OF SCHEDULE FUNCTION



//add in password protection function here.

$venueid="$validvenue";
$prstatus="(MainEvents.status='OK' OR MainEvents.status='DE')";
$where="(MainEvents.VenueID='$validvenue' AND $prstatus";
IF ($sendwhat=="All")
{
$where .=")";
}
ELSEIF ($sendwhat=="Not Sent")
{
$where .=" AND (MainEvents.sent2media='0000-00-00'))";
}
ELSEIF ($sendwhat==NULL)
{
$where .=")";
}

$sqlchanged="SELECT MainEvents.MainEVID, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents.sent2media, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.DoorsOpen, MainEvents.EventStart, MainEvents.EventEnd, DATE_FORMAT(MainEvents.onsaledate, '%W, %M %e, %Y') as SDate, MainEvents.Prices, MainEvents.onsaledate, MainEvents.status, AgeRestrictions.AgeRestriction, MainEvents.VenueID as venueid, MainEvents.sponsor, MainEvents.status, MainEvents_Old.oldmainevid as oldevid
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
LEFT JOIN MainEvents_Old 
ON MainEvents.MainEVID=MainEvents_Old.MainEVID
WHERE $where
ORDER BY MainEvents.EventDate, ScheduleOfEvents.ProgramOrder,ScheduleOfEvents.Stime, MainEvents.sent2media='0000-00-00";

$result=@mysql_query($sqlchanged,$connection4) or die ("Couldn't run the publicity query");
$shows=@mysql_fetch_array($result);
$numshows=@mysql_numrows($result);
$numformrows=($numshows*(3.2))+6;
getvenueinfo($validvenue,$typebreak);
$message=$venueinfo;
//---------------------------------------------------------Begin selection of shows to send ------------------
DO
{// start of DO LOOP

	if ($shows["oldevid"]==NULL)//There is no old record
	{
		 if ($shows["status"]=="DE")
		 {
		 $message .="-----------------This Show has been CANCELLED------------------";
		 $message .=$shows["EventDate"];
		 $MainEVID=$shows["MainEVID"];
		 scheduleinfo($MainEVID,$message);
		 }
		 ELSE
		 {
 		 $message .=$shows["EventDate"];
		 $MainEVID=$shows["MainEVID"];
		 scheduleinfo($MainEVID,$message);
		 }
	
	}
	ELSE// This is an old record
	{
	}
}
  
  
  
  
  
  
/*    {//SAME SHOW Print info about schedules
            
			$message .=$typebreak;
           $message .= "Act Name:.....".$shows["ActName"]."&nbsp;&nbsp;" ; 
           if ($oldActName)
           {
              if ($oldActName==$shows["ActName"])
              {
             $message .$typebreak;
              }
             ELSE
             {
             $message .="   <----------- Changed - Was: ".$oldActName;
             $message .$typebreak;
             }
           }
             if ($shows["Stime"])
             {
               $message .= " - ".$shows["Stime"];
             }
             ELSE
             {
             }
             if ($shows["Etime"])
             {
               $message .= "End:.".$shows["Etime"];
             }
             ELSE
             {
             }
    }
    ELSE
    {//SHOW CHANGED - Begin Assembling message---------------------------------------
        getoldmainevents($MainEVID);
               $message .=$typebreak.$typebreak;
         if ($oldmainevid)
		 {
		 echo "This old mainevid=";
		 echo $oldmainevid;
			 if ($shows["status"]=="DE")
			 {
			 $message .="-----------------DELETED------------------";
			 }
			 ELSE
			 {
			 }
			 
		 }
		 ELSE
		 {
 		 $message .= "---------------------New ------------------";

		 $message .=$typebreak;
		 }
               $message .= "Event Date:....";
               $message .= $shows["FDate"];
       if ($olddate)
       {
           if ($olddate==$shows["EventDate"])
           {
           }
           ELSE
           {
				if ($shows["status"]=="DE")
				{
				$message .=" <---------------- DELETED--------------";
		   		}
				ELSE
				{
           $message .=" <------------ Changed - Was: ".$oldfdate;
				}
           }
       }
       ELSE
       {
       }
//          $message .=$typebreak;
       if ($shows["TypeofEvent"])
       {
       $message .=$typebreak."Event Type:....";
       $message .=$shows["TypeofEvent"];
       }
	   
	   
       if ($shows["EventTitle"])// If there is an Event Title
       {
           $message .=$typebreak."Title:..............";
           $message .=$shows["EventTitle"];// print the title
			if ($shows["status"]=="DE")
			{
			$message .="<------------------DELETED -----------";
			}
			ELSE
			{
             if ($oldtitle<>"")// If there was an event title
                {
						If ($shows["EventTitle"]==$oldtitle)//If the titles are the same
						{
						}
						ELSE
						{
			             $message .="  <----------- Changed - Was: ".$oldtitle;
		                }
				}
                ELSE//There was no title
                {
					if ($oldmainevid)
					{
                $message .="  <-----------  Was Added";
					}
					ELSE
					{

	                }
				}
    //        $message .=$typebreak;
			}
       }

      if ($shows["SeriesTitle"])
      {
           $message .=$typebreak."Series Title:...";
           $message .=$shows["SeriesTitle"];
      }

      if ($shows["sponsor"])
      {
      $message .=$typebreak."Sponsor:...";
      $message .=$shows["sponsor"];
        if ($oldsponsor)
        {
            if ($oldsponsor==$shows["sponsor"])
            {
            }
            ELSE
            {
            $message .="   <----------- Changed - Was: ".$oldsponsor;
            }
         }
		 ELSE
		 {
            $message .="   <----------- Was Added";
		 }
 //     $message .=$typebreak;
      }
      
       If ($shows["Prices"])
       {
          $message .=$typebreak."Admission:.....";
          $message .=$shows["Prices"];
       }
       if ($oldprices)
       {
       if ($oldprices==$shows["Prices"])
       {
       }
       ELSE
       {
       $message .="  <------------ Changed - Was: ".$oldprices;
       }
       }
 //      $message .=$typebreak;
       if ($shows["AgeRestriction"])
       {
       $message .=$typebreak."Age Limits:....";
       $message .=$shows["AgeRestriction"];
       If ($oldages)
       {
       if ($oldages==$shows["AgeRestriction"])
       {
       }
       ELSE
       {
       $message .="   <------------ Changed - Was: ".$oldages;
       }
       }
    //   $message .=$typebreak;
       }
      if ($shows["EventStart"])
      {
      $message .=$typebreak."Event Start:....";
      $message .=$shows["EventStart"];
      if ($oldstart)
      {
      if ($oldstart==$shows["EventStart"])
      {
      }
      ELSE
      {
      $message .="   <----------- Changed - Was: ".$oldstart;
      }
      }
   //   $message .=$typebreak;
      }

      If ($shows["DoorsOpen"])
      {
      $message .=$typebreak."Doors Open:..";
      $message .=$shows["DoorsOpen"];
      if ($olddoors)
      {
      If ($olddoors==$shows["DoorsOpen"])
      {
      }
      ELSE
      {
      $message .="   <----------- Changed - Was: ".$olddoors;
      }
      }
 //     $message .=$typebreak;
      }

      IF ($shows["EventEnd"])
      {
      $message .=$typebreak."Event End:.....";
      $message .=$shows["EventEnd"];
      }

      IF ($shows["onsaledate"]<>("0000-00-00"))
      {
      $message .=$typebreak."On Sale:........";
      $message .=$shows["SDate"];
      if ($oldonsale)
      {
      if ($oldonsale==$shows["SDate"])
      {
      }
      ELSE
      {
      $message .="   <----------- Changed - Was: ".$oldsdate;
      }
      }
  //    $message .=$typebreak;
      }
     $thisschedid=$shows["ScheduleID"];
     
     if ($shows["ScheduleID"]>0)
     {
     $thisschedid=$shows["ScheduleID"];
     getoldacts($thisschedid);
     }
     ELSE
     {
     }
      if ($shows["ActName"])
      {
      $message .=$typebreak."Act Name:.....";
      $message .=$shows["ActName"];
         IF ($oldActName)
         {
             if ($oldActName==$shows["ActName"])
             {
             }
             ELSE 
            {
            $message .="   <----------- Changed - Was: ".$oldActName;
            }
         }
    //     $message .=$typebreak;
      }
      
      
      if ($shows["Stime"])
      {
      $message .=" - ".$shows["Stime"];
         if ($oldstime)
        {
            if ($oldstime==$shows["Stime"])
             {
             }
             ELSE
             {
             $message .="   <----------- Changed - Was: ".$oldstime;
             }
            }
 //     $message .$typebreak;
      }
      
      $MainEVID=$shows["MainEVID"]; 
     $thisschedid=$shows["ScheduleID"];
      
      


    }//End of MainEVID Check


}// end of DO Loop
WHILE ($shows=@mysql_fetch_array($result));
session_register("message");*/
?>


<LINK REL=stylesheet HREF="<?PHP echo $stylesheet;?>" TYPE="text/css">
</head>
<BODY color="#0c4a7d">



<?PHP //displayLMHeader();
if ($_action=="Send")
{
echo $addedinfo;
echo $message;
}
ELSE
{
?>
<FORM action="showmessage.php" method="GET">
<Table class="maintable"><TH colspan="2" class="VenueHdr">Preliminary Information for Submission to Media <BR>for <?PHP echo $venuename; ?></th>
<TR><TD>
<?
$media="http://www.louisvillemusicnews.net/eventediting/usermedialist.php?user_id=".$user_id."";
include("$media");?>



</td></tr>
<TR><TD class="VenueHdr">Include any added comments here:</td>
</tr>
<tr><td>
<textarea cols="75" rows="8" name="addedinfo" align="Left"></textarea>
</td></tr>
<TR><TD class="VenueHdr">Current Show Information to Send:
<textarea cols="75" rows="<?PHP echo $numformrows;?>" name="" align="Left" READONLY><?php echo $message;?></textarea></td><TD></td></tr>
<TR><TD colspan="3" align="center"></td></tr>
</table>
<TR><TD colspan="3" align="center"><input type="submit" name="submit" value="Send"></td></tr>
</form>
<?}?>
