<?PHP
session_start();
//require ("functions.php");
//require ("editvars.php");

if (!isset($_action))
{
	If($MainEVID=="")
	{
	$_action="New";
	}
	
}
ELSEIF ($_action="EditThisEvent")
	{
	$_action="Edit";
	}
	/*
if ($_action=="Return To This Event")
{
$_action="Edit";
session_unregister("EventStart");
session_unregister("EventEnd");
session_unregister("thisstage");
session_unregister("thisActName");
session_unregister("thisprogramorder");
session_unregister("thisstageid");
session_unregister("thisActID");
session_unregister("status");
session_unregister("AgeLimits");
session_unregister("AgeLimits1");
session_unregister("onsaledate1");
session_unregister("eventMonth");
session_unregister("thisschedid");
unset($thisschedid);
unset($thisactname);
unset($thisactid);
unset($status);
unset($EventStart);
unset($EventEnd);
unset($onsaledate1);
unset($thisstage);
}
ElSE
{
}
*/
// Sections 
// 1. Update
// 2. Delete
// 3. Final Delete
// 4. New
// 5. Add
// 6. Accept
// 7. Edit
// 8. Nothing to Do
// set text colors
$defaulttext="black";
$changedtext="red";

// section to combine event date parts --------------------------------
if (isset($eventMonth))
{
     if ($eventMonth=="0" || $eventDay=="00" || $eventMonth=="00" || $eventDay=="0")
     { 
     $EventDate=$EventDate1;
     }
     ELSE
     {
         If (strlen($eventDay)==1)
         {
         $eventDay="0".$eventDay;
         }
          ELSE 
         {
         }

         If (strlen($eventMonth)==1)
        {$eventMonth="0".$eventMonth;
         }
         ElSE 
        {
        }
     $EventDate1=$eventYear."-".$eventMonth."-".$eventDay;
     }
}
ELSE
{
$EventDate1=$EventDate;
}
if ($EventDate1==$EventDate)
{
$textcolordate=$defaulttext;
}
ELSE
{
$EventDate=$EventDate1;
$textcolordate=$changedtext;
}


// Section to combine event start time parts into one piece
if ($thiseventhour1 || $thiseventminute1 || $thiseventampm1)
{
$EventStart1=$thiseventhour1.":".$thiseventminute1." ".$thiseventampm1;
}
// combine door time parts into one
if ($DoorsOpenhour1 || $DoorsOpenminute1 || $DoorsOpenampm1)
{
$DoorsOpen1=$DoorsOpenhour1.":".$DoorsOpenminute1." ".$DoorsOpenampm1;
}
// combine event end time parts into one
if($thiseventendhour1 || $thiseventendminute1 || $thiseventendampm1)
{
$EventEnd1=$thiseventendhour1.":".$thiseventendminute1." ".$thiseventendampm1;
}


//combine On Sale date parts
    if ($SaleDay=="0" OR $SaleMonth=="0" OR $SaleDay=="00" OR $SaleMonth=="00")
    {
    }
    ELSE
    {
        if (strlen($SaleDay)==1)
           {$SaleDay="0".$SaleDay;
           }
           ELSE
           {
		   }
               if (strlen($SaleMonth)==1)
               {$SaleMonth="0".$SaleMonth;
               }
               ELSE
               {
               }
 $onsaledate1=$SaleYear."-".$SaleMonth."-".$SaleDay;
      if ($onsaledate1=="--")
    {$onsaledate1=$onsaledate;
    }
    ELSE {}
//set onsaledate date text color
    If ($onsaledate1)
    {
        IF ($onsaledate1==$onsaledate)
        {$textcoloronsaledate=$defaulttext;}
        ELSE
       {$onsaledate=$onsaledate1;
       $textcoloronsaledate=$changedtext;
	   }
     }
   ELSE
   {$textcoloronsaledate=$defaulttext;
   $onsaledate=$onsaledate;
   }
   }
// set event start color
If ($EventStart1)
{
    IF ($EventStart1==$EventStart)
    {$eventtimecolor=$defaulttext;
	}
    ELSE
    {$EventStart=$EventStart1;
    $eventtimecolor=$changedtext;
    }
}
ElSE
{  $eventtimecolor=$defaulttext;
}
// set eventend text colro
if($EventEnd1)
{
   IF ($EventEnd1==$EventEnd)
   {$eventendtimecolor=$defaulttext;}
   ELSE
   {$EventEnd=$EventEnd1;
   $eventendtimecolor=$changedtext;
   }
}
// set door open text color
If ($DoorsOpen1)
{
    IF ($DoorsOpen1==$DoorsOpen)
    {$doortimecolor=$defaulttext;}
    ELSE
    {
	$DoorsOpen=$DoorsOpen1;
    $doortimecolor=$changedtext;
    }
}
ElSE
{
{$doortimecolor=$defaultext;}
}

// set age code text color
if ($AgeLimits1)
{
    if ($AgeLimits1==$AgeLimits)
    {
    $agecodetext=$defaulttext;
    }
    ELSE 
    {
    $agecodetext=$changedtext;
    $AgeLimits=$AgeLimits1;
    }
}
ELSE
{
$agecodetext=$defaulttext;
}

if ($EventTitle1)
{
    if ($EventTitle1==$EventTitle)
    {$textcolortitle=$defaulttext;
    }
    ElSE
    {
    $EventTitle=$EventTitle1;
    $textcolortitle=$changedtext;
    }
}
ELSE
{
$textcolortitle=$defaulttext;
}

if ($sponsor1)
{
    if ($sponsor1==$sponsor)
    {$textcolorsponsor=$defaulttext;
	$sponsor=$sponsor1;
    }
    ElSE
    {
    $sponsor=$sponsor1;
    $textcolorsponsor=$changedtext;
    }
}
ELSE
{
$textcolorsponsor=$defaulttext;
}

If ($DoorsOpen1)
{
    IF($DoorsOpen1==$DoorsOpen)
    {$textcolordoor=$defaulttext; 
    }
    ELSE
    {$DoorsOpen=$DoorsOpen1;
    $textcolordoor=$changedtext; 
    }
}
ELSE
{
$textcolordoor=$changedtext; 
}

if ($Prices1)
{

    IF ($Prices1==$Prices)
    {$textcolorprice=$defaulttext;
    }
    ELSE
    {$Prices=$Prices1;
    $textcolorprice=$changedtext; 
    }
}
ELSE
{
$textcolorprice=$defaulttext;
}

if ($DescriptionOfEvent1)
{
    IF ($DescriptionOfEvent1==$DescriptionOfEvent)
    {$textcolordesc=$defaulttext;}
    ELSE
    {$DescriptionOfEvent=$DescriptionOfEvent1;
     $textcolordesc=$changedtext;
    }
}
ELSE
{
{$textcolordesc=$defaulttext;}
}


if ($status1)
{
   IF ($status==$status1)
   
   {$textcolorstatus=$defaulttext;}
   ELSE
   {$status=$status1;
   $textcolorstatus=$changedtext;}
   }
 ELSE
 {
   {$textcolorstatus=$defaulttext;
   }
   
 }
$status=strtoupper($status);

if($thiscontactph1)
{
    if($thiscontactph==$thiscontactph1)
    {
    $textcolorphone=$defaulttext;
    }
    ELSE
    {
    $thiscontactph=$thiscontactph1;
    $textcolorphone=$changedtext;
    }
}


//	IF VALIDVENUE IS NOT SET FILE CANNOT BE OPENED

echo "GOT HERE";

if (!isset($validvenue))
{

$library->displaynoauthorization();
session_unregister;
}
ELSE
{
	
$venueid=$validvenue;
//BEGIN UPDATE
if ($_action=="Update") // begin update loop
{//update loop 
	/*
?>

    <DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
    <div  class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $MainEVID; ?> on <?PHP echo $EventDate;?> & <?PHP echo $DoorsOpen;?></b> </div>
    <div  align="center" style="color:red;">(<I><B>Items in Red Have Been Changed</I></b>)</div>
    <form action="maineventedit.php" method="GET">
    <input type="hidden" name="validvenue" value=<?PHP echo $validvenue;?>">
    <input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
    <div align="right">Event Date:</div><div> 
	<?PHP 
	$BeginYear = 2003; 
	$EndYear = 2008;
	$prefix = "event";
	  
	$library->WriteDateSelect($BeginYear,$EndYear,'',$prefix,$EventDate, $textcolordate);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $EventDate;?>" READONLY size ="10" name="EventDate">
</div>
    <div align="right">Event Title: </div><div align="left"><input type="text" style="color:<?PHP echo $textcolortitle;?>"  name="EventTitle1" value="<?PHP echo $EventTitle;?>" size="50"></div>
     <div align="right">Sponsor Credit: </div><div><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>

 <?PHP//Start, end and door block
 ?>
      <div align="right">Event Start:</div><div>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $eventtimecolor);?></div>
<div align="right">Event End: </div><div align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</div><div align="right">Doors Open:&nbsp;</div><div>
<?PHP
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $doortimecolor);?>
</div>
    <div align="right">Prices:</div><div align="left"> <input type="text" style="color:<?PHP echo $textcolorprice;?>;" name="Prices1" value="<?PHP echo $Prices;?>" size="20"></div>
<div align="right">On Sale Date: </div><div align="left"><input type="text" style="color:<?PHP echo $textcoloronsaledate;?>;" name="onsaledate" value="<?PHP echo $onsaledate;?>" size="12"></div>
    <div align="right">Description:</div><div align="left"> <textarea style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1" cols="20" rows="3"><?PHP echo $DescriptionOfEvent;?></textarea></div>

<!-- new row & Age and status lookup section-->
    <div align=\"left\">Age Restrictions: </div><div align=\"left\">
        <?PHP 
	if ($AgeLimits)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?>
&nbsp;&nbsp;Display Status:&nbsp;&nbsp;
<?PHP $library->statusselectbox($status,$textcolorstatus);
?>

</div> <!-- end of age and status lookup sectiopn -->
    <div align="center" >
	
<?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 $library->inputbutton("submit","submit", "Accept",$OnClick);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
$buttons->$library->lmbackup($value);
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
echo "&nbsp";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp";
$value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
?>
&nbsp;</div>
</form>
    <div colspan="3">
<?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;

     $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 include ($thispix4event);
	 ?>
	<div colspan="3"><?PHP
     include ($thiseventactlist);
?>
</div></DIV>
<?PHP */
    }// BEGIN DELETE
    elseif ($_action=="Delete")//BEGIN DELETE SUBMIT
    {
/*
   //  //Include ("/inks/LMHeader.php");

     session_unregister("AgeLimits1");
     $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.sponsor, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid'
AND MainEVID='$MainEVID')";
     $result = @mysql_query($sql) or die("couldn't execute mainevents delete query.");
    $thisrow = @mysql_fetch_array($result);
    $MainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $EventDate=$thisrow["EventDate"];
    $EventTitle=stripslashes($thisrow["EventTitle"]);
    $EventStart=$thisrow["EventStart"];
	$EventEnd=$thisrow["EventEnd"];
    $DoorsOpen=$thisrow["DoorsOpen"];
    $Prices=stripslashes($thisrow["Prices"]);
    $DescriptionOfEvent=stripslashes($thisrow["DescriptionOfEvent"]);
    $AgeRestriction=$thisrow["AgeRestriction"];
    $AgeLimits=$thisrow["AgeLimits"];
    $onsaledate=$thisrow["onsaledate"];
    $Fdate=$thisrow["FDate"];
	$status=$thisrow["status"];

	 //session_register("venuename","EventDate","EventTitle","EventStart","EventEnd","DoorsOpen","Prices","DescriptionOfEvent","AgeRestriction","onsaledate","Fdate","AgeLimits");
   ?>
    <DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
    <div  class="searchhdr">Main Event Delete Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $MainEVID; ?></b> </div>
    <div  align="center" style="color:red;"><I><B>Are you sure you want to delete this event?</I></b></div>
    <form action="maineventedit.php"  method="GET">
    <input type="hidden" name="validvenue" value=<?PHP echo $validvenue;?>">
    <input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
    <div>Event Date:</div><div> 
<input type="text" style="color:<?PHP echo $textcolordate;?>;" name="EventDate1" value="<?PHP echo $EventDate;?>" size="12">&nbsp;(<?PHP echo $Fdate; ?> )</div>
    <div>Event Title: </div><div><input type="text" color="<?PHP echo $textcolortitle;?> name="EventTitle1" value="<?PHP echo $EventTitle;?>" size="50"></div>
     <div align="right">Sponsor Credit: </div><div><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>

<!--Start, end and door block -->
      <div align="right">Event Start:</div><div>
<?PHP $inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";

$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $eventtimecolor);?></div>
<div align="right">Event End: </div><div align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</div><div align="right">Doors Open:&nbsp;</div><div>
<?PHP
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $doortimecolor);?>
</div>

     <div align="right">Prices:</div><div> <input type="text" style="color:<?PHP echo $textcolorprice;?>;" name="Prices1" value="<?PHP echo $Prices;?>" size="20"></div>
<div align="right">On Sale Date: </div><div align="left"><input type="text" style="color:<?PHP echo $textcoloronsaledate;?>;" name="onsaledate1" value="<?PHP echo $onsaledate;?>" size="12"></div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1"><?PHP echo $DescriptionOfEvent;?></textarea></div>
    <div align="right">Status:</div><div> <?PHP statusselectbox($status,$textcolorstatus);
?></div>
     <div align="right"> Age Restrictions: </div><div>
        <?PHP if ($AgeLimits)
        {
         $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=red";
        include($agelimit);
        }
        ELSE
        {
        include ("agerestrictionlookup.php");
        }?></div>


      <div align="center" >
	  &nbsp;<?PHP $library->inputbutton("submit","submit","Final Delete",$onClick);
$buttons->lmnbutton("Log Out", "","http://www.louisvillemusicnews.net/lmn/members/lmlogout.php","parent.location");
echo "&nbsp;";
$value="Back One";
	  $library->lmbackup($value);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
?>
</div>
</form>
     <div colspan="3">
     <?PHP
	 $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;

      $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 include ($thispix4event);
	 ?><div colspan="3"><?PHP
include ($thiseventactlist);

?>

</div></DIV>
*/
}//BEGIN FINAL DELETE
ELSEIF($_action=="Final Delete")//BEGIN FINAL DELETE 
{
	/*
$status="DE";
////Include ("/inks/LMHeader.php");
// First, delete all schedules of Events

	$sqlremoveitem="SELECT * FROM ScheduleOfEvents WHERE MainEVID='$MainEVID'";
	$deleteschedules=@mysql_query($sqlremoveitem) or die("couldn't Copy Deleted Schedules query.");
$delresult=@mysql_fetch_array($deleteschedules);
	DO
	{
		IF ($delresult["sent2media"]=='0000-00-00')
		{
		}
		ELSE
		{
	    $delMainEVID=$delresult["MainEVID"];
	    $delActID=$delresult["ActID"];
	    $delProgramOrder=$delresult["ProgramOrder"];
	    $delActConfirmed=$delresult["ActConfirmed"];
	    $delstageID=$delresult["StageID"];
	    $delTypeofEvent=$delresult["TypeOfEvent"];
	    $delScheduleID=$delresult["ScheduleID"];
	    $delMainGenre=$delresult["MainGenre"];
	    $delAdmission=$delresult["Admission"];
	    $delStime=$delresult["Stime"];
	    $delEtime=$delresult["Etime"];
	    $delStart=$delresult["Start"];
	    $delEnd=$delresult["End"];
	    $delinput_site=$delresult["input_site"];
		$sent2media=$delresult["sent2media"];
		$datechanged=date("Y-m-d");
		$sqlsaveschedule="INSERT INTO ScheduleOfEvents_Old VALUES ('','$delMainEVID','$delActID', '$delProgramOrder','$delActConfirmed','$delstageID','$delTypeofEvent','$delScheduleID','$delMainGenre','$delAdmission','$delStime','$delEtime','$delStart','$datechanged','$delinput_site','$status','$user_id','$sent2media')";
		$delinsertresult=@mysql_query($sqlsaveschedule) or die("couldn't Save Deleted Schedule query.");
		$sqlitemdel="UPDATE ScheduleOfEvents SET status='$status', sent2media='0000-00-00' WHERE ScheduleID='$delScheduleID'"; 
		$result=@mysql_query($sqlitemdel,$connection4) or die("Couldn't SET status for schedule Item".$delScheduleID."");
		}

}
WHILE ($delresult=@mysql_fetch_array($deleteschedules));

	


updatemainevent($MainEVID,$status);
//Include ("/inks/LMHeader.php");
$sqlmainevent="UPDATE MainEvents SET status='$status', sent2media='0000-00-00' WHERE MainEVID='$MainEVID' LIMIT 1"; 
$result=@mysql_query($sqlmainevent,$connection4) or die("Couldn't SET status and sent2media for this Main Event =".$MainEVID."");


$eventmessage=" A new event has been added to the Louisville Music database:<BR>";

$eventmessage .="Event Date: <B>".$EventDate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$EventTitle."<BR></b>";
$eventmessage .="Start: <B>".$EventStart."<BR></b>";
$eventmessage .="Doors: <B>".$DoorsOpen."<BR></b>";
$eventmessage .="Admission: <B>".$Prices."<BR></b>";
$eventmessage .="Age: <B>".$AgeRestriction."<BR></b>";
$eventmessage .="On Sale: <B>".$onsaledate."<BR></b>";
$eventmessage .="Display Status: <B>".$status."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$sponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$MainEVID."<BR></b>";
$eventmessage .="This event was added by ".$valid_user. " at ".$email."";

$subject="New Event Added";
$message=$eventmessage;
$senderName=$valid_user;
$senderEmail=$email;
$toList="editor@louisvillemusicnews.net";
$eventadded=new email ($subject,            // subject
                    $message,// message body
                    $senderName,                   // sender's name
                    $senderEmail,         // sender's email
                    array($toList), // To: recipients
                    ""      // Cc: recipient
                               );
$eventadded->send();
?>
<div colspan="3" align="center" style="color:red;"><I><B>The Event Has Been Deleted</I></b></div>
<div></div>
      <div colspan="3" align="center"><form>
	  <?PHP   $value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );?>
	  
<!--<INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php'">-->
</form></div>



<?PHP */
     } //BEGIN NEW
     elseif ($_action=="New")
     {
	     /*
      session_unregister("MainEVID");
     session_unregister("thisActID");
     session_unregister("thisprogramorder");
     session_unregister("thisMainGenre");
     session_unregister("thisStageID");
     session_unregister("thistypeofevent");
     session_unregister("thisAdmission");
     session_unregister("thisstime");
     session_unregister("thisetime");
     session_unregister("thisactstatus");
     session_unregister("thisActName");
     session_unregister("thisschedid");
     //Include ("/inks/LMHeader.php");
     $sql="SELECT VenueName, ContactPh, VAgeLimits From Venues WHERE Venues.VenueID='$venueid'";
     $result=@mysql_query($sql) or die("couldn't execute venue NEW query.");
     $name=@mysql_fetch_array($result);
     $venuename=$name["VenueName"];
     $contactph=$name["ContactPh"];
     $AgeLimits=$name["VAgeLimits"];
 ?>
     <DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center"  valign="top">
     <div  class="searchhdr">Add Main Event Form for <B><?PHP echo $venuename;?></b></div>
     <div ><hr width="300" size="1 px" align="center"></div>
     <form action="maineventedit.php" method="GET" style" color: blue"; bgcolor="#f5e3a1">
	 <input type="hidden" name="venueid" value="<?PHP echo $venueid;?>">
     <div>Event Date: </div><div>
     <?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "event";
	  $thistextcolor=$textcolordate;
	$library->WriteDateSelect($startyear,$endyear,'',$prefix,$EventDate, $thistextcolor);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $EventDate;?>" READONLY size ="10" name="EventDate">
      </div>
<?PHP 	 ?><div colspan="3"><?PHP
       include ("http://www.louisvillemusicnews.net/eventediting/eventtypelookup.php");
?>&nbsp;&nbsp;

      <?PHP include ("http://www.louisvillemusicnews.net/eventediting/serieslookup.php");?> 
      </div>
      <div>Contact Phone: </div><div><input type="Text" style="color:<?PHP echo $defaulttext;?>;" name="thiscontactph1" value="<?PHP echo $contactph;?>" size="12"></div>
      <div>Event Title: </div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventTitle1" value="" size="50"></div>
     <div align="right">Sponsor Credit:</div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>


<?PHP//Start, end and door block?>
      <div align="right">Event Start:</div><div>
<?PHP
$thisstime="00:00 PM";
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
$library->timeselectbox($thisstime,$inhour, $inminute,$inampm, $eventtimecolor);?>
</div><div align="right">Event End: </div><div align="left">
<?PHP
$EventEnd="00:00 PM";
$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</div><div align="right">Doors Open:&nbsp;</div><div>
<?PHP

$DoorsOpen="00:00 PM";
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $doortimecolor);?>
</div>


<div>
      Prices:</div><div> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="Prices1" value="" size="20"></div>
<div>On Sale Date: </div><div align="left">
<?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "Sale";
	$library->WriteDateSelect($startyear,$endyear,'',$prefix,$onsaledate,$textcoloronsaledate);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsaledate;?>" value="<?PHP echo $EventDate;?>" READONLY size ="10" name="EventDate">

<!--<input type="text" style="color:<?PHP echo $defaulttext;?>;" name="onsaledate1" value="" size="12"> -->

</div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1"><?PHP echo $DescriptionOfEvent;?></textarea></div>
<div align="right">Age Restrictions: </div><div align="left">
<?PHP  $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits;
      include($agelimit);
      ECHO "&nbsp;&nbsp;Music Genre:&nbsp;&nbsp;";
      include ("maingenrelookup.php");
      ?>&nbsp;&nbsp;Display Status:&nbsp;&nbsp; <?PHP statusselectbox($status,$textcolorstatus);
?>
</div>

      <div align="center" colspan="3">
<!--      <INPUT TYPE="Button" VALUE="Cancel" onClick="history.go(-1)">-->
<?PHP 
	$value="Cancel";
	$library->lmbackup($value);
?>
	  &nbsp;
	<?PHP  $library->inputbutton("submit","submit","Add New Event",$OnClick);?>
	 <!-- <input type="submit" name="submit" Value="Add New Event"> -->
	  	  </form>&nbsp 
		  <?PHP 
		  $value="Edit Another Event";
		  $name="";
		  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
		  $windowlocation="parent.location";
		  $buttons->lmnbutton( $value, $name,$OnClick,$windowlocation);?>
		  
<!-- <INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?'">--></form></div>

<?PHP 
      */}//BEGIN ADD
      elseif ($_action=="Add New Event")
      {/*

	 
 
      //Include ("/inks/LMHeader.php");
	  
	  $sqlcheck="SELECT count('EventDate') from MainEvents WHERE (VenueID='$venueid' AND EventDate='$EventDate')
GROUP BY EventDate";
	  $result=@mysql_query($sqlcheck) or die ("Couldn't execute MainEvent Check query because venueid ".$venueid."isn't set or Eventdate ".$EventDate." is wrong.");
$datecheck=@mysql_fetch_array($result);

if ($datecheck["0"]>0)
	  {
	  echo "<div colspan=\"3\" align=\"center\">There is already an event scheduled on ".$EventDate." at this club. <BR>";
 $value="Back One";
$library->lmbackup($value);
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","submit", $OnClick,$windowlocation);
echo "</div>";
		  }
	  ELSE
	  {
	  
      $sql="SELECT MAX(MainEVID) as MAXIMUM FROM MainEvents WHERE 1";
      $result=@mysql_query($sql) or die("couldn't execute maxevid query.");
      $evid=@mysql_fetch_array($result);

	  
	  $sql2="SELECT MAX(MainEVID) as MAXIMUM2 FROM MainEvents_Old WHERE 1";
	  $result2=@mysql_query($sql2,$connection4) OR DIE("Couldn't find max id in Main Events old");
      $evid2=@mysql_fetch_array($result2);
if ($evid2["MAXIMUM2"]>$evid["MAXIMUM"])
{
$maxevid=$evid2["MAXIMUM2"];
}
ELSE
{
$maxevid=$evid["MAXIMUM"];
}

	  if (strlen($maxevid<6))
	  {
      $maxevid=($maxevid+100001);
	  }
	  ELSE
	  {$maxevid=($maxevid+1);
	  }
	    $EventTitle=strip_tags($EventTitle);
		$EventTitle=addslashes($EventTitle);
		$Prices=addslashes(strip_tags($Prices));
		$DescriptionOfEvent=addslashes(strip_tags($DescriptionOfEvent));
		$thiscontactph1=addslashes(strip_tags($thiscontactph1));
		$MainEVID=$maxevid;
      $sqlinsert="INSERT INTO MainEvents VALUES ('$MainEVID','$EventDate', '$EventTitle',0, '$venueid', '$DoorsOpen', '$EventStart','$EventEnd','$Prices','$thiseventtype1', '$DescriptionOfEvent1','$confirmed',1,'$thiscontactph','$AgeLimits',7,'$thisgenre','','','$onsaledate',2,'$status', '$sponsor','')";
      $result=@mysql_query($sqlinsert) or die("couldn't execute insert query with maxevid=".$maxevid." and
 eventDate=".$EventDate." and
 EventTitle1=".$EventTitle." and
 venueid=".$venueid." and 
 DoorsOpen=".$DoorsOpen." and
 EventStart=".$EventStart." and
 EventEnd=".$EventEnd." and
 Prices1=".$Prices." and
 thiseventtype1=".$thiseventtype." and
 DescriptionOfEvent1=".$DescriptionOfEvent." and
 thiscontactph1=".$thiscontactph." and
 AgeLimits1=".$AgeLimits." and
 thisgenre1=".$thisgenre." and
 onsaledate=".$onsaledate." and
 status1=".$status." .");
      $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear,DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid' AND MainEVID='$maxevid')";

       $result = @mysql_query($sql) or die("couldn't execute initial mainevents query because ".$venueid." is not set and ".$MainEVID." is not set");

    $thisrow = @mysql_fetch_array($result);
    $MainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $EventDate=$thisrow["EventDate"];
    $EventTitle=$thisrow["EventTitle"];
    $EventStart=$thisrow["EventStart"];
    $DoorsOpen=$thisrow["DoorsOpen"];
    $Prices=$thisrow["Prices"];
    $DescriptionOfEvent=$thisrow["DescriptionOfEvent"];
    $AgeRestriction=$thisrow["AgeRestriction"];
    $AgeLimits=$thisrow["AgeLimits"];
    $onsaledate=$thisrow["onsaledate"];
    $Fdate=$thisrow["FDate"];
	$status=$thisrow["status"];
	$sponsor=$thisrow["sponsor"]; 
	$typechange="1";
	posteventchange($MainEVID, $thisschedid,$mediasent,$user_id, $typechange, $oldschedid);
session_register("MainEVID");

$eventmessage=" A new event has been added to the Louisville Music database:<BR>";

$eventmessage .="Event Date: <B>".$EventDate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$EventTitle."<BR></b>";
$eventmessage .="Start: <B>".$EventStart."<BR></b>";
$eventmessage .="Doors: <B>".$DoorsOpen."<BR></b>";
$eventmessage .="Admission: <B>".$Prices."<BR></b>";
$eventmessage .="Age: <B>".$AgeRestriction."<BR></b>";
$eventmessage .="On Sale: <B>".$onsaledate."<BR></b>";
$eventmessage .="Display Status: <B>".$status."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$sponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$MainEVID."<BR></b>";
$eventmessage .="This event was added by ".$valid_user. " at ".$email."";

$subject="New Event Added";
$message=$eventmessage;
$senderName=$valid_user;
$senderEmail=$email;
$toList="editor@louisvillemusicnews.net";
$eventadded=new email ($subject,            // subject
                    $message,// message body
                    $senderName,                   // sender's name
                    $senderEmail,         // sender's email
                    array($toList), // To: recipients
                    ""      // Cc: recipient
                               );
$eventadded->send();?>




    <body background color="#ffffcc">

    <DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
    <div  class="searchhdr">Main Event New Entry Update Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $MainEVID; ?></b></div>
    <div ><hr width="300" size="1 px" align="center"></div>
	<div  align="center"><i><b>New Event Added!</b></i></div>
    <form action="maineventedit.php?validvenue=<?PHP$VenueID;?>" method="GET" style: color="black:; bgcolor="#f5e3a1">
     <input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
     <div>Event Date:</div><div>
 <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventDate1"  value="<?PHP echo $EventDate;?>" size="12" READONLY size ="10">&nbsp;(<?PHP echo $Fdate; ?> )</div> 

     <div>Event Title: </div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventTitle1" value="<?PHP echo $EventTitle;?>" size="50"></div>
     <div align="right">Sponsor Credit: </div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>

<?PHP//Start, end and door block?>
      <div align="right">Event Start:</div><div>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $eventtimecolor);?>
</div><div align="right">Event End: </div><div align="left">
<?PHP
$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</div><div align="right">Doors Open:&nbsp;</div><div>
<?PHP
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $doortimecolor);?>
</div>
<div align="right">Prices:</div><div> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="Prices1" value="<?PHP echo $Prices;?>" size="20"></div>
<div align="right">On Sale Date: </div><div align="left">
<?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "Sale";
	

	$library->WriteDateSelect($startyear,$endyear,'',$prefix,$ondate, $textcoloronsaledate);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsaledate;?>" value="<?PHP echo $onsaledate;?>" READONLY size ="10" name="onsaledate" >



</div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1"><?PHP echo $DescriptionOfEvent;?></textarea></div>
    <div align="right"> Current Status: </div><div><?PHP statusselectbox($status,$textcolorstatus);
?></div>
<div align="right">Age Restrictions: </div><div>
        <?PHP  if ($AgeLimits)
        {
        session_register("AgeLimits");
        $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=black";
        include($agelimit);
        }
        ELSE
        {
        include ("agerestrictionlookup.php");
        }?></div>


        <div colspan="3" align="center">
<!--		<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=<?PHP echo $validvenue;?>&submit=New'" style="background-color: "grey"><font color="black">Add Another Event?</button>-->
<?PHP
$value="Add Another Event?";
$name="Add";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=$validvenue&submit=New";
$windowlocation="parent.location";
 $buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;
<?PHP
$value="Add New Act Schedule Item";
$name="Add";
$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?MainEVID=$MainEVID&submit=New_Schedule_Item";
$windowlocation="window.location";
 $buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>

<!--<button OnClick="window.location='http://www.louisvillemusicnews.net/eventediting/changeact.php?MainEVID=<?PHP echo $MainEVID;?>&submit=New_Schedule_Item'" style="background-color: "gray"><font color="black">Add New Act Schedule Item</button>-->

&nbsp;<BR>
<!-- <INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?'">-->


<?PHP $OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);

//<button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" style="background-color: grey">Log Out</button>?> </div>
</form>
        <div colspan="3">
         <?PHP
		 $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;
 $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 ?><div colspan="3"><?PHP
	 	 	 include ($thispix4event);
		 ?><div colspan="3"><?PHP
         include ($thiseventactlist);
?></div></DIV><?PHP
}
//end of insert New Event
         */}
    ELSEIF ($_action=="Accept")// BEGIN ACCEPT
//	--------------------------------------------------------------------------------------
{/*
    //Include ("/inks/LMHeader.php");
	if ($EventStart==("0:00 PM") OR $EventStart==("0:00 AM") OR $EventStart==("00:00 PM") OR $EventStart==("00:00 AM"))
	{$EventStart="";
	}
	ELSE
	{
	}
	
	$status="OK";
$EventTitle=addslashes($EventTitle);
$DescriptionOfEvent=addslashes($DescriptionOfEvent);
$Prices=addslashes($Prices);
$sponsor=addslashes($sponsor);
	//Copy mainevents to mainevents_old then update MainEvents
    $sqlupdate="UPDATE MainEvents SET EventDate='$EventDate', EventTitle='$EventTitle', EventStart='$EventStart', EventEnd='$EventEnd', DoorsOpen='$DoorsOpen', Prices='$Prices', DescriptionOfEvent='$DescriptionOfEvent', AgeLimits='$AgeLimits', DataSourceID='7', onsaledate='$onsaledate', status='$status',sponsor='$sponsor', sent2media='0000-00-00' WHERE MainEVID='$MainEVID'";
 $result=@mysql_query($sqlupdate) or die ("Could not update Main Event Info into MainEvents");	  
	updatemainevent($MainEVID,$status);	  

     //Include ("/inks/LMHeader.php");  
$sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.EventEnd,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status,MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DATE_FORMAT(MainEvents.onsaledate, '%W, %M %e, %Y') as sdate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear,DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE MainEvents.VenueID='$venueid'
AND MainEVID='$MainEVID'";
     $result = @mysql_query($sql) or die("couldn't execute updated mainevents query.");

    $thisrow = @mysql_fetch_array($result);
    $MainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $EventDate=$thisrow["EventDate"];
    $EventTitle=stripslashes($thisrow["EventTitle"]);
    $EventStart=$thisrow["EventStart"];
	$EventEnd=$thisrow["EventEnd"];
    $DoorsOpen=$thisrow["DoorsOpen"];
	$DoorsOpen=trim($DoorsOpen);
	$EventStart=trim($EventStart);
	$EventEnd=trim($EventEnd);
    $Prices=stripslashes($thisrow["Prices"]);
    $DescriptionOfEvent=stripslashes($thisrow["DescriptionOfEvent"]);
    $AgeRestriction=$thisrow["AgeRestriction"];
    $AgeLimits=$thisrow["AgeLimits"];
    $onsaledate=$thisrow["onsaledate"];
    $Fdate=$thisrow["FDate"];
	$sdate=$thisrow["sdate"];
    $thisVenueID=$thisrow["VenueID"];
	$status=$thisrow["status"];
	$sponsor=stripslashes($thisrow["sponsor"]);
	
	
$eventmessage=" This Event has been updated in the Louisville Music database:<BR>";

$actmessage .="Event Date: <B>".$EventDate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$EventTitle."<BR></b>";
$eventmessage .="Start: <B>".$EventStart."<BR></b>";
$eventmessage .="Doors: <B>".$DoorsOpen."<BR></b>";
$eventmessage .="Admission: <B>".$Prices."<BR></b>";
$eventmessage .="Age: <B>".$AgeRestriction."<BR></b>";
$eventmessage .="On Sale: <B>".$onsaledate."<BR></b>";
$eventmessage .="Display Status: <B>".$status."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$sponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$MainEVID."<BR></b>";
$eventmessage .="This event was added by ".$valid_user. " at ".$email."";

$subject=" Event Changed";
$message=$eventmessage;
$senderName=$valid_user;
$senderEmail=$email;
$toList="editor@louisvillemusicnews.net";
$eventadded=new email ($subject,            // subject
                    $message,// message body
                    $senderName,                   // sender's name
                    $senderEmail,         // sender's email
                    array($toList), // To: recipients
                    ""      // Cc: recipient
                               );
$eventadded->send();?>
	
	
    <body background color="#ffffcc">
	
     <DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">

     <div  class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $MainEVID; ?></b></div>
<div ><hr width="300" size="1 px" align="center"></div>
     <div  align="center"><B><I>This Event Has Been Successfully Updated</i></b></div>
<div align="right">Event Date:</div><div> <input type="text" style="color:<?PHP echo $textcolordate;?>;" name="EventDate" value="<?PHP echo $Fdate;?>" size="30" READONLY></div>
    <div align="right">Event Title: </div><div><input type="text" name="EventTitle" style="color: <?PHP echo $textcolortitle;?>" READONLY value="<?PHP echo $EventTitle;?>"</div>
     <div align="right">Sponsor Credit: </div><div><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>
    <div align="right">Event Start:</div><div><input type="text" READONLY size="8" value="<?PHP echo $EventStart;?>"></div>
<div align="right">Event End: </div><div align="left"><input type="text" READONLY size="8" value="<?PHP echo $EventEnd;?>"></div>
<div align="right">Doors Open: </div><div align="left"><input type="text" READONLY size="8" value="<?PHP echo $DoorsOpen;?>"></div>
    <div align="right">Prices:</div><div align="left"><input type="text" name="Prices" style="color:<?PHP echo $textcolorprice;?>" READONLY value="<?PHP echo $Prices;?>"></div>
<div align="right">On Sale Date: </div><div align="left">
<input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $sdate;?>" READONLY size="30" name="onsaledate">
		</div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1" READONLY><?PHP echo $DescriptionOfEvent;?></textarea></div>
		
<div>
     <div align="right">Status:</div><div align="left"> <?PHP statusselectbox($status,$textcolorstatus);
?></div>
<div align="right">Age Restriction: </div><div>
<?PHP 
        if ($AgeLimits)
        {
         $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=black";
         include($agelimit);
         }
         ELSE
         {
         include ("agerestrictionlookup.php");
          }?></div>


      <div colspan="3" align="center"><form>

	  
	  <?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	  $library->inputbutton("submit", "submit", "Update",$OnClick);?>
	 &nbsp;
	<?PHP 
	$value="Delete";
	$name="";
	$OnClick="$PHP_SELF?MainEVID=$MainEVID&venueid=$validvenue&submit=Delete";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; 
$value="Add New Schedule Item";
$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?MainEVID=$MainEVID&submit=New_Schedule_Item";
$name="submit";
$windowlocation="window.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation); 
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Edit Another Event","Submit", $OnClick,$windowlocation);
echo "<BR>";
// <INPUT TYPE="Button" VALUE="Back One" onClick="history.go(-1)">
?>
<div colspan="3">
    <?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 	 include ($thispix4event);
	 ?><div colspan="3"><?PHP
    include ($thiseventactlist);
?> </div></DIV>
<?PHP


*/}//----------------------------------------End Of Accept ---------------------
ELSEIF ($_action=="Edit")//BEGIN EDIT
{
	echo "EDIT";
	
	session_unregister("thisschedid");
unset($thisschedid);
    //Include ("/inks/LMHeader.php");
echo "GOT HERE";
$cnxn->lm_connection("louisvil_louisvillemusiccom");
       $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.EventEnd,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='".$venueid."' AND MainEvents.MainEVID='".$MainEVID."')";

    $result = @mysql_query($sql) or die("couldn't execute ".$sql."");

    DO {
	    for ($i=0; $i < $fields; $i++) 
                    {
                    $fieldname= mysql_field_name($result, $i);
                    $fieldtype=mysql_field_type($result,$i);
                    $fieldnametype=$fieldname."type";
                    $$fieldnametype=$fieldtype;
                        if ($fieldtype=="string")
                        {
                        $$fieldname=strip_tags(stripslashes($thisrow[$fieldname]));
                        }
                        ELSE
                        {
                        $$fieldname=$thisrow[$fieldname];
                        }
                    }
    }
    WHILE ($thisrow = @mysql_fetch_array($result));
  
session_register("venuename","EventDate","EventTitle","EventStart","EventEnd","DoorsOpen","Prices","DescriptionOfEvent","AgeRestriction","onsaledate","Fdate","AgeLimits", "status","MainEVID");

?>

<DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<div class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $MainEVID; ?></b></div>

<div ><hr width="360" size="1 px" align="center"  background-color="#f5e3a1"></div>
<form action="maineventedit.php?validvenue=<?PHP $VenueID;?>" method="GET" style=" color:black; background-color:#f5e3a1">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
<div align="right">Change Event Date:</div><div align="left">

<?PHP 
	  $BeginYear = 2009; 
	  $EndYear = 2014;
	  $Prefix = "event";// prefix is added to Year,Month,Day for Name=
	  $thistextcolor=$textcolordate;
	  
	//$library->WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$Prefix = '',$EventDate, $thistextcolor);

echo "&nbsp;&nbsp;Currently: <input type=\"text\" style=\"color:".$textcolordate."; value=".$EventDate." READONLY size=\"10\" name=\"EventDate\"></div>";

 ?>
<div align="right">Event Title: </div><div align="left"><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventTitle1" value="<?PHP echo $EventTitle;?>" size="50"></div>
     <div align="right">Sponsor Credit:</div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>

      <div align="right">Event Start:</div><div>
<?PHP /*
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $eventtimecolor);
?>
</div>
<div align="right">Event End: </div><div align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?></div>
<div align="right">Doors Open:&nbsp;</div><div><?PHP
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $doortimecolor);?></div>
<div align="right">Prices:</div><div> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="Prices1" value="<?PHP echo $Prices;?>" size="20"></div>
<div align="right">On Sale Date: </div><div align="left"><?PHP	  
	  $prefix = "Sale";
	  $startyear=date("Y");
	  $endyear=$startyear+5;
	$library->WriteDateSelect($startyear,$endyear,'',$prefix,$onsaledate,$textcoloronsaledate);?>
	&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsaledate;?>" value="<?PHP echo $onsaledate;?>" READONLY size="10" name="onsaledate"></div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1"><?PHP echo $DescriptionOfEvent;?></textarea></div>

<!--<input type="text"style="color:<?PHP echo $defaulttext;?>;" name="DescriptionOfEvent1" value="<?PHP echo $DescriptionOfEvent;?>" size="75">
<!-- new row & Age and status lookup section-->
    <div align="right">Age Restrictions: </div><div align="left">
        <?PHP
	
	if ($AgeLimits)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?></div>
<div align="right">Display Status:&nbsp;</div><div align="left"><?PHP statusselectbox($status,$textcolorstatus);
?></div> <!-- end of age and status lookup section -->
     <div colspan="3" align="center">
 <!-- START OF BUTTON SECTION ------------>
	 <?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	  $library->inputbutton("submit", "submit", "Update",$OnClick);?>
	 &nbsp;
	<?PHP 
	$value="Delete";
	$name="";
	$OnClick="$PHP_SELF?MainEVID=$MainEVID&venueid=$validvenue&submit=Delete";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; ?>
<!--<FORM action="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
-->
<?PHP 
	$value="Add New Act Schedule Item";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?MainEVID=$MainEVID&submit=New_Schedule_Item";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	$value="Back One";
$library->lmbackup($value);
    echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp;";
    $value="Edit Another Event";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
  </form>
</div>
    <div colspan="3">
    <?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 	 include ($thispix4event);
	 ?><div colspan="3"><?PHP
    include ($thiseventactlist);
?> </div></DIV>
<?PHP
*/
    }
ELSEIF ($_action="Cancel")
{
	echo "Cancel";
	/*
//Include ("/inks/LMHeader.php");
$sql="Delete FROM ScheduleOfEvents 
WHERE ScheduleID='$thisschedidnew'";

$dresults=@mysql_query($sql) or die("couldn't complete Cancel query because ".$validvenue." is not set and ".$MainEVID." is not set");
session_unregister("thisschedidnew");

      $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear, DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid' AND MainEvents.MainEVID='$MainEVID')";

    $result = @mysql_query($sql) or die("couldn't execute initial mainevents query because ".$validvenue." is not set and ".$MainEVID." is not set");

    $thisrow = @mysql_fetch_array($result);
  //  $MainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $EventDate=$thisrow["EventDate"];
	$Year=$thisrow["year"];
	$Month=$thisrow["month"];
	$Day=$thisrow["dayofmonth"];
    $EventTitle=stripslashes($thisrow["EventTitle"]);
    $EventStart=$thisrow["EventStart"];
    $EventEnd=$thisrow["EventEnd"];
    $DoorsOpen=$thisrow["DoorsOpen"];
    $Prices=stripslashes($thisrow["Prices"]);
    $DescriptionOfEvent=stripslashes($thisrow["DescriptionOfEvent"]);
    $AgeRestriction=$thisrow["AgeRestriction"];
    $AgeLimits=$thisrow["AgeLimits"];
    $onsaledate=$thisrow["onsaledate"];
    $Fdate=$thisrow["FDate"];
	$status=strtoupper($thisrow["status"]);
	$sponsor=stripslashes($thisrow["sponsor"]);


     //session_register("venuename","EventDate","EventTitle","EventStart","EventEnd","DoorsOpen","Prices","DescriptionOfEvent","AgeRestriction","onsaledate","Fdate","AgeLimits", "status");

?>
<body background color="#ffffcc">

<DIV bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<div  class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $MainEVID; ?></b></div>
<div ><hr width="300" size="1 px" align="center"></div>
<form action="maineventedit.php?validvenue=<?PHP$VenueID;?>" method="GET" style: color="black:; bgcolor="#f5e3a1">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
<div align="right">Change Event Date:</div><div>
<?PHP 
	  $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "event";
	  $thistextcolor=$textcolordate;
	$library->WriteDateSelect($startyear,$endyear,'',$prefix,$EventDate, $thistextcolor);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $EventDate;?>" READONLY size="10" name="EventDate">
<!-- <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventDate1" value=" <?PHP echo $EventDate;?>" size="10"> -->

	  

?>
</div>
<div align="right">Event Title: </div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="EventTitle1" value="<?PHP echo $EventTitle;?>" size="50"></div>
     <div align="right">Sponsor Credit: </div><div><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="sponsor1" value="<?PHP echo $sponsor;?>" size="50"></div>

<?PHP//Start, end and door block
?>
      <div align="right">Event Start:</div><div>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $eventtimecolor);?> <input type="text" value="<?PHP echo $EventStart;?>" READONLY size="8">
</div><div align="right">Event End: </div><div align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $eventendtimecolor);?> <input type="text" value="<?PHP echo $EventEnd;?>" READONLY size ="10">
</div><div align="right">Doors Open:&nbsp;</div><div>
<?PHP
$inhour="DoorsOpenhour1";
$inminute="DoorsOpenminute1";
$inampm="DoorsOpenampm1";

$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $doortimecolor);?><input type="text" value="<?PHP echo $DoorsOpen;?>" READONLY size ="10">
</div>
<div align="right">Prices:</div><div> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="Prices1" value="<?PHP echo $Prices;?>" size="20"></div>
<div>On Sale Date: </div><div align="left"><input type="text" style="color:<?PHP echo $defaulttext;?>" name="onsaledate1" value="<?PHP echo $onsaledate;?>" size="12"></div>
<div align="right">Description:</div><div> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="DescriptionOfEvent1" ><?PHP echo $DescriptionOfEvent;?></textarea></div>
<!-- new row & Age and status lookup section-->
    <div align=\"left\">Age Restrictions: </div><div align=\"left\">
        <?PHP if ($AgeLimits)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?AgeLimits=".$AgeLimits."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?>
&nbsp;&nbsp;Display Status:&nbsp;&nbsp;
      <?PHP statusselectbox($status,$textcolorstatus);
?>

</div> <!-- end of age and status lookup section -->
     <div colspan="3" align="center">
	 <!-- START OF BUTTON SECTION ------------>
	 <?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	  $library->inputbutton("submit", "submit", "Update",$OnClick);?>
	 &nbsp;
	<?PHP 
	$value="Delete";
	$name="";
	$OnClick="$PHP_SELF?MainEVID=$MainEVID&venueid=$validvenue&submit=Delete";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; ?>
<!--<FORM action="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">-->
<?PHP 
	$value="Add New Act Schedule Item";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?MainEVID=$MainEVID&submit=New_Schedule_Item";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	$value="Back One";
$library->lmbackup($value);
    echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp;";
    $value="Edit Another Event";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
  </form></div>



    <div colspan="3">
   <?PHP
   $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?MainEVID=".$MainEVID;
	 	 include ($thispix4event);
	 ?><div colspan="3"><?PHP
    include ($thiseventactlist);
?> </div></DIV><?PHP
   
}
ELSE
{?>
<div align="center">Nothing to Do!</div>
<div align="center">
<?PHP 
$value="Back One";
$library->lmbackup($value);

// <INPUT TYPE="Button" VALUE="Back One" onClick="history.go(-1)">
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);?>

<!-- <button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" style="background-color: grey">Log Out</button>--></div>
<?PHP
*/
}
Echo "END";
}


?>
</div></DIV>



