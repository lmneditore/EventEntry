<?PHP
session_start();
require ("functions.php");
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

function getoldacts($thisschedid)
{
global $oldActName;
global $oldstime;
global $oldstatus;
if ($thisschedid)
{
include ("/inks/LMHeader.inc");

$sqloldsched="SELECT ScheduleOfEvents_Old.Stime, Acts.ActName, ScheduleOfEvents_Old.ScheduleID as oldschedid, ScheduleOfEvents_Old.status as oldstatus
FROM ScheduleOfEvents_Old
LEFT JOIN Acts
ON ScheduleOfEvents_Old.ActID=Acts.ActID
WHERE (ScheduleOfEvents_Old.ScheduleID='$thisschedid' AND ScheduleOfEvents_Old.sent2media<>'0000-00-00')
ORDER BY oldschedid DESC";
$schedresult=@mysql_query($sqloldsched,$connection4) OR DIE ("Couldn't complete Schedule query where ScheduleID");
$scheds=@mysql_fetch_array($schedresult);
$numrows=@mysql_num_rows($schedresult);
$i=0;
Do
{   
if ($i==($numrows-1))
{
}
ELSE
{
    IF ($i==0)
    {
$oldActName=$scheds["ActName"];
$oldstime=$scheds["Stime"];
$oldschedid=$scheds["oldschedid"];
$oldstatus=$scheds["oldstatus"];
$i=$i+1;
    }
    ELSE
    {
    $i=$i+1;
    }
}
}
WHILE (@mysql_fetch_array($schedresult));
mysql_close($connection4);
}
}

//add in password protection function here.
//################################################Begin make Publicity Display#####################
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

$sqlchanged="SELECT MainEvents.MainEVID, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents.sent2media, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.DoorsOpen, MainEvents.EventStart, MainEvents.EventEnd, DATE_FORMAT(MainEvents.onsaledate, '%W, %M %e, %Y') as SDate, MainEvents.Prices, MainEvents.onsaledate, MainEvents.status, AgeRestrictions.AgeRestriction, MainEvents.VenueID as venueid, ScheduleOfEvents.Stime, Acts.ActName, MainEvents.sponsor, MainEvents.status, ScheduleOfEvents.ScheduleID, MainEvents_Old.oldmainevid as oldevid
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN ScheduleOfEvents
ON MainEvents.MainEVID=ScheduleOfEvents.MainEVID
LEFT JOIN Acts
On ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
LEFT JOIN MainEvents_Old 
ON MainEvents.MainEVID=MainEvents_Old.MainEVID
WHERE $where
ORDER BY MainEvents.EventDate, ScheduleOfEvents.ProgramOrder,ScheduleOfEvents.Stime";

$result=@mysql_query($sqlchanged,$connection4) or die ("Couldn't run the publicity query");
$shows=@mysql_fetch_array($result);
$numshows=@mysql_numrows($result);
$MainEVID="0";
$numformrows=($numshows*(3.2))+6;
getvenueinfo($validvenue,$typebreak);
$message=$venueinfo;
//-Begin selection of shows to send --
DO
{// start of DO LOOP

  if ($shows["MainEVID"]==$MainEVID)//Begin check for MainEVID status
    {//SAME SHOW Print info about schedules
            if ($thisschedid>0)
            {
            getoldacts($thisschedid);
            }
            ELSE
            {
            }
			$message .=$typebreak;
           $message .= "Act Name:.....".$shows["ActName"]; 
           if ($oldActName<>"")
           {
              if ($oldActName==$shows["ActName"])
              {
             $message .$typebreak;
              }
             ELSE
             {
             $message .="   <- Changed - Was: ".$oldActName;
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
    {//MainEVID HAS CHANGED - Begin Assembling message or add new item-

               $message .=$typebreak.$typebreak;

         if ($oldmainevid>0)//There is a prior submission
		 {
         getoldmainevents($MainEVID);// 
			 if ($shows["status"]=="DE")
			 {
			 $message .="-DELETED--";
			 }
			 ELSE // There is a record and status <> DE
			 {

			$message .="<-New Event Item-";

			 //code here. Read record and display all info w added notation
			 //******************************************************************************************
	 		 $message .=$typebreak;
			 }// Put Event Date first
			 if ($shows["EventDate"]<>'0000-00-00')
			 {
             $message .= "Event Date:....";
             $message .= $shows["FDate"];
			 }
//           $message .=$typebreak;
                if ($shows["TypeofEvent"])
                {
                $message .=$typebreak."Event Type:....";
                $message .=$shows["TypeofEvent"];
                } 

                if ($shows["EventTitle"]<>"")// If there is an Event Title
                {
                $message .=$typebreak."Title:..............";
                $message .=$shows["EventTitle"]."\n";// print the title
				}

                if ($shows["status"]=="DE")
				{
				$message .="<--DELETED -";
				}

 				if ($shows["SeriesTitle"]<>"")
			    {
	            $message .=$typebreak."Series Title:...";
	            $message .=$shows["SeriesTitle"];
				}

			    if ($shows["sponsor"])
			    {
			    $message .=$typebreak."Sponsor:...";
			    $message .=$shows["sponsor"];
		        }

		        If ($shows["Prices"])
		        {
		        $message .=$typebreak."Admission:.....";
	            $message .=$shows["Prices"];
		        }

		        if ($shows["AgeRestriction"]."\n")
		        {
		        $message .=$typebreak."Age Limits:....";
		        $message .=$shows["AgeRestriction"];
 		        }

		        if ($shows["EventStart"])
			    {
		        $message .=$typebreak."Event Start:....";
		        $message .=$shows["EventStart"];
				}

 		        If ($shows["DoorsOpen"]<>"")
			    {
		        $message .=$typebreak."Doors Open:..";
			    $message .=$shows["DoorsOpen"];
		        }

		        IF ($shows["EventEnd"]<>"")
		        {
		        $message .=$typebreak."Event End:.....";
			    $message .=$shows["EventEnd"];
		        }

                IF ($shows["onsaledate"]<>("0000-00-00"))
 			    {
			    $message .=$typebreak."On Sale:........";
			    $message .=$shows["SDate"];
		        }
				
				
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%   Schedule Starts Here  %%%%%%%%%%%%%%%%%%%
		        $thisschedid=$shows["ScheduleID"];
     
     if ($shows["ScheduleID"]>0)
     {
	      if ($shows["ActName"])
	      {
		  $message .=$typebreak."Act Name:.....";
	      $message .=$shows["ActName"];
		  }
	      if ($shows["Stime"])
	      {
	      $message .=" - ".$shows["Stime"];
	      }

      }
     ELSE// THERE IS NO SCHEDULE ITEM ATTACHED TO THIS RECORD
     {
     }
			 //******************************************************************************************

		 }
		 ELSE//There is a prior record and publicity has been sent
		 {
 		 $message .= "-Changed Item--";
		 $message .=$typebreak;
		 }
               $message .= "Event Date:....";
               $message .= $shows["FDate"];
			   if ($olddate<>"0000-00-00")
			   {
		           if ($olddate==$shows["EventDate"])
		           {
		           }
		           ELSE
		           {
						if ($shows["status"]=="DE")
						{
						$message .=" <-- DELETED--";
				   		}
						ELSE
						{
		 	            $message .=" <-- Changed - Was: ".$oldfdate;
						$oldfdate="";
						}
			            }
		       }
//          $message .=$typebreak;
       if ($shows["TypeofEvent"])
       {
       $message .=$typebreak."Event Type:....";
       $message .=$shows["TypeofEvent"];
       }
	   
	   
       if ($shows["EventTitle"]<>"")// If there is an Event Title
       {
           $message .=$typebreak."Title:..............";
           $message .=$shows["EventTitle"];// print the title
			if ($shows["status"]=="DE")
			{
			$message .="<--DELETED -";
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
			             $message .="  <- Changed - Was: ".$oldtitle;
		                }
				}
                ELSE//There was no title
                {
             $message .="  <-- was added\n";;
				}
    //        $message .=$typebreak;
			}
       }

      if ($shows["SeriesTitle"]<>"")
      {
           $message .=$typebreak."Series Title:...";
           $message .=$shows["SeriesTitle"];
      }

      if ($shows["sponsor"]<>"")
      {
      $message .=$typebreak."Sponsor:...";
      $message .=$shows["sponsor"];
        if ($oldsponsor<>"")
        {
            if ($oldsponsor==$shows["sponsor"])
            {
            }
            ELSE
            {
            $message .="   <- Changed - Was: ".$oldsponsor;
            }
         }
		 ELSE
		 {
            $message .="   <- Was Added";
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
		       $message .="  <-- Changed - Was: ".$oldprices;
		       }
	       }
 //      $message .=$typebreak;
       if ($shows["AgeRestriction"])
       {
       $message .=$typebreak."Age Limits:....";
       $message .=$shows["AgeRestriction"];
	   }
	       If ($oldages)
	       {
		       if ($oldages==$shows["AgeRestriction"])
		       {
		       }
		       ELSE
		       {
		       $message .="   <-- Changed - Was: ".$oldages;
		       }
	       }
    //   $message .=$typebreak;
       }
      if ($shows["EventStart"])
      {
      $message .=$typebreak."Event Start:....";
      $message .=$shows["EventStart"];
      if ($oldstart<>"")
      {
	      if ($oldstart==$shows["EventStart"])
	      {
	      }
	      ELSE
	      {
	      $message .="   <- Changed - Was: ".$oldstart;
	      }
      }
	  ELSE
	  {
	      $message .="   <- Was added";
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
		      $message .="   <- Changed - Was: ".$olddoors;
		      }
	      }
		  ELSE
		  {
 	      $message .="   <- Was added";
		  }
 //     $message .=$typebreak;
      }

      IF ($shows["EventEnd"]<>"")
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
		      $message .="   <- Changed - Was: ".$oldsdate;
		      }
	      }
		  ELSE
		  {
  	      $message .="   <- Was added\n";
		  }
  //    $message .=$typebreak;
      }
	  //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  Start Schedule Check @@@@@@@@@@@@@@@@@@@@@
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
         IF ($oldActName<>"")
         {
             if ($oldActName==$shows["ActName"])
             {
             }
             ELSE 
            {
            $message .="   <- Changed - Was: ".$oldActName;
            }
         }
		 ELSE
		 {
	      $message .="   <- Was added\n";
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
             $message .="   <- Changed - Was: ".$oldstime;
             }
         }
		 ELSE
		 {
 	      $message .="   <- Was added";
		 }
 //     $message .$typebreak;
      }

      $MainEVID=$shows["MainEVID"]; 


    }//End of MainEVID Check


}// end of DO Loop
WHILE ($shows=@mysql_fetch_array($result));
session_register("message");
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
<Table class="MainTable"><TH colspan="2" class="VenueHdr">Preliminary Information for Submission to Media <BR>for <?PHP echo $venuename; ?></th>
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
