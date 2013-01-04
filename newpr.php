<?PHP
session_start();
require ("/inks/functions.php");
include ("/inks/LMHeader.inc");
// SET VARIABLES ------------------------------------------------------------------
$stylesheet="http://www.louisvillemusicnews.net/eventediting/venueedit.css";
global $typebreak;
Global $message;
$typebreak="\n";
$readonlytext="READONLY";
// END OF SET VARIABLES ------------------------------------------------------------------

// DEFINE FUNCTIONS ------------------------------------------------------------------
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
$venueinfo .=$typebreak;
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
function scheduleinfo($MainEVID,$message,$typebreak,$status,$sent2media)
{
GLOBAL $message;
include("/inks/LMHeader.inc");
$sql="SELECT Acts.ActName, OldActs.ActName AS OldActName, Stages.StageName, OldStages.StageName AS OldStageName, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, ScheduleOfEvents_Old.Stime as OldStime, ScheduleOfEvents_Old.Etime as OldEtime, MAX(ScheduleOfEvents_Old.sent2media) AS oldsent2media, ScheduleOfEvents.sent2media
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
WHERE ScheduleOfEvents.MainEVID='$MainEVID' 
GROUP BY ScheduleOfEvents.ScheduleID;";

$schedresult=@mysql_query($sql,$connection4) OR DIE ("Unable to run query on MainEVID=".$MainEVID."");
$scheds=@mysql_fetch_array($schedresult);

DO
{

If ($status=="DE")
{
$message .=$typebreak;
		if ($scheds["ActName"]<>"")
		{
		$message .=$scheds["ActName"]." <-------------CANCELLED";
		}
}
ELSE
{

//if ($sent2media=='0000-00-00')//Current record has not been sent
//{
	if ($scheds["oldsent2media"]==NULL) // THERE IS NO OLD RECORD, print the act name and other info
	{
		if ($scheds["ActName"]<>"")
		{
		$message .="Act Name: ";
		$message .=$scheds["ActName"];
		}

		if ($scheds["StageName"]==NULL)
		{
		}
		ELSE// Print the Stage Name
		{
		$message .="   Stage: ".$scheds["StageName"];
		}
			if ($scheds["Stime"]==NULL)
		{
		}
		ELSE
		{
		$message .="   Start: ".$scheds["Stime"]." ";
		}
		IF ($scheds["Etime"]==NULL)
		{
		}
		ELSE
		{
		$message .="End:  ".$scheds["Etime"]." ";
		}
		$message .=$typebreak;
	}
	ELSE // THERE IS AN OLD RECORD
	{
		$message .=$typebreak;
		if ($scheds["ActName"]<>"")
		{
		$message .="Act Name: ".$scheds["ActName"]."<---- CHANGED  ";
		}
		if ($scheds["StageName"]==NULL)// No Stage
		{
			if ($scheds["OldStageName"]==NULL)//No Stage
			{
			}
			ELSE// Old Stage
			{
			$message .=$typebreak."Stage: No New Stage Assignment - Old Stage was  ".$scheds["OldStageName"];

			}
		}
		ELSE// Print the Stage Name
		{
		if ($scheds["OldStageName"]==NULL)// No Old Stage
			{
			$message .=$typebreak."     Stage: ".$scheds["StageName"]."<--- New stage assignment";
			}
			ELSE// Is old stage
			{
			$message .=$typebreak."     Stage: ".$scheds["StageName"]."<--- Changed. Old Stage Assignment was  ".$scheds["OldStageName"];
 	
			}
		}
		if ($scheds["Stime"]==NULL)// No Start Time
		{
			If ($scheds["OldStime"]==NULL) // No old start Time
			{
			}
			ELSE // Is Old start Time
			{
			$message .=$typebreak."    No new Start time has been set - old start was  ".$scheds["OldStime"];
			}
		}
		ELSE// There is a start time
		{
			If ($scheds["OldStime"]==NULL)// No Old Start Time
			{
			$message .=$typebreak."    Start: ".$scheds["Stime"]." ";
			}
			ELSE// Is old start time
			{
			$message .="     Start: ".$scheds["Stime"]."<--Changed.";
			$message .="     Old start was  ".$scheds["OldStime"];
			$message .=$typebreak;
			}// end old start
		}//end of start time
	$message .=$typebreak;
	}// End of is Old Record
}// END of sent2media ==0000-00-00
//ELSE// Sent2media<>'0000-00-00
//{// INFO HAS BEEN SENT, Print Nothing
//}
//} // end of $scheds fetch

}
WHILE ($scheds=@mysql_fetch_array($schedresult));
@mysql_close($connection4);
}//END OF SCHEDULE FUNCTION

// END OF DEFINE FUNCTIONS ------------------------------------------------------------------------
//add in password protection function here.
//BEGIN MAIN FORM
//$where="(MainEvents.VenueID='$validvenue' AND (MainEvents.status='OK' OR MainEvents.status='DE') AND (MainEvents.sent2media='0000-00-00'))";

$prstatus="(MainEvents.status='OK' OR MainEvents.status='DE')";
$where="(MainEvents.VenueID=$validvenue AND MainEvents.EventDate>=CurDate() AND $prstatus";
	IF ($sendwhat=="Resend All")
	{
	session_register("sendwhat");
	$where .=")";
	$send2media="0000-00-00";
	}
	ELSEIF ($sendwhat=="Not Sent")
	{
	session_register("sendwhat");
	$where .=" AND (MainEvents.sent2media='0000-00-00'))";
	}
	ELSEIF ($sendwhat==NULL)
	{
	$where .=" AND (MainEvents.sent2media='0000-00-00'))";
	}


$sqlchanged="SELECT MainEvents.MainEVID, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, MainEvents.sent2media, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.DoorsOpen, MainEvents.EventStart, MainEvents.EventEnd, DATE_FORMAT(MainEvents.onsaledate, '%W, %M %e, %Y') as SDate, MainEvents.Prices, MainEvents.onsaledate, MainEvents.status, AgeRestrictions.AgeRestriction, MainEvents.VenueID as venueid, MainEvents.sponsor, MainEvents.status, MainEvents_Old.oldmainevid as oldevid, MainEvents_Old.EventTitle AS OldEventTitle, MainEvents_Old.DoorsOpen AS OldDoorsOpen, MainEvents_Old.EventStart as OldEventStart, MainEvents_Old.Prices AS OldPrices, MainEvents_Old.onsaledate AS Oldonsaledate, OldAges.AgeRestriction AS OldAgeRestriction
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
LEFT JOIN MainEvents_Old 
ON MainEvents.MainEVID=MainEvents_Old.MainEVID
LEFT JOIN AgeRestrictions As OldAges
ON MainEvents.AgeLimits=OldAges.AgeCodeID
WHERE $where
ORDER BY MainEvents.EventDate";

$result=@mysql_query($sqlchanged,$connection4) or die ("Couldn't run the publicity query");
$shows=@mysql_fetch_array($result);
$numshows=@mysql_numrows($result);
$numformrows=($numshows*(3.2))+6;
getvenueinfo($validvenue,$typebreak);
$message=$venueinfo;
//---------------------------------------------------------Begin selection of shows to send ------------------
DO
{// start of DO LOOP
	$MainEVID=$shows["MainEVID"];
	if ($shows["oldevid"]==NULL)//There is no old record
	{
		 if ($shows["status"]=="DE")
		 {
		 $message .=$typebreak;
		 $message .="-----------------This Show has been CANCELLED------------------\n";
		 $message ."___________________________________\n";
		 $message .=$typebreak;
		 $message .=$shows["FDate"];
 		 $message .=$typebreak;
		 $MainEVID=$shows["MainEVID"];
			if ($shows["EventTitle"]<>"")
			{
			$message .=$typebreak;
			$message .="Event Title: ".$shows["EventTitle"]."  <------CANCELLED";
			}
			ELSE
			{
			}

			$status=$shows["status"];
			 scheduleinfo($MainEVID,$message,$typebreak,$status,$sent2media);
		 }
		 ELSE// STATUS IS OK
		 {
  		$message .=$typebreak;
		$message .="__________________________\n";
		$message .-$typebreak;
 		$message .=$shows["FDate"];

		if ($shows["EventTitle"]<>"")
		{
		$message .=$typebreak;
		$message .="Event Title: ".$shows["EventTitle"];
		}
		ELSE
		{
		}
		if ($shows["Sponsor"])
		{
		$message .=$typebreak;
		$message .="Sponsor: ".$shows["Sponsor"];
		}
		ELSE
		{
		}
		
		if ($shows["Prices"]<>"")
		{
 		$message .=$typebreak;
		$message .="Admission: ".$shows["Prices"];
		}
		ELSE
		{

		}
	 if ($shows["EventStart"]<>"")
		{
		
		$message .=$typebreak;
		$message .="Start: ".$shows["EventStart"];
		}
		ELSE
		{
		}
		If ($shows["DoorsOpen"]<>"")
		{
		$message .=$typebreak;
		$message .="Doors: ".$shows["DoorsOpen"];
		}
		ELSE
		{
		}
		if ($shows["onsaledate"]=='0000-00-00')
		{
		}
		ELSE
		{
		$message .=$typebreak;
		$message .="On Sale: ".$shows["onsaledate"];
		}
		
		if ($shows["AgeRestriction"]<>"")
		{
		$message .=$typebreak;
		$message .="Age Limits: ".$shows["AgeRestriction"];
		$message .=$typebreak;
		}
		ELSE
		{
		}
		
		
		$MainEVID=$shows["MainEVID"];
		$status=$shows["status"];
		scheduleinfo($MainEVID,$message,$typebreak,$status,$sent2media);
		}
	
	}
	ELSE// There is an old record
	{
	 if ($shows["status"]=="DE")
		 {
		 $message .=$typebreak;
		 $message .="-----------------This Show has been CANCELLED------------------\n";
		 $message ."___________________________________\n";
		 $message .=$typebreak;
		 $message .=$shows["FDate"];
 		 $message .=$typebreak;

			if ($shows["EventTitle"]<>"")
			{
			$message .=$typebreak;
			$message .="Event Title: ".$shows["EventTitle"]."  <----CANCELLED";
			}
			ELSE
			{
			}
			$MainEVID=$shows["MainEVID"];
			$status=$shows["status"];

			scheduleinfo($MainEVID,$message,$typebreak,$status,$sent2media);
		 }
		 else
		 {
		$message .=$typebreak;
		$message ."___________________________________\n";
		$message .=$typebreak;
		$message .=$shows["FDate"];
 		$message .=$typebreak;
			if ($shows["EventTitle"]<>"")
			{
				if ($shows["OldEventTitle"]==$shows["EventTitle"])
				{
				$message .=$typebreak;
				$message .="Event Title: ".$shows["EventTitle"];
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Event Title: ".$shows["EventTitle"]."<---Changed; was  ".$shows["OldEventTitle"];
				}
				}
				ELSE
				{
				}
				if ($shows["Sponsor"]<>"")
				{
				if ($shows["OldSponsor"]==$shows["Sponsor"])
				{
				$message .=$typebreak;
				$message .="Sponsor: ".$shows["Sponsor"];
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Sponsor: ".$shows["Sponsor"]."<--- Changed; was  ".$shows["OldSponsor"];
				}
				}
				ELSE
				{
				}

			if ($shows["Prices"]==NULL)
			{
				if ($shows["OldPrices"]==$shows["Prices"])
				{
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Price information has changed but is not available. was   ".$shows["OldPrices"];
				}
			}
			ELSE//There are prices
			{
				if ($shows["OldPrices"]==$shows["Prices"])
				{
				$message .=$typebreak;
				$message .="Admission: ".$shows["Prices"];
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Admission: ".$shows["Prices"]."<--Changed; was ".$shows["OldPrices"];
				}
		
			 }
			  if ($shows["EventStart"]<>"")
			 {
			 	If ($shows["OldEventStart"]==$shows["EventStart"])
				{
				 $message .=$typebreak;
				 $message .="Start: ".$shows["EventStart"];
				 }
				 ELSE
				 {
				 $message .=$typebreak;
				 $message .="Start: ".$shows["EventStart"]."<---Changed; was  ".$shows["OldEventStart"];
				 }
			 }
			 ELSE
			 {
			 }
			If ($shows["DoorsOpen"]<>"")
			{
				IF ($shows["OldDoorsOpen"]==$shows["DoorsOpen"])
				{
				$message .=$typebreak;
				$message .="Doors: ".$shows["DoorsOpen"];
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Doors: ".$shows["DoorsOpen"]."  <--Changed; was  ".$shows["OldDoorsOpen"];
				}
			}
			ELSE
			{
				IF ($shows["OldDoorsOpen"]==$shows["DoorsOpen"])
				{
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="Doors: ".$shows["DoorsOpen"]."  <--Changed; was  ".$shows["OldDoorsOpen"];
				}
		
		
			}
			if ($shows["onsaledate"]=='0000-00-00')
			{
				if ($shows["Oldonsaldedate"]<>'0000-00-00')
				{
				$message .=$typebreak;
				$message .="On Sale : <-- Changed but not available; was  ".$shows["onsaledate"];
				}
				ELSE
				{
				}
			}
			ELSE//.There is an onsale date
			{
			
				if ($shows["Oldonsaldedate"]<>'0000-00-00')
				{
				$message .=$typebreak;
				$message .="On Sale: ".$shows["onsaledate"]."  <---Changed; was  ".$shows["Oldonsaledate"];
				}
				ELSE
				{
				$message .=$typebreak;
				$message .="On Sale: ".$shows["onsaledate"];
				}
			}
				if ($shows["AgeRestriction"]<>"")
				{
					If ($shows["OldAgeRestriction"]==$shows["AgeRestriction"])
					{
					$message .=$typebreak;
					$message .="Age Limits: ".$shows["AgeRestriction"];
					$message .=$typebreak;
					}
					ELSE
					{
					$message .=$typebreak;
					$message .="Age Limits: ".$shows["AgeRestriction"]."  <----Changed; was  ".$shows["OldAgeRestriction"];
					$message .=$typebreak;
					
					}
				}
				ELSE// there are no age limits determined
				{
					If ($shows["OldAgeRestriction"]==$shows["AgeRestriction"])
					{
					}
					ELSE
					{
					$message .=$typebreak;
					$message .="Age Limits: <----Changed; was  ".$shows["OldAgeRestriction"];
						$message .=$typebreak;
					}
			}
		}
		
			$MainEVID=$shows["MainEVID"];
			$status=$shows["status"];

			 scheduleinfo($MainEVID,$message,$typebreak,$status,$sent2media);
	}
}
WHILE ($shows=@mysql_fetch_array($result));

?>




<LINK REL=stylesheet HREF="<?PHP echo $stylesheet;?>" TYPE="text/css">
</head>
<BODY class="venueeditbody">



<?
//displayLMHeader();
if ($_action=="Send")
{

$wholemessage=$addedinfo;
$wholemessage .=$typebreak;
$wholemessage .=$message;
include("/inks/LMhdrw.inc");
$sendersql="SELECT fname,lname,salutation, venueid,actid, email FROM lmuser WHERE user_id='$user_id'";
$senderresult=@mysql_query($sendersql,$connection4) OR DIE ("Couldn't select user information for email");
$senderinfo=@mysql_fetch_array($senderresult);
DO
{
$fname=$senderinfo["fname"];
$lname=$senderinfo["lname"];
$salutation=$senderinfo["salutation"];
$from_email=$senderinfo["email"];
$venueid1=$senderinfo["venueid"];
$actid1=$senderinfo["actid"];
$from_name=$fname;
$from_name .=" ";
$from_name .=$lname;
}
WHILE($senderinfo=@mysql_fetch_array($senderresult));


	if ($venuename)
	{
	$frombusiness=$venuename;
	}
	ELSEIF ($actname)
	{
	$frombusiness=$actname;
	}
	ELSE
	{
	$from_name .=" ".$frombusiness;
	}
	if ($_GET)
	{
	reset ($_GET);
	   while (list ($key, $val) = each ($_GET)) 
		{
			if ($key=="thisemail")
			{
			$thismedia=$val;
			$mailsql="SELECT * FROM mediaemail WHERE mediaemailid='$thismedia'";
			$mailresult=@mysql_query($mailsql,$connection4) OR DIE ("Couldn't connection for mail");
			$mail=@mysql_fetch_array($mailresult);
				DO
				{
				$to_email=$mail["emailaddress"];
				$to_name=$mail["contactname"]." - ".$mail["title"]." ".$mail["businessname"];
				$subject="Live Events Listing";
				send_mail($to_name, $to_email, $from_name, $from_email, $subject, $wholemessage);
				}
				WHILE ($mail=@mysql_fetch_array($mailresult));
			}
			ELSE
			{
			}
		}
	}
include ("/inks/LMHeader.inc");
$sentdate=date("Y-m-d");
$resetsent2media="SELECT MainEVID FROM MainEvents WHERE (VenueID='$validvenue' AND sent2media='0000-00-00') ";
$media=@mysql_query($resetsent2media,$connection4) OR DIE ("Unable to select to be sent publicity for Venue =".$validvenue."");
$sent=@mysql_fetch_array($media);
	DO
	{
	$MainEVID=$sent["MainEVID"];
	$sql="UPDATE ScheduleOfEvents SET sent2media='$sentdate' WHERE 	ScheduleOfEvents.MainEVID='$MainEVID'";
	$result=@mysql_query($sql,$connection4) OR DIE ("Unable to reset sent2media for schedules with MainEVID =".$MainEVID."");
	}
	WHILE ($sent=@mysql_fetch_array($media));
	include ("/inks/LMHeader.inc");
$resetmainevents2media="UPDATE MainEvents SET sent2media='$sentdate' WHERE (VenueID='$validvenue' and sent2media='0000-00-00')";
$result=@mysql_query($resetmainevents2media,$connection4) OR DIE ("Unable to reset sent2media for Mainevents for Venue =".$validvenue."");
mysql_close($connection4);
	

?><Table class="maintable"><TH colspan="2" class="VenueHdr">Publicity Successfully Sent for <?PHP echo $venuename; ?> </TH>
<tr><TD colspan="3" align="center">

<?
$value="Return";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;&nbsp;
<?
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);?></td></tr>
</table>
<?PHP session_unregister("sendwhat");
}
ELSE
{
?>
<FORM action="<?PHP echo $PHP_SELF;?>" " method="GET">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue; ?>"><Table class="maintable">
<TH colspan="3" class="VenueHdr">Preliminary Information for Submission to Media <BR>for <?PHP echo $venuename; ?></th>
<TR><TD>
<?
$media="http://www.louisvillemusicnews.net/eventediting/usermedialist.php?user_id=".$user_id."";
include("$media");?>

</td></tr>
<TR><TD class="VenueHdr">Include any added comments here:</td>
</tr>
<tr><td>
<textarea cols="75" rows="8" name="addedinfo" align="Left">
<?PHP 
if ($sendwhat=="Resend All")
{
echo "Some or all of the following dates have been submitted previously.\n\n";
}
?></textarea>
</td></tr>
<TR><TD class="VenueHdr">Current Show Information to Send:
<?PHP if ($readonly=="")
{
echo "<BR>You may alter the information you are going to email below but it will not be saved in the Louisville Music database.";
}
ELSE
{
}?>
<textarea cols="75" rows="<?PHP echo $numformrows;?>" name="" align="Left" <?PHP echo $readonlytext; ?>><?php echo $message;?></textarea></td><TD></td></tr>
<TR><TD colspan="3" align="center"></td></tr>
<TR><TD colspan="3" align="center">
<?
$type="submit";
$name="submit";
$value="Send";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;&nbsp;
<?
$type="submit";
$name="submit";
$value="Resend All";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;&nbsp;
<?
$value="Cancel";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;&nbsp;
<?PHP $OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);?>
</td></tr>
</table></form>
<?}
?>