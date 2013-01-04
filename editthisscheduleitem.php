<?PHP
session_start();
require ("/inks/functions.php");

function editdefaultbuttons($thiseventMainEVID)
{
echo "<hr width=\"240\" size=\"1pt\">";
$value="Back One";
lmbackup($value);
echo "&nbsp;";
$value="This Event";
$name="submit";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=".$thiseventMainEVID."";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
}

?> <script language="Javascript">
/ alphanumerical data only 
function ValidateField(field) { 
    var valid = "1234567890" 
    var ok = "yes"; 
    var temp; 
    for (var i=0; i<field.value.length; i  ) { 
    temp = ""   field.value.substring(i, i 1); 
    if (valid.indexOf(temp) == "-1") ok = "no"; 
    } 
    if (ok == "no") { 
    alert("Only numerical characters are allowed in this field."); 
    field.focus(); 
    field.select(); 
   } 
}
</script>


?><LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css" TYPE="text/css">
<body bgcolor="#0F3925"><?PHP//displayLMHeader();?>

<script type="text/javascript" language="JavaScript">
<!--
function actnamechange() {
     alert("The Act Name cannot be changed in this field. Please select the 'Change Act' button.")
}
//-->
</script>
<?PHP
$method="Get";
// actions:
// $_action
// "Edit This Item" (Fix act name len)
   // "Accept" (Makes the changes in the database) - Fix passing of Act Name an ActID variables / 
// "Add New Schedule
   // Add New Act
// "Delete" 
   //"Final Delete
// "Select line 206
// "Accept line 315
// "Add Item Info" line 549
// "Final Delete" 
if ($thisstime1=="%3A")
{
$thisstime="";
}
if ($thisetime1=="%3A")
{$thisetime="";
}

if ($thisshour1)
{
    if ($thisshour1=="00")
    {
    $thisstime1="";
    }
    ELSE
    {
    $thisstime1=$thisshour1.":".$thissminute1." ".$thissampm1;
    }
}
if ($thisehour1)
{
    if ($thisehour1=="00")
    {
    $thisetime1="";
    }
    ELSE
    {
    $thisetime1=$thisehour1.":".$thiseminute1." ".$thiseampm1;
    }
}


if ($thisstatus1)
{
   IF ($thisstatus==$thisstatus1)
   
   {$textcolorstatus=$defaulttext;
   $thisstatus1=$thisstatus;}
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
if ($thisstime1)
{ 
    if ($thisstime1==$thisstime)
    {$textcolorstime="black";
    }
    ELSE
    {$thisstime=$thisstime1;
    $textcolorstime="#ff3300";}
}
ELSE
{
}
if ($thisetime1)
{
    if ($thisetime1==$thisetime)
    {$textcoloretime="black";
    }
    ELSE
   {$thisetime=$thisetime1;
    $textcoloretime="#ff3300";}
}
ELSE
{
}

if ($thisactid1)
{  
    IF ($thisactid1==$thisactid)
   {
   }
   ELSE
   {
   $thisactid=$thisactid1;
   }
}
ELSE 
{}

if( $thisstage1)
{
    if ($thisstage1==$thisstage)
    {$textcolorstage="black";
    }
    ELSE
    {$thisstage=$thisstage1;
    $textcolorstage="#ff3300";}
}
ELSE
{
}
if ($thisprogramorder1)
{
    if ($thisprogramorder1==$thisprogramorder)
    {$textcolororder="black";
    }
    ELSE
    {$thisprogramorder=$thisprogramorder1;
    $textcolororder="#ff3300";}
}
ELSE
{
}
?>


</head>

<body bgcolor="#330000">
<?PHP 
// test variables for change and set changed color
// register the MainEVID
if (!isset($thiseventMainEVID))
{
session_register("thiseventMainEVID");
}
ELSE
{
}
if ($thisactname1)
{
//include("/inks/LMHeader.php");
$sqlactname="SELECT ActName FROM Acts WHERE ActID='$thisactid1'";
$result=@mysql_query($sqlactname) or die("couldn't execute thisact query.");
$thisrow=@mysql_fetch_array($result);
$thisactname1=$thisrow["ActName"];
$thisactname1=stripslashes($thisactname1);
    If ($thisactname1==$thisactname)
    {$textcolorActName="Black";
	$actnamelen=strlen($thisactname);
	}
    ELSE
    {$thisactname=$thisactname1;
    $textcolorActName="#ff3300";
    $actnamelen=strlen($thisactname);
    }

}
Else
{
    $textcolorActName="Black";
	$actnamelen=strlen($thisactname);
}

if (isset($_action))
{
//Begin $_action values
IF ($_action=="Edit This Item")
{

    session_unregister("thisactid");
    session_unregister("thisactname");
	session_unregister("thisschedid");
    //include("/inks/LMHeader.php");
    $sqledit ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status 
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE ScheduleOfEvents.ScheduleID='$thisschedid'";
$resultedit = @mysql_query($sqledit) or die("couldn't execute thisact query.");
$thisrow=@mysql_fetch_array($resultedit);
    If ($thisrow)
    {
       Do
       {
       $thisstime=$thisrow["Stime"];
       $thisetime=$thisrow["Etime"];
       $thisstage=$thisrow["StageName"];
       $thisactname=$thisrow["ActName"];
       $thisprogramorder=$thisrow["ProgramOrder"];
       $thisstageid=$thisrow["StageID"];
       $thisactid=$thisrow["ActID"];
	   $thisschedid=$thisrow["ScheduleID"];
	   $thisstatus=$thisrow["status"];
	   $actnamelen=strlen($thisactname);

            if ($actnamelen==0)
            {
            $actnamelen=15;
            }
            ELSE
            {
            }
     }
       WHILE (@mysql_fetch_array($resultedit));
   }
    ELSE
    {
echo "No records";
	}
?>
<Table class="centertable">
<TH colspan="3" class="searchhdr">Schedule Editing Form For Event # <?PHP echo $thiseventMainEVID;?>and This Schedule #<?PHP echo $thisschedid;?> <BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD>
<tr><TD align="right"><b>Act Name:</b> </TD><td><input type="text" value="<?PHP echo $thisactname;?>" name="thisactname" readonly> 
<BR>
<span style="align: center;">
<?PHP
$value="Replace Act";
$name="submit";
$OnClick="changeact.php?submit=Replace Act&thisschedid=".$thisschedid."";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
//inputbutton($type, $name, $value, $OnClick) ?>
</span>

</td></tr>
<TR><TD>
<form action="<?PHP echo $PHP_SELF;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid;?>">
<input type="hidden" name="thisactid1" value="<?PHP echo $thisactid;?>">
<input type="hidden" name="thisactname1" value="<?PHP echo $thisactname;?>">
</TD></TR>
<TR><TD align="right">Start Time: </TD><TD>
<?PHP$inhour="thisshour1";
$inminute="thissminute1";
$inampm="thissampm1";

timeselectbox($thisstime,$inhour,$inminute,$inampm,$textcolortime);?>
</td></tr>

<TR><TD align="right">Finish Time: </TD><TD>

<?PHP$inhour="thisehour1";
$inminute="thiseminute1";
$inampm="thiseampm1";

timeselectbox($thisetime,$inhour,$inminute,$inampm,$textcolortime);?>

<?PHP if ($issage=="Y")
{
?>
<TR><TD align="right">Stage: </TD><TD>
<?PHP
stageselectbox($validvenue,$stagecolorstatus);
?></td></tr><?PHP		  
		  }
?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2">&nbsp;
<?PHP
$value="Help on Order";
$name="";
$OnClick="alert('Program Order begins at 0, with higher numbers indicating later performance times. The highest number indicates the last performer.')";
lmnalertbutton($value, $name,$OnClick);
?>
<!--<INPUT TYPE="button" Value="Help on Order" onClick='alert("Program Order begins at 0. The highest number indicates the last performer.")'>-->

</td></tr>
<tr><TD align="right">Current Status: </td><TD align="left"><?PHPstatusselectbox($thisstatus, $textcolorstatus);?></td></tr>
<tr><TD colspan="3" align="center">&nbsp;
<!--<INPUT TYPE="Button" VALUE="Back" onClick="history.go(-1)">-->

&nbsp;
<?PHP 
$type="submit";
$name="submit";
$value="Update";
$OnClick="";
forminputbutton($type, $name, $value, $OnClick);?>
<!--<input type="submit" name="submit" value="Update">-->
</form><BR>
<?PHP editdefaultbuttons($thiseventMainEVID);?>
</td></tr></table>
<?PHP
}
ELSEIF ($_action=="Update") // Update changes in Schedule other than act
{

session_register("thiseventMainEVID");
?>
<Table class="centertable"><TH colspan="3" class="searchhdr">Schedule Edit Form For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD colspan="3" align="center" style="color:Red"><B><I>Items in Red have been changed.<BR> Click 'Accept' to complete change. </B></i></td></tr>
<TR><TD>
<form action="<?PHP echo $PHP_SELF;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisactid" value="<?PHP echo $thisactid;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid;?>">
<tr><TD align="right">Act Name: </TD><td><B><input type="text" style="color:<?PHP echo $textcolorActName;?>" readonly onFocus=actnamechange() name="thisactname1" value="<?PHP echo $thisactname; ?>" size="<?PHP echo $actnamelen; ?>"></b></td></tr>
<TR><TD align="right">Start Time: </TD><TD><input type="text" style="color:<?PHP echo $textcolorstime;?>" name="thisstime1" value="<?PHP echo $thisstime;?>" size="11"></td></tr>
<TR><TD align="right">Finish Time: </TD><TD><input type="text" style="color:<?PHP echo $textcoloretime;?>" name="thisetime1" value="<?PHP echo $thisetime;?>" size="11"></td></tr>
     <?PHPisstage();
?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"></td></tr>
<tr><TD Align="right">Status: </td><TD align="left"><input type="text" style="color:<?PHP echo $textcolorstatus;?>" name="thisstatus1" value="<?PHP echo $thisstatus;?>" size="2" READONLY>  </td></tr>
<tr><TD colspan="3" align="center">
<!--<INPUT TYPE="Button" VALUE="Back" onClick="history.go(-1)">-->
&nbsp;
<?PHP
$type="submit";
$name="submit";
$value="Accept";
forminputbutton($type, $name, $value,$OnClick);?>
<!--<input type="submit" name="submit" value="Accept">-->
</form><BR>
<?PHP
editdefaultbuttons($thiseventMainEVID);?>
</td></tr></table>

<?PHP}
ELSEIF ($_action=="Accept")
{
//-------------------------------------------------------------------------------------------------------
//include("/inks/LMHeader.php");


// Check to see if there is already a ScheduleOfEvents_Old record for this date and the mediainfo has not been sent.
//if ($maxid>0)//If there is a changedschedule, check if media info has been sent.
//{

$sqlcheck="SELECT * FROM ScheduleOfEvents WHERE ScheduleID='$thisschedid'";
$result=@mysql_query($sqlcheck,$connection4) OR DIE ("Couldn't run the ScheduleOfEvents query with a maxid.");
$changedschedid=@mysql_fetch_array($result);
	Do
	{
      IF ($changedschedid["sent2media"]=="0000-00-00")// If media info has not been sent, update
      {
	  $updatestring="UPDATE ScheduleOfEvents SET ";
      $updatestring .=" ActID = '";
      $updatestring .=$thisactid."'";
	  
	  if ($thisstime) 
	  {
	  $updatestring .=", Stime= '";
	  $updatestring .=$thisstime."'";
	  }
	  if ($thisetime)
	  {
	  $updatestring .=", Etime= '";
	  $updatestring .=$thisetime."'";
	  }
	  if ($thisstatus)
	  {
	  $updatestring .=", status= '";
	  $updatestring .=$thisstatus."'";
	  }
	  if ($sent2media)
	  {
	  $updatestring .=", sent2media= '";
	  $updatestring .=$sent2media."'";
	  }
	 $updatestring .=" WHERE ScheduleID ='";
	 $updatestring .=$thisschedid."'";

     $result=@mysql_query($updatestring) or die("couldn't update ScheduleOfEvents");

	  }
	  ELSE // Add  ScheduleofEvents_Old record
	  {
	      $sqlremoveact="SELECT * FROM ScheduleOfEvents WHERE ScheduleID='$thisschedid'";
          $deleteschedule=@mysql_query($sqlremoveact) or die("couldn't Copy Deleted Schedule  query.");
          $delresult=@mysql_fetch_array($deleteschedule);
          DO
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
          $delinput_site="2";
		  $sent2media=$delresult["sent2media"];
          $changeddate=date('Y-m-d'); 
          }
          WHILE ($deleteschedule=@mysql_fetch_array($delresult));
    $sqlsaveschedule="INSERT INTO ScheduleOfEvents_Old VALUES ('','$delMainEVID','$delActID', '$delProgramOrder','$delActConfirmed','$delstageID','$delTypeofEvent','$delScheduleID','$delMainGenre','$delAdmission','$delStime','$delEtime','0000-00-00','$changeddate','$delinput_site','CH','$user_id','$sent2media')";
    $delinsertresult=@mysql_query($sqlsaveschedule) or die("couldn't Save Changed Schedule query.");
		 }
   }
   WHILE ($changedschedid=@mysql_fetch_array($result));   


$sqlNewAct="UPDATE ScheduleOfEvents SET ActID='$thisactid', Etime='$thisetime', Stime='$thisstime', ProgramOrder='$thisprogramorder', StageID='$thisstageid', status='$thisstatus', Admission='$thisAdmission', TypeOfEvent='$thistypeofevent', ActConfirmed='$thisactconfirmed', MainGenre='$thismaingenre',sent2media='0000-00-00' WHERE  ScheduleOfEvents.ScheduleID='$thisschedid'";

$result=@mysql_query($sqlNewAct) or die("couldn't Update Accepted query.");

$sqlnewact ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status, ScheduleOfEvents.Admission, ScheduleOfEvents.ActConfirmed, ScheduleOfEvents.MainGenre, ScheduleOfEvents.status 
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE (ScheduleOfEvents.MainEVID='$thiseventMainEVID' AND ScheduleOfEvents.ScheduleID ='$thisschedid')";
$resultnewact = @mysql_query($sqlnewact) or die("couldn't execute this Select query.");
$thisrow=@mysql_fetch_array($resultnewact);
$thisstime=$thisrow["Stime"];
$thisetime=$thisrow["Etime"];
$thisstage=$thisrow["StageName"];
$thisstageid=$thisrow["StageID"];
$thisactname=$thisrow["ActName"];
$thisactid=$thisrow["ActID"];
$thisprogramorder=$thisrow["ProgramOrder"];
$thisstatus=$thisrow["status"];
$thisactconfirmed=$thisrow["ActConfirmed"];
$thisAdmission=$thisrow["Admission"];
$thismaingenre=$thisrow["MainGenre"];
$thisschedid=$thisrow["ScheduleID"];

?>
<Table class="centertable">
<TH colspan="3" class="searchhdr">Act Schedule Item Change<?PHP echo $thisschedid;?> For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD align="center" colspan="3"><B> </a></td></tr>
<form action="http://www.louisvillemusicnews.net/eventediting/maineventedit.php" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisactid" value="<?PHP echo $thisactid;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<tr><TD align="right">Act Name: <TD><td><input type="text" name="thisactname1" value="<?PHP echo $thisactname;?>" size="<?PHP echo $actnamelen; ?>" readonly onFocus=actnamechange()></td></tr>
<TR><TD align="right">Start Time: <TD><TD><input type="text" style="color:<?PHP echo $textcolorstime;?>" name="thisstime1" value="<?PHP echo $thisstime;?>" size="11" readonly>&nbsp;</td></tr>
<TR><TD align="right">Finish Time: <TD><TD><input type="text" style="color:<?PHP echo $textcoloretime;?>" name="thisetime1" value="<?PHP echo $thisetime;?>" size="11" readonly></td></tr>
<?PHPisstage();?>
<TR><TD align="right">Program Order: <TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"readonly>&nbsp;</form></td></tr>
<tr><TD colspan="3" align="center">&nbsp;</td></tr><tr><TD colspan="3" align="center"><?PHP
editdefaultbuttons($thiseventMainEVID);
?>
<!--<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=<?PHP //echo $thiseventMainEVID;?>&thisschedidnew=<?PHP //echo $thisschedidnew;?>'" style="background-color: grey">Return to this Event</button>-->

</td></tr>

<?PHP


}
ELSEIF ($_action=="Replacement Act") // A new act has been selected to replace an earlier one
{
?>
<Table class="centertable"><TH colspan="3" class="searchhdr">Schedule Edit Form For Item <?PHP echo $thisschedid; ?><BR>from Event <?PHP echo $thiseventMainEVID;?> at <?PHP echo $venuename;?> </th>
<TR><TD colspan="3" align="center" style="color:Red"><B><I>This Act Has Been Selected To Replace Earlier Act </B></i></td></tr>
<TR><TD>
<form action="<?PHP echo $PHP_SELF;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisactid1" value="<?PHP echo $thisactid;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid;?>">
<tr><TD align="right">Act Name: </TD><td><B><input type="text" style="color:<?PHP echo $textcolorActName;?>" readonly onFocus=actnamechange() name="thisactname1" value="<?PHP echo $thisactname; ?>" size="<?PHP echo $actnamelen; ?>"></b></td></tr>
<TR><TD align="right">Start Time: </TD><TD><input type="text" style="color:<?PHP echo $textcolorstime;?>" name="thisstime1" value="<?PHP echo $thisstime;?>" size="11"></td></tr>
<TR><TD align="right">Finish Time: </TD><TD><input type="text" style="color:<?PHP echo $textcoloretime;?>" name="thisetime1" value="<?PHP echo $thisetime;?>" size="11"></td></tr>
     <?PHPisstage();
?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"></td></tr>
<tr><TD Align="right">Status: </td><TD align="left"><?PHP statusselectbox($thisstatus,$textcolorstatus);?>  </td></tr>
<tr><TD colspan="3" align="center">

<!--<INPUT TYPE="Button" VALUE="Back" onClick="history.go(-1)">-->
&nbsp;
<?PHP
$type="submit";
$name="submit";
$value="Accept Replacement";
forminputbutton($type, $name, $value,$OnClick);
?>
</form>
<BR>
<?PHP editdefaultbuttons($thiseventMainEVID);
echo "&nbsp;"; ?>

</td></tr></table>

<?PHP}
ELSEIF ($_action=="Accept Replacement") // The New Act is accepted as a replacement.
{
//-------------------------------------------------------------------------------------------------------
//include("/inks/LMHeader.php");
$changeddate=date('Y-m-d'); 
$sqlcheck="SELECT * FROM ScheduleOfEvents WHERE ScheduleID='$thisschedid'";
$result=@mysql_query($sqlcheck,$connection4) OR DIE ("Couldn't run the Schedule Of Events query for replacement.");
$changedschedid=@mysql_fetch_array($result);
DO
{
    IF ($changedschedid["sent2media"]=="0000-00-00" )// If media info has not been sent, update the  current schedule item record
      {
	  $updatestring="UPDATE ScheduleOfEvents SET ";
      $updatestring .=" ActID = '";
      $updatestring .=$thisactid."'";

	  if ($thisstime) 
	  {
	  $updatestring .=", Stime= '";
	  $updatestring .=$thisstime."'";
	  }
	  if ($thisetime)
	  {
	  $updatestring .=", Etime= '";
	  $updatestring .=$thisetime."'";
	  }
	  if ($thisstatus)
	  {
	  $updatestring .=", status= '";
	  $updatestring .=$thisstatus."'";
	  }
	  if ($sent2media)
	  {
	  $updatestring .=", sent2media= '";
	  $updatestring .=$sent2media."'";
	  }
	 $updatestring .=" WHERE ScheduleID ='";
	 $updatestring .=$thisschedid."'";

     $result=@mysql_query($updatestring) or die("couldn't update ScheduleOfEvents");
		}
	  ELSE // Media has been sent
	  {
         $delMainEVID=$changedschedid["MainEVID"];
          $delActID=$changedschedid["ActID"];
          $delProgramOrder=$changedschedid["ProgramOrder"];
          $delActConfirmed=$changedschedid["ActConfirmed"];
          $delstageID=$changedschedid["StageID"];
          $delTypeofEvent=$changedschedid["TypeOfEvent"];
          $delScheduleID=$changedschedid["ScheduleID"];
          $delMainGenre=$changedschedid["MainGenre"];
          $delAdmission=$changedschedid["Admission"];
          $delStime=$changedschedid["Stime"];
          $delEtime=$changedschedid["Etime"];
		  $sent2media=$changedschedid["sent2media"];
          $delinput_site="2";
          $changeddate=date('Y-m-d');

       }

    $sqlsaveschedule="INSERT INTO ScheduleOfEvents_Old VALUES ('','$delMainEVID','$delActID', '$delProgramOrder','$delActConfirmed','$delstageID','$delTypeofEvent','$delScheduleID','$delMainGenre','$delAdmission','$delStime','$delEtime','$sent2media','$changeddate','$delinput_site','CH','$user_id','$sent2media')";
    $delinsertresult=@mysql_query($sqlsaveschedule) or die("couldn't Save Changed Schedule query.");
     }
     WHILE ($changedschedid=@mysql_fetch_array($result));	
// set replacement act
$sqlNewAct="UPDATE ScheduleOfEvents SET ActID='$thisactid', Etime='$thisetime', Stime='$thisstime', ProgramOrder='$thisprogramorder', StageID='$thisstageid', status='$thisstatus', Admission='$thisAdmission', TypeOfEvent='$thistypeofevent', ActConfirmed='$thisactconfirmed', MainGenre='$thismaingenre',sent2media='0000-00-00' WHERE  ScheduleOfEvents.ScheduleID='$thisschedid'";

$result=@mysql_query($sqlNewAct) or die("couldn't Update Accepted query.");

$sqlnewact ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status, ScheduleOfEvents.Admission, ScheduleOfEvents.ActConfirmed, ScheduleOfEvents.MainGenre, ScheduleOfEvents.status 
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE (ScheduleOfEvents.MainEVID='$thiseventMainEVID' AND ScheduleOfEvents.ScheduleID ='$thisschedid')";
$resultnewact = @mysql_query($sqlnewact) or die("couldn't execute this Select query.");
$thisrow=@mysql_fetch_array($resultnewact);
$thisstime=$thisrow["Stime"];
$thisetime=$thisrow["Etime"];
$thisstage=$thisrow["StageName"];
$thisstageid=$thisrow["StageID"];
$thisactname=$thisrow["ActName"];
$thisactid=$thisrow["ActID"];
$thisprogramorder=$thisrow["ProgramOrder"];
$thisstatus=$thisrow["status"];
$thisactconfirmed=$thisrow["ActConfirmed"];
$thisAdmission=$thisrow["Admission"];
$thismaingenre=$thisrow["MainGenre"];
$thisschedid=$thisrow["ScheduleID"];

?>
<Table class="centertable">
<TH colspan="3" class="searchhdr">Act Schedule Item Change<?PHP echo $thisschedid;?> For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD align="center" colspan="3"><B> </a></td></tr>
<form action="maineventedit.php?thiseventMainEVID=<?PHP echo $thiseventMainEVID;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisactid" value="<?PHP echo $thisactid;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">

<tr><TD align="right">Act Name: <TD><td><input type="text" name="thisactname1" value="<?PHP echo $thisactname;?>" size="<?PHP echo $actnamelen; ?>" readonly onFocus=actnamechange()></td></tr>
<TR><TD align="right">Start Time: <TD><TD><input type="text" style="color:<?PHP echo $textcolorstime;?>" name="thisstime1" value="<?PHP echo $thisstime;?>" size="11" readonly>&nbsp;</td></tr>
<TR><TD align="right">Finish Time: <TD><TD><input type="text" style="color:<?PHP echo $textcoloretime;?>" name="thisetime1" value="<?PHP echo $thisetime;?>" size="11" readonly></td></tr>
<?PHPisstage();?>
<TR><TD align="right">Program Order: <TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"readonly>&nbsp;</td></tr>
<tr><TD colspan="3" align="center">&nbsp;
<?PHP 
$value="Return to this Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID&thisschedidnew=$thisschedidnew";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation)?>
<!-- <button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=<?PHP //echo $thiseventMainEVID;?>&thisschedidnew=<?PHP //echo $thisschedidnew;?>'" style="background-color: grey">Return to this Event</button>-->

</td></tr>

<?PHP

//----------------------------------------------------------------------------------------------------------
}
ELSEIF ($_action=="Select")
/*{ IF ($NewScheduleItem=="New_Schedule_Item")) // Add A New Schedule item; begin here; a new act variable and item should be passed to this point from selectact.php*/

{?>
<Table class="centertable">
<TH colspan="3" class="searchhdr">Set Up New Act Schedule Item For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD align="center" colspan="3"><B> </a></td></tr>
<form action="<?PHP echo $PHP_SELF;?>?thiseventMainEVID=<?PHP echo $thiseventMainEVID; ?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisactid1" value="<?PHP echo $thisactid;?>">
<tr><TD align="right">Act Name: </TD><td><input type="text" name="thisactname1" value="<?PHP echo $thisactname;?>" size="<?PHP echo $actnamelen; ?>" readonly onFocus=actnamechange()>&nbsp;
<?PHP $value="Change Act";
$OnClick="http://www.louisvillemusicnews.net/eventediting/changeact.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation)?>
<!--<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/changeact.php'" style="background-color: "gray"><font color="blue">Change Act</button>-->

</td></tr>
<TR><TD align="right">Start Time: </TD><TD>
<?PHP$inhour="thisshour1";
$inminute="thissminute1";
$inampm="thissampm1";
timeselectbox($thisstime,$inhour,$inminute,$inampm,$textcolortime);?>
</td></tr>
<TR><TD align="right">Finish Time: </TD><TD>
<?PHP$inhour="thisehour1";
$inminute="thiseminute1";
$inampm="thiseampm1";

timeselectbox($thisetime,$inhour,$inminute,$inampm,$textcolortime);?>
          <?PHP isstage();?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2">&nbsp;
<?PHP
$value="Help on Order";
$name="";
$OnClick="alert('Program Order begins at 0, with higher numbers indicating later performance times. The highest number indicates the last performer.')";
lmnalertbutton($value, $name,$OnClick);
?>
<!--<INPUT TYPE="button" Value="Help on Order" onClick='alert("Program Order begins at 0. The highest number indicates the last performer.")'>-->

</td></tr>
<tr><TD align="right">Set Display Status: </td><TD align="left"><?PHPstatusselectbox($thisstatus, $textcolorstatus);?></td></tr>

<tr><TD colspan="3" align="center">&nbsp;
<!--<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=<?PHP echo $thiseventMainEVID;?>'" style="background-color: grey">Cancel</button>-->

&nbsp;
<?PHP
$type="submit";
$name="submit";
$value="Add New Schedule Item";
forminputbutton($type, $name, $value,$OnClick)
?></form>
<?PHP
$value="Cancel";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
<!--<input type="submit" name="submit" value="Add New Schedule Item">-->

</td></tr>
<?PHP
       }
ELSEIF ($_action=="Add New Schedule Item")
{

		?>
<Table class="centertable"><TH colspan="3" class="searchhdr">Are You Sure You Want To Add A New Schedule Item <BR>For Event <?PHP echo $thiseventMainEVID; ?> on <?PHP echo $thisdate; ?> at <?PHP echo $venuename;?> </th>
<TR><TD colspan="3" align="center" style="color:Red"></td></tr>
<TR><TD>
<form action="<?PHP echo $PHP_SELF;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<tr><TD align="right">ActName: </TD><td><B><input type="text" style="color:<?PHP echo $textcolorActName;?>" name="thisactname1" value="<?PHP echo $thisactname; ?>" size="<?PHP echo $actnamelen;?>" readonly onFocus=actnamechange() ></b></td></tr>
<TR><TD align="right">Act ID: </td><TD><B><input type="text" style="color:<?PHP echo $textcolorActName;?>" name="thisactid1" value="<?PHP echo $thisactid; ?>" readonly></b></td></tr>
<TR><TD align="right">Start Time: </TD><TD>
<?PHP$inhour="thisshour1";
$inminute="thissminute1";
$inampm="thissampm1";

timeselectbox($thisstime,$inhour,$inminute,$inampm,$textcolortime);?></td></tr>
<tr><TD align="right">Currently: </td><td><input type="text" style="color:<?PHP echo $textcolorstime;?>"  value="<?PHP echo $thisstime;?>" size="11" READONLY name="thisstime1"></td></tr>
<TR><TD align="right">Finish Time: </TD><TD>
<?PHP$inhour="thisehour1";
$inminute="thiseminute1";
$inampm="thiseampm1";

timeselectbox($thisstime,$inhour,$inminute,$inampm,$textcolortime);?></td></tr>
<tr><TD align="right">Currently: </td><td><input type="text" style="color:<?PHP echo $textcoloretime;?>" name="thisetime1" value="<?PHP echo $thisetime;?>" size="11" READONLY ></td></tr>
    <?PHPisstage();?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"></td></tr>
<tr><TD align="right">Set Display Status: </td><TD align="left"><?PHPstatusselectbox($thisstatus, $textcolorstatus);?></td></tr>
<tr><TD colspan="3" align="center">
<!--<INPUT TYPE="Button" VALUE="Back" onClick="history.go(-1)">-->
&nbsp;
<?PHP
$type="submit";
$name="submit";
$value="Accept New Act Schedule Item";
forminputbutton($type, $name, $value,$OnClick);?>
<!--<input type="submit" name="submit" value="Accept New Act Schedule Item" >-->
</form><BR>
<?PHP editdefaultbuttons($thiseventMainEVID);?>
</td></tr>

</td></tr></table>


<?PHP
}
ELSEIF ($_action=="Accept New Act Schedule Item")
{
//include("/inks/LMHeader.php");
/* set up new item schedule */
$sql="SELECT MAX(ScheduleID) as MAXIMUM FROM ScheduleOfEvents WHERE 1";
$result=@mysql_query($sql) or die("couldn't execute maxevid query.");
$id1=@mysql_fetch_array($result);
$schedid=$id1["MAXIMUM"];
$sql2="SELECT MAX(ScheduleID) as MAXIMUM2 FROM ScheduleOfEvents_Old WHERE 1";
$result2=@mysql_query($sql2) or die("couldn't execute maxevid query.");
$id2=@mysql_fetch_array($result2);
$schedid2=$id2["MAXIMUM2"];

if ($schedid2>$schedid)
{
$maxschedid=$schedid2;
}
ELSE
{
$maxschedid=$schedid;
}
	  if (strlen($maxschedid)>6)
	  {
      $maxschedid=( $maxschedid+1);
	  }
	  ELSE
	  {$maxschedid=($maxschedid+100001);
	  }
$thisschedidnew=$maxschedid;


$sqlinsertnewitem="INSERT INTO ScheduleOfEvents VALUES ('$thiseventMainEVID','$thisactid','$thisprogramorder',0,'$thisstageid','$thistypeofevent','$thisschedidnew','','','$thisstime','$thisetime','','',1,'$thisstatus','0000-00-00')";

$result=@mysql_query($sqlinsertnewitem) or die("couldn't Add New Schedule Item query.");

$sqlnewact ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status, ScheduleOfEvents.Admission, ScheduleOfEvents.ActConfirmed, ScheduleOfEvents.MainGenre, ScheduleOfEvents.status, ScheduleOfEvents.sent2media 
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE (ScheduleOfEvents.MainEVID='$thiseventMainEVID' AND ScheduleOfEvents.ScheduleID ='$thisschedidnew')";
$resultnewact = @mysql_query($sqlnewact) or die("couldn't execute this Select query.");
$thisrow=@mysql_fetch_array($resultnewact);
$thisstime=$thisrow["Stime"];
$thisetime=$thisrow["Etime"];
$thisstage=$thisrow["StageName"];
$thisstageid=$thisrow["StageID"];
$thisactname=$thisrow["ActName"];
$thisactid=$thisrow["ActID"];
$thisprogramorder=$thisrow["ProgramOrder"];
$thisstatus=$thisrow["status"];
$thisactconfirmed=$thisrow["ActConfirmed"];
$thisAdmission=$thisrow["Admission"];
$thismaingenre=$thisrow["MainGenre"];
$thisschedid=$thisrow["ScheduleID"];
$sent2media=$thisrow["sent2media"];

		?>
<Table class="centertable"><TH colspan="3" class="searchhdr">New Schedule Item for Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> Has Been Added. </th>
<TR><TD>
<form action="<?PHP echo $PHP_SELF;?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid;?>">
<tr><TD align="right"><b>Act Name:</b> </TD><td><input type="text" name="thisactname1" value="<?PHP echo $thisactname;?>" size="<?PHP echo $actnamelen; ?>" onFocus=actnamechange()>&nbsp;</td></tr>
<TR><TD align="right">Start Time: </TD><TD>
<?PHP$inhour="thisshour1";
$inminute="thissminute1";
$inampm="thissampm1";

timeselectbox($thisstime,$inhour,$inminute,$inampm,$textcolortime);?>
</td></tr>

<TR><TD align="right">Finish Time: </TD><TD>

<?PHP$inhour="thisehour1";
$inminute="thiseminute1";
$inampm="thiseampm1";

timeselectbox($thisetime,$inhour,$inminute,$inampm,$textcolortime);?>
          <?PHP isstage();
?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>" size="2"></form>&nbsp;
<?PHP
$value="Help on Order";
$name="";
$OnClick="alert('Program Order begins at 0, with higher numbers indicating later performance times. The highest number indicates the last performer.')";
lmnalertbutton($value, $name,$OnClick);
?>
<!--<INPUT TYPE="button" Value="Help on Order" onClick='alert("Program Order begins at 0. The highest number indicates the last performer.")'>-->

</td></tr>
<tr><TD align="right">Current Status: </td><TD align="left"><?PHPstatusselectbox($thisstatus, $textcolorstatus);?></td></tr>
<tr><TD colspan="3" align="center">&nbsp;
<?PHP
editdefaultbuttons($thiseventMainEVID);?>
<!-- <button OnClick="window.location='maineventedit.php?thiseventMainEVID=<?PHP//echo $thiseventMainEVID;?>'" style="background-color: "Black"><font color="blue">Return to this Event </button>-->

&nbsp;</td></tr>
</td></tr></table>

<?PHP

}
ELSEIF ($_action=="Delete_This_Item")
{ 
//include("/inks/LMHeader.php");
$sqlaccepted ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime, Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status, ScheduleOfEvents.Admission, ScheduleOfEvents.ActConfirmed,  ScheduleOfEvents.status  
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE ScheduleOfEvents.ScheduleID='$thisschedid'";
$resultaccepted = @mysql_query($sqlaccepted) or die("couldn't execute this Accepted Select query.");
$thisrow=@mysql_fetch_array($resultaccepted);
$thisactname=$thisrow["ActName"];
$thisactid=$thisrow["ActID"];
$thisstime=$thisrow["Stime"];
$thisetime=$thisrow["Etime"];
$thisstage=$thisrow["StageName"];
$thisactname=$thisrow["ActName"];
$thisprogramorder=$thisrow["ProgramOrder"];
$thisstatus=$thisrow["status"];
$thisactconfirmed=$thisrow["ActConfirmed"];
$thisAdmission=$thisrow["Admission"];
?>
<Table class="centertable">
<TH colspan="3" class="searchhdr">Schedule Editing Form For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD align="center" colspan="3"><B><span style="color: Red;"> Are You Sure You Want to Delete This Event?</span></td></tr>
<form action="<?PHP echo $PHP_Self; ?>" method="<?PHP echo $method;?>">
<input type="hidden" name="validvenue" value="<?PHP echo $validvenue;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid; ?>">
<tr><TD align="right">Act Name: </TD><td><input type="text"  value="<?PHP echo $thisactname;?>" size="<?PHP echo $actnamelen; ?>" readonly onFocus=actnamechange()>&nbsp;</td></tr>
<TR><TD align="right">Start Time: </TD><TD><input type="text" style="color:<?PHP echo $textcolorstime;?>"  value="<?PHP echo $thisstime;?>" size="11" readonly >&nbsp;</td></tr>
<TR><TD align="right">Finish Time: </TD><TD><input type="text" style="color:<?PHP echo $textcoloretime;?>"  value="<?PHP echo $thisetime;?>" size="11" readonly></td></tr>
<?PHPisstage();?>
<TR><TD align="right">Program Order: </TD><TD><input type="text" style="color:<?PHP echo $textcolororder;?>" name="thisprogramorder1" value="<?PHP echo $thisprogramorder;?>"READONLY size="2">&nbsp;</td></tr>
<tr><TD align="right">Status: </td><td align="left">
<?PHP statusselectbox($thisstatus,$textcolorstatus);?></td></tr>
<tr><TD colspan="3" align="center">&nbsp;
<?PHP
$type="submit";
$name="submit";
$value="Final Item Deletion";
forminputbutton($type, $name, $value,$OnClick);?>
<!--<input type="submit" name="submit" value="Final Item Deletion">-->

&nbsp;
<?PHP
$value="Cancel";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
<!--<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=<?PHP //echo $thiseventMainEVID;?>'" style="background-color: grey">Cancel</button>-->

</td></tr>
</form>
</td></tr></table>
<?PHP}
ELSEIF ($_action=="Final Item Deletion")
{
//include("/inks/LMHeader.php");


// Check to see if there is already a changeevent record for this date and the mediainfo has not been sent.
$changeddate=date('Y-m-d'); 
$sqlcheck="Select ScheduleOfEvents_Old.ScheduleID, ScheduleOfEvents_Old.sent2media FROM ScheduleOfEvents_Old 
WHERE ScheduleOfEvents_Old.ScheduleID='$thisschedid'
ORDER BY ScheduleID";
$oldschedcheck=@mysql_query($sqlcheck) or die("couldn't check prior schedule changes for today query.");
$changedschedid=@mysql_fetch_array($oldschedcheck);


//If an old schedule record changed today exists, check if info has been sent.
    if ($changedschedid["ScheduleID"])
    {
        if ($changedschedid["sent2media"]=="0000-00-00")// If media info has not been sent, change status to deleted.
		{
		$sqlupdate="UPDATE ScheduleOfEvents_Old SET status='DE' WHERE ScheduleID='$thisschedid'";
		}
		ELSE // sent2media is "Yes," so add a second record
		{
		   $sqlremoveact="SELECT * FROM ScheduleOfEvents WHERE ScheduleID='$thisschedid'";
   $deleteschedule=@mysql_query($sqlremoveact) or die("couldn't Copy Deleted Schedule  query.");
   $delresult=@mysql_fetch_array($deleteschedule);
            DO
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
           $delinput_site="2";
		   $sent2media=$delresult["sent2media"];
           $changeddate=date('Y-m-d'); 
           }
           WHILE ($deleteschedule=@mysql_fetch_array($delresult));

// Insert old schedule record in ScheduleOfEvents_Old
 $sqlsaveschedule="INSERT INTO ScheduleOfEvents_Old VALUES ('','$delMainEVID','$delActID', '$delProgramOrder','$delActConfirmed','$delstageID','$delTypeofEvent','$delScheduleID','$delMainGenre','$delAdmission','$delStime','$delEtime','0000-00-00','$changeddate','$delinput_site','DE','$user_id','$sent2media')";
$delinsertresult=@mysql_query($sqlsaveschedule) or die("couldn't Save Changed Schedule query: {$sqlsaveschedule}.");
		}
	}
    ELSE
   {

    //If no old schedule record for this date exists, inset one with all current data.
   $sqlremoveact="SELECT * FROM ScheduleOfEvents WHERE ScheduleID='$thisschedid'";
   $deleteschedule=@mysql_query($sqlremoveact) or die("couldn't Copy Deleted Schedule  query.");
   $delresult=@mysql_fetch_array($deleteschedule);
 
     DO
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
	 $sent2media=$delresult["sent2media"];
     $delinput_site="2";
     $changeddate=date('Y-m-d'); 
	     }
      WHILE ($deleteschedule=@mysql_fetch_array($delresult));

// Insert old schedule record in ScheduleOfEvents_Old
 $sqlsaveschedule="INSERT INTO ScheduleOfEvents_Old VALUES ('','$delMainEVID','$delActID', '$delProgramOrder','$delActConfirmed','$delstageID','$delTypeofEvent','$delScheduleID','$delMainGenre','$delAdmission','$delStime','$delEtime','0000-00-00','$changeddate','$delinput_site','DE','$user_id','$sent2media')";
$delinsertresult=@mysql_query($sqlsaveschedule) or die("couldn't Save Changed Schedule query: {$sqlsaveschedule}.");


    }
// Delete the ScheduleOfEvents record

$sqlitemdel="UPDATE ScheduleOfEvents SET status='DE'
WHERE ScheduleID='$thisschedid' LIMIT 1"; 
$result=@mysql_query($sqlitemdel,$connection4) or die("Couldn't set Delete status for this".$thisschedid."Item");

?><Table class="centertable">
<TH colspan="3" class="searchhdr">Schedule Editing Form For Event <?PHP echo $thiseventMainEVID; ?><BR>on <?PHP echo $thisdate;?> at <?PHP echo $venuename;?> </th>
<TR><TD align="center" colspan="3"><B><span style="color: blue;">Schedule Item <?PHP echo $thisschedid; ?> Deleted!</span></td></tr>
<tr><TD colspan="3" align="center">
<?PHP
$value="Return to Main Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
<!--<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=<?PHP //echo $thiseventMainEVID;?>'" style="background-color: grey">Return to  Main Event</button>-->

</td></tr>

<?PHP
}// endo of submit check


}//end of issubmit
?>



