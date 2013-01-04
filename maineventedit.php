<?PHP
session_start();
require ("/inks/functions.php");
require ("editvars.php");

if (!isset($_POST["action"]))
{
	If($thiseventMainEVID=="")
	{
	$_action="New";
	}
	ELSE
	{
	$_action="Edit";
	}
}
ELSEIF ($_action=="Return_to_this_Event")
{
$_action="Edit";
}

// Sections 
// 1. Update
// 2. Delete
// 3. Final Delete
// 4. New
// 5. Add
// 6. Accept
// 7. Edit
// 8. Add_Plus
// 8. Nothing to Do?>

<LINK REL stylesheet="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css" type="text/css">
</head>

<body class="venueeditbody"><?PHP

//displayLMHeader();?>

<?PHP

if ($_action=="Return To This Event")
{
$_action="Edit";
session_unregister("thistime");
session_unregister("thiseventendtime");
session_unregister("thisstage");
session_unregister("thisActName");
session_unregister("thisprogramorder");
session_unregister("thisstageid");
session_unregister("thisActID");
session_unregister("thisstatus");
session_unregister("thisagecode");
session_unregister("thisagecode1");
session_unregister("onsale1");
session_unregister("eventMonth");
session_unregister("thisschedid");
unset($thisschedid);
unset($thisactname);
unset($thisactid);
unset($thisstatus);
unset($thistime);
unset($thiseventendtime);
unset($onsale1);
unset($thisstage);
}
ElSE
{
}
// set text colors
$defaulttext="black";
$changedtext="red";

// section to combine event date parts --------------------------------
if ($eventMonth)
{
     if ($eventMonth=="0" || $eventDay=="00" || $eventMonth=="00" || $eventDay=="0")
     { 
     $thisdate=$thisdate1;
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
     $thisdate1=$eventYear."-".$eventMonth."-".$eventDay;
     }
}
ELSE
{
$thisdate1=$thisdate;
}

if ($thisdate1==$thisdate)
{
$textcolordate=$defaulttext;
}
ELSE
{
$thisdate=$thisdate1;
$textcolordate=$changedtext;
}


// Section to combine event start time parts into one piece
if ($thiseventhour1 || $thiseventminute1 || $thiseventampm1)
{
$thistime1=$thiseventhour1.":".$thiseventminute1." ".$thiseventampm1;
}
// combine door time parts into one
if ($thisdoorhour1 || $thisdoorminute1 || $thisdoorampm1)
{
$thisdoor1=$thisdoorhour1.":".$thisdoorminute1." ".$thisdoorampm1;
}
// combine event end time parts into one
if($thiseventendhour1 || $thiseventendminute1 || $thiseventendampm1)
{
$thiseventendtime1=$thiseventendhour1.":".$thiseventendminute1." ".$thiseventendampm1;
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
 $onsale1=$SaleYear."-".$SaleMonth."-".$SaleDay;
      if ($onsale1=="--")
    {$onsale1=$onsale;
    }
    ELSE {}
//set onsale date text color
    If ($onsale1)
    {
        IF ($onsale1==$onsale)
        {$textcoloronsale=$defaulttext;}
        ELSE
       {$onsale=$onsale1;
       $textcoloronsale=$changedtext;
	   }
     }
   ELSE
   {$textcoloronsale=$defaulttext;
   $onsale=$onsale;
   }
   }
// set event start color
If ($thistime1)
{
    IF ($thistime1==$thistime)
    {$eventtimecolor=$defaulttext;
	}
    ELSE
    {$thistime=$thistime1;
    $eventtimecolor=$changedtext;
    }
}
ElSE
{  $eventtimecolor=$defaulttext;
}
// set eventend text colro
if($thiseventendtime1)
{
   IF ($thiseventendtime1==$thiseventendtime)
   {$eventendtimecolor=$defaulttext;}
   ELSE
   {$thiseventendtime=$thiseventendtime1;
   $eventendtimecolor=$changedtext;
   }
}
// set door open text color
If ($thisdoor1)
{
    IF ($thisdoor1==$thisdoor)
    {$doortimecolor=$defaulttext;}
    ELSE
    {
	$thisdoor=$thisdoor1;
    $doortimecolor=$changedtext;
    }
}
ElSE
{
{$doortimecolor=$defaultext;}
}

// set age code text color
if ($thisagecode1)
{
    if ($thisagecode1==$thisagecode)
    {
    $agecodetext=$defaulttext;
    }
    ELSE 
    {
    $agecodetext=$changedtext;
    $thisagecode=$thisagecode1;
    }
}
ELSE
{
$agecodetext=$defaulttext;
}

if ($thistitle1)
{
    if ($thistitle1==$thistitle)
    {$textcolortitle=$defaulttext;
    }
    ElSE
    {
    $thistitle=$thistitle1;
    $textcolortitle=$changedtext;
    }
}
ELSE
{
$textcolortitle=$defaulttext;
}



if ($thissponsor1)
{
    if ($thissponsor1==$thissponsor)
    {$textcolorsponsor=$defaulttext;
	$thissponsor=$thissponsor1;
    }
    ElSE
    {
    $thissponsor=$thissponsor1;
    $textcolorsponsor=$changedtext;
    }
}
ELSE
{
$textcolorsponsor=$defaulttext;
}

If ($thisdoor1)
{
    IF($thisdoor1==$thisdoor)
    {$textcolordoor=$defaulttext; 
    }
    ELSE
    {$thisdoor=$thisdoor1;
    $textcolordoor=$changedtext; 
    }
}
ELSE
{
$textcolordoor=$changedtext; 
}

if ($thisprice1)
{

    IF ($thisprice1==$thisprice)
    {$textcolorprice=$defaulttext;
    }
    ELSE
    {$thisprice=$thisprice1;
    $textcolorprice=$changedtext; 
    }
}
ELSE
{
$textcolorprice=$defaulttext;
}

if ($thisdescription1)
{
    IF ($thisdescription1==$thisdescription)
    {$textcolordesc=$defaulttext;}
    ELSE
    {$thisdescription=$thisdescription1;
     $textcolordesc=$changedtext;
    }
}
ELSE
{
{$textcolordesc=$defaulttext;}
}


if ($thisstatus1)
{
   IF ($thisstatus==$thisstatus1)
   
   {$textcolorstatus=$defaulttext;}
   ELSE
   {$thisstatus=$thisstatus1;
   $textcolorstatus=$changedtext;}
   }
 ELSE
 {
   {$textcolorstatus=$defaulttext;
   }
   
 }
$thisstatus=strtoupper($thisstatus);

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


if (!$validvenue)
{

displaynoauthorization(2);

session_unregister;

}
ELSE
{
$venueid=$validvenue;

if (isset($_action))//begin test for submit
{
//BEGIN UPDATE
if ($_action=="Update Event") // begin update loop
{//update loop
?>

    <Table class="centertable">
    <TH class="venuesite" Colspan="2">Main Event Update Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?> on <?PHP echo $thisdate;?> & <?PHP echo $thisdoor;?></b> </th>
    <TR><td colspan="2" align="center" style="color:red;">(<I><B>Items in Red Have Been Changed</I></b>)</td></tr>
    <form action="maineventedit.php" method="POST">
    <input type="hidden" name="validvenue" value=<?PHP echo $validvenue;?>">
    <input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
    <tr><td align="right">Event Date:</td><td> 
	<?PHP 
	  $BeginYear = 2003; 
      $EndYear = 2008;
	  $prefix = "event";
	  
	WriteDateSelect($BeginYear,$EndYear,'',$prefix,$thisdate, $textcolordate);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $thisdate;?>" READONLY size ="10" name="thisdate">
</td></tr>
    <tr><TD align="right">Event Title: </td><Td align="left"><input type="text" style="color:<?PHP echo $textcolortitle;?>"  name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>


 //Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?></td></tr>
<tr><td align="right">Event End: </td><td align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?>
</td></tr>
    <tr><td align="right">Prices:</td><td align="left"> <input type="text" style="color:<?PHP echo $textcolorprice;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left"><input type="text" style="color:<?PHP echo $textcoloronsale;?>;" name="onsale" value="<?PHP echo $onsale;?>" size="12"></td></tr>
    <tr><td align="right">Description:</td><Td align="left"> <textarea style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1" cols="20" rows="3"><?PHP echo $thisdescription;?></textarea></td></tr>

<!-- new row & Age and status lookup section-->
    <tr><td align=\"left\">Age Restrictions: </td><td align=\"left\">
        <?PHP 

		if ($thisagecode)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?>
&nbsp;&nbsp;Display Status:&nbsp;&nbsp;
<?PHP statusselectbox($thisstatus,$textcolorstatus);
?>

</td></tr> <!-- end of age and status lookup section -->
    <TR><TD align="center" colspan="2">
	
<?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 forminputbutton("submit","submit", "Accept",$OnClick);
echo " </form>";
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
lmbackup($value);
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
&nbsp;</td></tr>

    <tr><TD colspan="3">
<?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;

     $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;

	 include ($thispix4event);
	 ?>
	<tr><TD colspan="3"><?PHP
     include ($thiseventactlist);

?>

</td></tr></table>


<?PHP
    }// BEGIN DELETE
    elseif ("Delete"==$_action)//BEGIN DELETE SUBMIT
    {

     Include ("/inks/LMHeader.php");

     session_unregister("thisagecode1");
     $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.sponsor, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid'
AND MainEVID='$thiseventMainEVID')";

     $resultME = @mysql_query($sql) or die("couldn't execute mainevents delete query.");

    $thisrow = @mysql_fetch_array($resultME);
    $thiseventMainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $thisdate=$thisrow["EventDate"];
    $thistitle=stripslashes($thisrow["EventTitle"]);
    $thistime=$thisrow["EventStart"];
	$thiseventendtime=$thisrow["EventEnd"];
    $thisdoor=$thisrow["DoorsOpen"];
    $thisprice=stripslashes($thisrow["Prices"]);
    $thisdescription=stripslashes($thisrow["DescriptionOfEvent"]);
    $thisage=$thisrow["AgeRestriction"];
    $thisagecode=$thisrow["AgeLimits"];
    $onsale=$thisrow["onsaledate"];
    $fdate=$thisrow["FDate"];
	$status=$thisrow["status"];

	 //session_register("venuename","thisdate","thistitle","thistime","thiseventendtime","thisdoor","thisprice","thisdescription","thisage","onsale","fdate","thisagecode");
   ?>
    <Table class="centertable">
    <TH Colspan=2 class="searchhdr">Main Event Delete Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?></b> </th>
    <TR><td colspan="2" align="center" style="color:red;"><I><B>Are you sure you want to delete this event?</I></b></td></tr>
    <form action="<?PHP echo $PHP_SELF;?>"  method="POST">
    <input type="hidden" name="validvenue" value=<?PHP echo $validvenue;?>">
    <input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
    <tr><td>Event Date:</td><td> 
<input type="text" style="color:<?PHP echo $textcolordate;?>;" name="thisdate1" value="<?PHP echo $thisdate;?>" size="12">&nbsp;(<?PHP echo $fdate; ?> )</td></tr>
    <tr><TD>Event Title: </td><Td><input type="text" color="<?PHP echo $textcolortitle;?> name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>

<?PHP//Start, end and door block 
?>
      <tr><td align="right">Event Start:</td><td>
<?PHP$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";

timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?></td></tr>
<tr><td align="right">Event End: </td><td align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $doortimecolor);?>
</td></tr>

     <tr><td align="right">Prices:</td><td> <input type="text" style="color:<?PHP echo $textcolorprice;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left"><input type="text" style="color:<?PHP echo $textcoloronsale;?>;" name="onsale1" value="<?PHP echo $onsale;?>" size="12"></td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1"><?PHP echo $thisdescription;?></textarea></td></tr>
    <tr><td align="right">Status:</td><td> <?PHP statusselectbox($thisstatus,$textcolorstatus);
?></td></tr>
     <tr><td align="right"> Age Restrictions: </td><td>
        <?PHP if ($thisagecode)
        {
         $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=red";
        include($agelimit);
        }
        ELSE
        {
        include ("agerestrictionlookup.php");
        }?></td></tr>


      <TR><TD align="center" colspan="2">
	  &nbsp;<?PHP forminputbutton("submit","submit","Final Delete",$onClick);
$buttons->lmnbutton("Log Out", "","http://www.louisvillemusicnews.net/lmn/members/lmlogout.php","parent.location");
echo "&nbsp;";
echo "</form>";
$value="Back One";
	  lmbackup($value);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
?>
</td></tr>

     <tr><TD colspan="3">
     <?PHP
	 $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;

      $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;
	 include ($thispix4event);
	 ?><tr><TD colspan="3"><?PHP
include ($thiseventactlist);

?>

</td></tr></table>
 <?PHP  }//BEGIN FINAL DELETE
ELSEIF($_action=="Final Delete")//BEGIN FINAL DELETE 
{
$status="DE";
Include ("/inks/LMHeader.php");
// First, delete all schedules of Events

	$sqlremoveitem="SELECT * FROM ScheduleOfEvents WHERE MainEVID='$thiseventMainEVID'";
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

	


updatemainevent($thiseventMainEVID,$status);
Include ("/inks/LMHeader.php");
$sqlmainevent="UPDATE MainEvents SET status='$status', sent2media='0000-00-00' WHERE MainEVID='$thiseventMainEVID' LIMIT 1"; 
$result=@mysql_query($sqlmainevent,$connection4) or die("Couldn't SET status and sent2media for this Main Event =".$thiseventMainEVID."");


/*$eventmessage=" A new event has been added to the Louisville Music database:<BR>";

$eventmessage .="Event Date: <B>".$thisdate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$thistitle."<BR></b>";
$eventmessage .="Start: <B>".$thistime."<BR></b>";
$eventmessage .="Doors: <B>".$thisdoor."<BR></b>";
$eventmessage .="Admission: <B>".$thisprice."<BR></b>";
$eventmessage .="Age: <B>".$thisage."<BR></b>";
$eventmessage .="On Sale: <B>".$onsale."<BR></b>";
$eventmessage .="Display Status: <B>".$thisstatus."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$thissponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$thiseventMainEVID."<BR></b>";
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
$eventadded->send();*/

?>


<TR><td colspan="3" align="center" style="color:red;"><I><B>The Event Has Been Deleted</I></b></td></tr>
<TR><TD></td></tr>
      <TR><TD colspan="3" align="center"><form>
	  <?PHP   $value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );?>
	  
<!--<INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php'">-->
</form></td></tr>



<?PHP
     } //BEGIN NEW
     elseif ($_action=="New")
     {
     session_unregister("thiseventMainEVID");
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
     Include ("/inks/LMHeader.php");
     $sql="SELECT VenueName, ContactPh, VAgeLimits From Venues WHERE Venues.VenueID='$venueid'";
     $result=@mysql_query($sql) or die("couldn't execute venue NEW query.");
     $name=@mysql_fetch_array($result);
     $venuename=$name["VenueName"];
     $contactph=$name["ContactPh"];
     $thisagecode=$name["VAgeLimits"];
 ?>
     <Table class="centertable">
     <TH Colspan=2 class="searchhdr">Add Main Event Form for <B><?PHP echo $venuename;?></b></th>
     <TR><td colspan="2"><hr width="300" size="1 px" align="center"></td></tr>
     <form action="maineventedit.php" method="POST" style" color: blue"; bgcolor="#f5e3a1">
	 <input type="hidden" name="venueid" value="<?PHP echo $venueid;?>">
     <tr><td>Event Date: </td><Td>
     <?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "event";
	  $thistextcolor=$textcolordate;
	WriteDateSelect($startyear,$endyear,'',$prefix,$thisdate, $thistextcolor);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $thisdate;?>" READONLY size ="10" name="thisdate">
      </td></tr>
<?PHP 	 ?><tr><TD colspan="3"><?PHP
       include ("http://www.louisvillemusicnews.net/eventediting/eventtypelookup.php");
?>&nbsp;&nbsp;

      <?PHP include ("http://www.louisvillemusicnews.net/eventediting/serieslookup.php");?> 
      </td></tr>
      <tr><td>Contact Phone: </td><td><input type="Text" style="color:<?PHP echo $defaulttext;?>;" name="thiscontactph1" value="<?PHP echo $contactph;?>" size="12"></td></tr>
      <tr><TD>Event Title: </td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thistitle1" value="" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit:</td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>


<?PHP//Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP
$thisstime="00:00 PM";
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thisstime,$inhour, $inminute,$inampm, $eventtimecolor);?>
</tr></td><tr><td align="right">Event End: </td><td align="left">
<?PHP
$thiseventendtime="00:00 PM";
$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP

$thisdoor="00:00 PM";
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?>
</td></tr>


<tr><td>
      Prices:</td><td> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thisprice1" value="" size="20"></td></tr>
<tr><td>On Sale Date: </td><td align="left">
<?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "Sale";
	WriteDateSelect($startyear,$endyear,'',$prefix,$onsale,$textcoloronsale);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsale;?>" value="<?PHP echo $thisdate;?>" READONLY size ="10" name="thisdate">

<!--<input type="text" style="color:<?PHP//echo $defaulttext;?>;" name="onsale1" value="" size="12"> -->

</td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1"><?PHP echo $thisdescription;?></textarea></td></tr>
<tr><td align="right">Age Restrictions: </td><td align="left">
<?PHP  $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode;
      include($agelimit);
      ECHO "&nbsp;&nbsp;Music Genre:&nbsp;&nbsp;";
      include ("maingenrelookup.php");
      ?>&nbsp;&nbsp;Display Status:&nbsp;&nbsp; <?PHP statusselectbox($thisstatus,$textcolorstatus);
?>
</td></tr>

      <tr><td align="center" colspan="3">
<!--      <INPUT TYPE="Button" VALUE="Cancel" onClick="history.go(-1)">-->
<?PHP 
	$value="Cancel";
	lmbackup($value);
?>
	  &nbsp;
	<?PHP  forminputbutton("submit","submit","Add New Event",$OnClick);?>
	 <!-- <input type="submit" name="submit" Value="Add New Event"> -->
	  	  </form>&nbsp 
		  <?PHP 
		  $value="Edit Another Event";
		  $name="";
		  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
		  $windowlocation="parent.location";
		  $buttons->lmnbutton( $value, $name,$OnClick,$windowlocation);?>
		  
<!-- <INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?'">--></td></tr>

<?PHP
      }//BEGIN ADD
      elseif ($_action=="Add New Event")
      {

	 
 
      Include ("/inks/LMHeader.php");
	  
	  $sqlcheck="SELECT count('EventDate') from MainEvents WHERE (VenueID='$venueid' AND EventDate='$thisdate')
GROUP BY EventDate";
	  $result=@mysql_query($sqlcheck) or die ("Couldn't execute MainEvent Check query because venueid ".$venueid."isn't set or Eventdate ".$thisdate." is wrong.");
$datecheck=@mysql_fetch_array($result);

if ($datecheck["0"]>0)
	  {
	  echo "<TR><TD colspan=\"3\" align=\"center\">There is already an event scheduled on ".$thisdate." at this club. <BR>";
 $value="Back One";
lmbackup($value);
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","submit", $OnClick,$windowlocation);
echo "</td></tr>";
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
	    $thistitle=strip_tags($thistitle);
		$thistitle=addslashes($thistitle);
		$thisprice=addslashes(strip_tags($thisprice));
		$thisdescription=addslashes(strip_tags($thisdescription));
		$thiscontactph1=addslashes(strip_tags($thiscontactph1));
		$thiseventMainEVID=$maxevid;
      $sqlinsert="INSERT INTO MainEvents VALUES ('$thiseventMainEVID','$thisdate', '$thistitle',0, '$venueid', '$thisdoor', '$thistime','$thiseventendtime','$thisprice','$thiseventtype1', '$thisdescription1','$confirmed',1,'$thiscontactph','$thisagecode',7,'$thisgenre','','','$onsale',2,'$thisstatus', '$thissponsor','')";
      $result=@mysql_query($sqlinsert) or die("couldn't execute insert query with maxevid=".$maxevid." and
 eventDate=".$thisdate." and
 thistitle1=".$thistitle." and
 venueid=".$venueid." and 
 thisdoor=".$thisdoor." and
 thistime=".$thistime." and
 thiseventendtime=".$thiseventendtime." and
 thisprice1=".$thisprice." and
 thiseventtype1=".$thiseventtype." and
 thisdescription1=".$thisdescription." and
 thiscontactph1=".$thiscontactph." and
 thisagecode1=".$thisagecode." and
 thisgenre1=".$thisgenre." and
 onsale=".$onsale." and
 thisstatus1=".$thisstatus." .");
      $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear,DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid' AND MainEVID='$maxevid')";

       $resultME = @mysql_query($sql) or die("couldn't execute initial mainevents query because ".$venueid." is not set and ".$thiseventMainEVID." is not set");

    $thisrow = @mysql_fetch_array($resultME);
    $thiseventMainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $thisdate=$thisrow["EventDate"];
    $thistitle=stripslashes($thisrow["EventTitle"]);
    $thistime=$thisrow["EventStart"];
    $thisdoor=$thisrow["DoorsOpen"];
    $thisprice=stripslashes($thisrow["Prices"]);
    $thisdescription=stripslashes($thisrow["DescriptionOfEvent"]);
    $thisage=$thisrow["AgeRestriction"];
    $thisagecode=$thisrow["AgeLimits"];
    $onsale=$thisrow["onsaledate"];
    $fdate=$thisrow["FDate"];
	$thisstatus=$thisrow["status"];
	$thissponsor=stripslashes($thisrow["sponsor"]);
	$typechange="1";
	posteventchange($thiseventMainEVID, $thisschedid,$mediasent,$user_id, $typechange, $oldschedid);
session_register("thiseventMainEVID");

$eventmessage=" A new event has been added to the Louisville Music database:<BR>";

$eventmessage .="Event Date: <B>".$thisdate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$thistitle."<BR></b>";
$eventmessage .="Start: <B>".$thistime."<BR></b>";
$eventmessage .="Doors: <B>".$thisdoor."<BR></b>";
$eventmessage .="Admission: <B>".$thisprice."<BR></b>";
$eventmessage .="Age: <B>".$thisage."<BR></b>";
$eventmessage .="On Sale: <B>".$onsale."<BR></b>";
$eventmessage .="Display Status: <B>".$thisstatus."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$thissponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$thiseventMainEVID."<BR></b>";
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
    <body class="venueeditbody">

    <Table class="centertable">
    <TH Colspan=2 class="searchhdr">Main Event New Entry Update Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?></b></th>
    <TR><td colspan="2"><hr width="300" size="1 px" align="center"></td></tr>
	<TR><TD colspan="2" align="center"><i><b>New Event Added!</b></i></td></tr>
    <form action="maineventedit.php?validvenue=<?PHP$VenueID;?>" method="POST" style: color="black:; bgcolor="#f5e3a1">
     <input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
     <tr><td>Event Date:</td><td>
 <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thisdate1"  value="<?PHP echo $thisdate;?>" size="12" READONLY size ="10">&nbsp;(<?PHP echo $fdate; ?> )</td></tr> 

     <tr><TD>Event Title: </td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>

<?PHP//Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?>
</td></tr><tr><td align="right">Event End: </td><td align="left">
<?PHP
$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?>
</td></tr>
<tr><td align="right">Prices:</td><td> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left">
<?PHP $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "Sale";
	

	WriteDateSelect($startyear,$endyear,'',$prefix,$ondate, $textcoloronsale);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsale;?>" value="<?PHP echo $onsale;?>" READONLY size ="10" name="onsale" >
</td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1"><?PHP echo $thisdescription;?></textarea></td></tr>
    <TR><TD align="right"> Current Status: </td><td><?PHP statusselectbox($thisstatus,$textcolorstatus);
?></td></tr>
<tr><td align="right">Age Restrictions: </td><td>
        <?PHP  if ($thisagecode)
        {
        session_register("thisagecode");
        $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=black";
        include($agelimit);
        }
        ELSE
        {
        include ("agerestrictionlookup.php");
        }?></td></tr>


        <TR><TD colspan="3" align="center">
<!--		<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=<?PHP //echo $validvenue;?>&submit=New'" style="background-color: "grey"><font color="black">Add Another Event?</button>-->
<?PHP
$value="Add New Event";
$name="Add";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=$validvenue&submit=New";
$windowlocation="parent.location";
 $buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;</form>
<?PHP
$value="Add New Act Schedule Item";
$name="Add";
$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?thiseventMainEVID=$thiseventMainEVID&submit=New_Schedule_Item";
$windowlocation="window.location";
 $buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>

<!--<button OnClick="window.location='http://www.louisvillemusicnews.net/eventediting/changeact.php?thiseventMainEVID=<?PHP //echo $thiseventMainEVID;?>&submit=New_Schedule_Item'" style="background-color: "gray"><font color="black">Add New Act Schedule Item</button>-->

&nbsp;<BR>
<!-- <INPUT TYPE="Button" VALUE="Edit Another Event" onClick="parent.location = 'http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?'">-->


<?PHP $OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp;";
//$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
//$windowlocation="parent.location";
//$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);

//<button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" style="background-color: grey">Log Out</button>?> </td></tr>

        <tr><TD colspan="3">
         <?PHP
		 $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;
 $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;
	 ?><tr><TD colspan="3"><?PHP
	 	 	 include ($thispix4event);
		 ?><tr><TD colspan="3"><?PHP
         include ($thiseventactlist);
?></td></tr></table><?PHP
}
//end of insert New Event
         }
    ELSEIF ($_action=="Accept")// BEGIN ACCEPT
//	--------------------------------------------------------------------------------------
{
    Include ("/inks/LMHeader.php");
	if ($thistime==("0:00 PM") OR $thistime==("0:00 AM") OR $thistime==("00:00 PM") OR $thistime==("00:00 AM"))
	{$thistime="";
	}
	ELSE
	{
	}
	
	$status="OK";
$thistitle=addslashes($thistitle);
$thisdescription=addslashes($thisdescription);
$thisprice=addslashes($thisprice);
$thissponsor=addslashes($thissponsor);
	//Copy mainevents to mainevents_old then update MainEvents
    $sqlupdate="UPDATE MainEvents SET EventDate='$thisdate', EventTitle='$thistitle', EventStart='$thistime', EventEnd='$thiseventendtime', DoorsOpen='$thisdoor', Prices='$thisprice', DescriptionOfEvent='$thisdescription', AgeLimits='$thisagecode', DataSourceID='7', onsaledate='$onsale', status='$status',sponsor='$thissponsor', sent2media='0000-00-00' WHERE MainEVID='$thiseventMainEVID'";
 $result=@mysql_query($sqlupdate) or die ("Could not update Main Event Info into MainEvents");	  
	updatemainevent($thiseventMainEVID,$status);	  

     Include ("/inks/LMHeader.php");  
$sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.EventEnd,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status,MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DATE_FORMAT(MainEvents.onsaledate, '%W, %M %e, %Y') as sdate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear,DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE MainEvents.VenueID='$venueid'
AND MainEVID='$thiseventMainEVID'";
     $resultME = @mysql_query($sql) or die("couldn't execute updated mainevents query.");

    $thisrow = @mysql_fetch_array($resultME);
    $thiseventMainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $thisdate=$thisrow["EventDate"];
    $thistitle=stripslashes($thisrow["EventTitle"]);
	    $thistitle=strip_tags($thistitle, '<a><b><i><u>');
    $thistime=$thisrow["EventStart"];
	$thiseventendtime=$thisrow["EventEnd"];
    $thisdoor=$thisrow["DoorsOpen"];
	$thisdoor=trim($thisdoor);
	$thistime=trim($thistime);
	$thiseventendtime=trim($thiseventendtime);
    $thisprice=stripslashes($thisrow["Prices"]);
		$thisprice=strip_tags($thisprice, '<a><b><i><u>');
    $thisdescription=stripslashes($thisrow["DescriptionOfEvent"]);
		$thisdescription=strip_tags($thisdescription, '<a><b><i><u>');
    $thisage=$thisrow["AgeRestriction"];
    $thisagecode=$thisrow["AgeLimits"];
    $onsale=$thisrow["onsaledate"];
    $fdate=$thisrow["FDate"];
	$sdate=$thisrow["sdate"];
    $thisVenueID=$thisrow["VenueID"];
	$thisstatus=strtoupper($thisrow["status"]);
	$thissponsor=stripslashes($thisrow["sponsor"]);
		$thissponsor=strip_tags($thissponsor, '<a><b><i><u>');
	
	
$eventmessage=" This Event has been updated in the Louisville Music database:<BR>";

$actmessage .="Event Date: <B>".$thisdate."<BR></b>";
$eventmessage .="Venue: <B>".$venuename."<BR></b>";
$eventmessage .="Eventtitle: <B>".$thistitle."<BR></b>";
$eventmessage .="Start: <B>".$thistime."<BR></b>";
$eventmessage .="Doors: <B>".$thisdoor."<BR></b>";
$eventmessage .="Admission: <B>".$thisprice."<BR></b>";
$eventmessage .="Age: <B>".$thisage."<BR></b>";
$eventmessage .="On Sale: <B>".$onsale."<BR></b>";
$eventmessage .="Display Status: <B>".$thisstatus."<BR></b>";
$eventmessage .="Sponsor Line: <B>".$thissponsor."<BR></b>";
$eventmessage .="MainEVID: <B>".$thiseventMainEVID."<BR></b>";
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
	
	
    <body class="venueeditbody">
	
     <Table class="centertable">

     <TH Colspan="2" class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?></b></th>
<TR><td colspan="2"><hr width="300" size="1 px" align="center"></td></tr>
     <TR><td colspan="2" align="center"><B><I>This Event Has Been Successfully Updated</i></b></td></tr>
<tr><td align="right">Event Date:</td><td> <input type="text" style="color:<?PHP echo $textcolordate;?>;" name="thisdate" value="<?PHP echo $fdate;?>" size="30" READONLY></td></tr>
    <tr><TD align="right">Event Title: </td><td><input type="text" name="thistitle" style="color: <?PHP echo $textcolortitle;?>" READONLY value="<?PHP echo $thistitle;?>"</td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>
    <tr><td align="right">Event Start:</td><td><input type="text" READONLY size="8" value="<?PHP echo $thistime;?>"></td></tr>
<tr><td align="right">Event End: </td><TD align="left"><input type="text" READONLY size="8" value="<?PHP echo $thiseventendtime;?>"></td></tr>
<tr><td align="right">Doors Open: </td><td align="left"><input type="text" READONLY size="8" value="<?PHP echo $thisdoor;?>"></td></tr>
    <tr><td align="right">Prices:</td><td align="left"><input type="text" name="thisprice" style="color:<?PHP echo $textcolorprice;?>" READONLY value="<?PHP echo $thisprice;?>"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left">
<input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $sdate;?>" READONLY size="30" name="onsale">
		</td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1" READONLY><?PHP echo $thisdescription;?></textarea></td></tr>
		
<tr><td>
     <tr><td align="right">Status:</td><Td align="left"> <?PHP statusselectbox($thisstatus,$textcolorstatus);
?></td></tr>
<tr><td align="right">Age Restriction: </td><td>
<?PHP 
        if ($thisagecode)
        {
         $agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=black";
         include($agelimit);
         }
         ELSE
         {
         include ("agerestrictionlookup.php");
          }?></td></tr>


      <TR><TD colspan="3" align="center"><form>

	  
	  <?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	  forminputbutton("submit", "submit", "Update",$OnClick);?>
	 &nbsp;
	<?PHP 
	$value="Delete";
	$name="";
	$OnClick="$PHP_SELF?thiseventMainEVID=$thiseventMainEVID&venueid=$validvenue&submit=Delete";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; 
$value="Add New Schedule Item";
$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?thiseventMainEVID=$thiseventMainEVID&submit=New_Schedule_Item";
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
<tr><TD colspan="3">
    <?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;
	 	 include ($thispix4event);
	 ?><tr><TD colspan="3"><?PHP
    include ($thiseventactlist);
?> </td></tr></table>
<?PHP


}//----------------------------------------End Of Accept ---------------------

    ELSEIF ($_action=="Edit")//BEGIN EDIT
    {
	session_unregister("thisschedid");
unset($thisschedid);
    Include ("/inks/LMHeader.php");

       $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.EventEnd,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid' AND MainEvents.MainEVID='$thiseventMainEVID')";

    $resultME = @mysql_query($sql) or die("couldn't execute initial mainevents query because ".$validvenue." is not set and ".$thiseventMainEVID." is not set");

    $thisrow = @mysql_fetch_array($resultME);
    $thiseventMainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $thisdate=$thisrow["EventDate"];
    $thistitle=stripslashes($thisrow["EventTitle"]);
	$thistitle=strip_tags($thistitle, '<a><b><i><u>');
    $thistime=$thisrow["EventStart"];
	$thiseventendtime=$thisrow["EventEnd"];
    $thisdoor=$thisrow["DoorsOpen"];
	$thisdoor=trim($thisdoor);
	$thistime=trim($thistime);
	$thiseventendtime=trim($thiseventendtime);
    $thisprice=stripslashes($thisrow["Prices"]);
		$thisprice=strip_tags($thisprice, '<a><b><i><u>');
    $thisdescription=stripslashes($thisrow["DescriptionOfEvent"]);
		$thisdescription=strip_tags($thisdescription, '<a><b><i><u>');
    $thisage=$thisrow["AgeRestriction"];
    $thisagecode=$thisrow["AgeLimits"];
    $onsale=$thisrow["onsaledate"];
    $fdate=$thisrow["FDate"];
	$sdate=$thisrow["sdate"];
    $thisVenueID=$thisrow["VenueID"];
	$thisstatus=strtoupper($thisrow["status"]);
	$thissponsor=stripslashes($thisrow["sponsor"]);
		$thissponsor=strip_tags($thissponsor, '<a><b><i><u>');
//session_register("venuename","thisdate","thistitle","thistime","thiseventendtime","thisdoor","thisprice","thisdescription","thisage","onsale","fdate","thisagecode", "thisstatus","thiseventMainEVID");
session_register("thiseventMainEVID");
?>
<body class="venueeditbody">

<Table class="centertable">
<TH Colspan=2 class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?></b></th>
<TR><td colspan="2"><hr width="360" size="1 px" align="center"  background-color="#f5e3a1"></td></tr>
<form action="maineventedit.php?validvenue=<?PHP$VenueID;?>" method="POST" style=" color:black; bgcolor:#f5e3a1">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<tr><td align="right">Change Event Date:</td><td align="left">
<?PHP 
	  $startyear = 2003; 
      $endyear = 2008;
	  $prefix = "event";// prefix is added to Year,Month,Day for Name=
	  $thistextcolor=$textcolordate;
	  
	WriteDateSelect($startyear,$endyear,'',$prefix,$defaultdate, $thistextcolor);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $thisdate;?>" READONLY size="10" name="thisdate"></td></tr>
<tr><td align="right">Event Title: </td><Td align="left"><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit:</td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>

<?PHP//Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?></td></tr>
<tr><td align="right">Event End: </td><td align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?></td></tr>
<tr><td align="right">Doors Open:&nbsp;</td><td><?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?></td></tr>
<tr><td align="right">Prices:</td><td> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left"><?PHP	  
	  $prefix = "Sale";
	  $startyear=date("Y");
	  $endyear=$startyear+5;
	WriteDateSelect($startyear,$endyear,'',$prefix,$onsale,$textcoloronsale);?>
	&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcoloronsale;?>" value="<?PHP echo $onsale;?>" READONLY size="10" name="onsale"></td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1"><?PHP echo $thisdescription;?></textarea></td></tr>

<!--<input type="text"style="color:<?PHP//echo $defaulttext;?>;" name="thisdescription1" value="<?PHP//echo $thisdescription;?>" size="75">
<!-- new row & Age and status lookup section-->
    <tr><td align="right">Age Restrictions: </td><td align="left">
        <?PHP if ($thisagecode)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?></td></tr>
<tr><td align="right">Display Status:&nbsp;</td><td align="left"><?PHP statusselectbox($thisstatus,$textcolorstatus);
?></td></tr> <!-- end of age and status lookup section -->
     <TR><TD colspan="3" align="center">
<?PHP	 //-- START OF BUTTON SECTION --------------------------------------------------->
	 echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		$value="Update";
	forminputbutton("submit","submit",$value,$OnClick);?>
	 &nbsp; </form>
	<?PHP 
		$value="Delete";
		$name="";
		$OnClick="$PHP_SELF?thiseventMainEVID=$thiseventMainEVID&venueid=$validvenue&submit=Delete";
		$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; ?>
<?PHP 
		$value="Add New Act Schedule Item";
		$name="";
		$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?thiseventMainEVID=$thiseventMainEVID&submit=New_Schedule_Item";
		$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		$value="Edit Another Event";
		$name="";
		$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
		$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
		$value="Add New Event";
		$name="submit";
		$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=$validvenue&submit=New";
		$windowlocation="parent.location";
		echo"&nbsp;";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	/*if ($validuser=24)
	{
	echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	
	$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?venueid=$validvenue&submit=New";
		$windowlocation="parent.location";
		echo"&nbsp;";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	} */
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		$value="Back One";
		lmbackup($value);
		echo "&nbsp;";
		$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
		$windowlocation="parent.location";
	$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
//------END OF BUTTON SECTION ------------------------------------------------------
?>
 
</td></tr>
    <tr><TD colspan="3">
    <?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;
	 	 include ($thispix4event);
	 ?><tr><TD colspan="3"><?PHP
    include ($thiseventactlist);
?> </td></tr></table><?PHP
    }

}
ELSEIF ($_action=="Cancel")
{
Include ("/inks/LMHeader.php");
$sql="Delete FROM ScheduleOfEvents 
WHERE ScheduleID='$thisschedidnew'";

$dresults=@mysql_query($sql) or die("couldn't complete Cancel query because ".$validvenue." is not set and ".$thiseventMainEVID." is not set");
session_unregister("thisschedidnew");

      $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeRestriction, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate, DAYOFMONTH(MainEvents.Eventdate) as eday, MONTH(MainEvents.Eventdate) as emonth,YEAR(MainEvents.EventDate) as eyear, DAYOFMONTH(MainEvents.onsaledate) as saleday, MONTH(MainEvents.onsaledate) as salemonth,YEAR(MainEvents.onsaledate) as saleyear
FROM MainEvents
LEFT JOIN Venues
ON MainEvents.VenueID=Venues.VenueID
LEFT JOIN AgeRestrictions
ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE (MainEvents.VenueID='$venueid' AND MainEvents.MainEVID='$thiseventMainEVID')";

    $resultME = @mysql_query($sql) or die("couldn't execute initial mainevents query because ".$validvenue." is not set and ".$thiseventMainEVID." is not set");

    $thisrow = @mysql_fetch_array($resultME);
  //  $thiseventMainEVID=$thisrow["MainEVID"];
    $thiseventMainEVID=$thisrow["MainEVID"];
    $venuename=$thisrow["VenueName"];
    $thisdate=$thisrow["EventDate"];
    $thistitle=stripslashes($thisrow["EventTitle"]);
	    $thistitle=strip_tags($thistitle, '<a><b><i><u>');
    $thistime=$thisrow["EventStart"];
	$thiseventendtime=$thisrow["EventEnd"];
    $thisdoor=$thisrow["DoorsOpen"];
	$thisdoor=trim($thisdoor);
	$thistime=trim($thistime);
	$thiseventendtime=trim($thiseventendtime);
    $thisprice=stripslashes($thisrow["Prices"]);
		$thisprice=strip_tags($thisprice, '<a><b><i><u>');
    $thisdescription=stripslashes($thisrow["DescriptionOfEvent"]);
		$thisdescription=strip_tags($thisdescription, '<a><b><i><u>');
    $thisage=$thisrow["AgeRestriction"];
    $thisagecode=$thisrow["AgeLimits"];
    $onsale=$thisrow["onsaledate"];
    $fdate=$thisrow["FDate"];
	$sdate=$thisrow["sdate"];
    $thisVenueID=$thisrow["VenueID"];
	$thisstatus=strtoupper($thisrow["status"]);
	$thissponsor=stripslashes($thisrow["sponsor"]);
		$thissponsor=strip_tags($thissponsor, '<a><b><i><u>');


     //session_register("venuename","thisdate","thistitle","thistime","thiseventendtime","thisdoor","thisprice","thisdescription","thisage","onsale","fdate","thisagecode", "thisstatus");

?>
<Table class="centertable">
<TH Colspan=2 class="searchhdr">Main Event Update Form for <B><?PHP echo $venuename;?>&  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?></b></th>
<TR><td colspan="2"><hr width="300" size="1 px" align="center"></td></tr>
<form action="maineventedit.php?validvenue=<?PHP$VenueID;?>" method="POST" style: color="black:; bgcolor="#f5e3a1">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<tr><td align="right">Change Event Date:</td><td>
<?PHP 
	  $startyear = date("Y"); 
      $endyear = $startyear+5;
	  $prefix = "event";
	  $thistextcolor=$textcolordate;
	WriteDateSelect($startyear,$endyear,'',$prefix,$thisdate, $thistextcolor);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $thisdate;?>" READONLY size="10" name="thisdate">
<!-- <input type="text" style="color:<?PHP//echo $defaulttext;?>;" name="thisdate1" value=" <?PHP//echo $thisdate;?>" size="10"> -->
<?PHP 	  
?>
</td></tr>
<tr><td align="right">Event Title: </td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>

<?PHP//Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?> <input type="text" value="<?PHP echo $thistime;?>" READONLY size="8">
</td></tr><tr><td align="right">Event End: </td><td align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?> <input type="text" value="<?PHP echo $thiseventendtime;?>" READONLY size ="10">
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";

timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?><input type="text" value="<?PHP echo $thisdoor;?>" READONLY size ="10">
</td></tr>
<tr><td align="right">Prices:</td><td> <input type="text" style="color:<?PHP echo $defaulttext;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td>On Sale Date: </td><td align="left"><input type="text" style="color:<?PHP echo $defaulttext;?>" name="onsale1" value="<?PHP echo $onsale;?>" size="12"></td></tr>
<tr><td align="right">Description:</td><td> <textarea cols="20" rows="3" style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1" ><?PHP echo $thisdescription;?></textarea></td></tr>
<!-- new row & Age and status lookup section-->
    <tr><td align=\"left\">Age Restrictions: </td><td align=\"left\">
        <?PHP if ($thisagecode)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?>
&nbsp;&nbsp;Display Status:&nbsp;&nbsp;
      <?PHP statusselectbox($thisstatus,$textcolorstatus);
?>
</td></tr> <!-- end of age and status lookup section -->
     <TR><TD colspan="3" align="center">
	 <!-- START OF BUTTON SECTION ------------>
	 <?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	  forminputbutton("submit", "submit", "Update",$OnClick);?>
	 &nbsp;</form>
	<?PHP 
	$value="Delete";
	$name="";
	$OnClick="$PHP_SELF?thiseventMainEVID=$thiseventMainEVID&venueid=$validvenue&submit=Delete";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">"; ?>
<!--<FORM action="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php">
<input type="hidden" name="thiseventMainEVID" value="<?PHP //echo $thiseventMainEVID;?>">-->
<?PHP 
	$value="Add New Act Schedule Item";
	$name="";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php?thiseventMainEVID=$thiseventMainEVID&submit=New_Schedule_Item";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	$value="Back One";
lmbackup($value);
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
  </td>
</tr><tr><TD colspan="3">
   <?PHP $thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;
$thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;
	 	 include ($thispix4event);
	 ?><tr><TD colspan="3"><?PHP
    include ($thiseventactlist);
?> </td></tr></table><?PHP
    }
	ELSEIF ($_action=="Add_Plus")
	{//update loop
	$syear=substr($thisdate,0,4);
	$smonth=substr($thisdate,6,2);
	$sday=substr($thisdate,9,2);
	mktime($smonth,$sday,$syear);
	
		if ($plus1)
		{
		$amt=1;
		}
		ELSEIF ($plus7)
		{
		$amt=7;
		}
		$syear=substr($thisdate,0,4);
		$smonth=substr($thisdate,5,2);
		$sday=substr($thisdate,8,2);
		$olddate=mktime(0,0,0,$smonth,$sday,$syear);
		$thisdate=$olddate+(60*60*24*$amt);
?>
    <Table class="centertable">
    <TH Colspan=2 class="searchhdr">Add New Main Event Form for <B><?PHP echo $venuename;?> & Event Number&nbsp;on <?PHP echo $thisdate;?> & <?PHP echo $thisdoor;?></b> </th>
    <TR><td colspan="2" align="center" style="color:red;">(<I><B>Items in Red Have Been Changed</I></b>)</td></tr>
    <form action="maineventedit.php" method="POST">
    <input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
    <input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
    <tr><td align="right">Event Date:</td><td> 
	<?PHP 
	  $BeginYear = 2003; 
      $EndYear = 2008;
	  $prefix = "event";
	  
	WriteDateSelect($BeginYear,$EndYear,'',$prefix,$thisdate, $textcolordate);
?>&nbsp;&nbsp;Currently: <input type="text" style="color:<?PHP echo $textcolordate;?>" value="<?PHP echo $thisdate;?>" READONLY size ="10" name="thisdate">
</td></tr>
    <tr><TD align="right">Event Title: </td><Td align="left"><input type="text" style="color:<?PHP echo $textcolortitle;?>"  name="thistitle1" value="<?PHP echo $thistitle;?>" size="50"></td></tr>
     <tr><TD align="right">Sponsor Credit: </td><Td><input type="text" style="color:<?PHP echo $textcolorsponsor;?>;" name="thissponsor1" value="<?PHP echo $thissponsor;?>" size="50"></td></tr>

 <?PHP//Start, end and door block?>
      <tr><td align="right">Event Start:</td><td>
<?PHP
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?></td></tr>
<tr><td align="right">Event End: </td><td align="left">
<?PHP$inhour="thiseventendhour1";
$inminute="thiseventendminute1";
$inampm="thiseventendampm1";
timeselectbox($thiseventendtime,$inhour, $inminute,$inampm, $eventendtimecolor);?>
</td></tr><tr><td align="right">Doors Open:&nbsp;</td><td>
<?PHP
$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";
timeselectbox($thisdoor,$inhour, $inminute,$inampm, $doortimecolor);?>
</td></tr>
    <tr><td align="right">Prices:</td><td align="left"> <input type="text" style="color:<?PHP echo $textcolorprice;?>;" name="thisprice1" value="<?PHP echo $thisprice;?>" size="20"></td></tr>
<tr><td align="right">On Sale Date: </td><td align="left"><input type="text" style="color:<?PHP echo $textcoloronsale;?>;" name="onsale" value="<?PHP echo $onsale;?>" size="12"></td></tr>
    <tr><td align="right">Description:</td><Td align="left"> <textarea style="color:<?PHP echo $textcolordesc;?>;" name="thisdescription1" cols="20" rows="3"><?PHP echo $thisdescription;?></textarea></td></tr>

<!-- new row & Age and status lookup section-->
    <tr><td align=\"left\">Age Restrictions: </td><td align=\"left\">
        <?PHP 

		if ($thisagecode)
        {
$agelimit="http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php?thisagecode=".$thisagecode."&agecodetext=".$agecodetext;
        include($agelimit);
        }
        ELSE
        {
        include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");
        }?>
&nbsp;&nbsp;Display Status:&nbsp;&nbsp;
<?PHP statusselectbox($thisstatus,$textcolorstatus);
?>
</td></tr> <!-- end of age and status lookup section -->
    <TR><TD align="center" colspan="2">
	
<?PHP echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 forminputbutton("submit","submit", "Accept",$OnClick);
 echo "</form>";
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
lmbackup($value);
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
&nbsp;</td></tr>

    <tr><TD colspan="3">
<?PHP
$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;

     $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;

	 include ($thispix4event);
	 ?>
	<tr><TD colspan="3"><?PHP
     include ($thiseventactlist);
?>
</td></tr></table>
<?PHP
    }

ELSE
{?>
<TR><TD align="center">Nothing to Do!</td></tr>
<TR><TD align="center">
<?PHP 
$value="Back One";
lmbackup($value);

// <INPUT TYPE="Button" VALUE="Back One" onClick="history.go(-1)">
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);?>

<!-- <button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" style="background-color: grey">Log Out</button>--></td></tr>
<?PHP
}
}
?>
</td></tr></table>



