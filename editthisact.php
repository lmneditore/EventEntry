<?php
session_start();?>
<LINK REL=stylesheet HREF="http://www.louivillemusic.com/lmn/LMNStyles.css" TYPE="text/css">
<?
if ($thisstime1==$thisstime)
{$textcolorstime="black";
}
ELSE
{$thisstime=$thisstime1;
$textcolorstime="#ff3300";}

if ($thisetime1==$thisetime)
{$textcoloretime="black";
}
ELSE
{$thisetime=$thisetime1;
$textcoloretime="#ff3300";}

if ($thisstage1==$thisstage)
{$textcolorstage="black";
}
ELSE
{$thisstage=$thisstage1;
$textcolorstage="#ff3300";}



session_register($thisActID);
$ActName=stripslashes($ActName);
session_register($ActName);
?>


</head>


<?PHP if (isset($_action))
{
if ($_action="Update")
{?>
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="left" valign="top"><TH colspan="3" class="searchhdr">Schedule Edit Form for an event on <?PHP echo $thisdate?> at <?php echo $venuename?> </th>
<TR><TD>
<form action="editthisact.php" method="GET">
<input type="hidden" name="validvenue" value="<?php echo $validvenue?>">
<input type="hidden" name="thisActID" value="<?php echo $thisActID?>">
<input type="hidden" name="thiseventMainEVID" value="<?php echo $thiseventMainEVID;?>">
<input type="hidden" name="ActName" value="<?php echo $ActName?>">
<tr><TD>ActName: <TD><td><B><?php echo $ActName ?></b></td></tr>
<TR><TD>Start Time: <TD><TD><input type="text" style="color:<?php echo $textcolorstime;?>" name="thisstime1" value="<?php echo $thisstime;?>" size="11"></td></tr>
<TR><TD>Finish Time: <TD><TD><input type="text" style="color:<?php echo $textcoloretime;?>" name="thisetime1" value="<?php echo $thisetime;?>" size="11"></td></tr>
<TR><TD>Stage Name: <TD><TD><input type="text" style="color:<?php echo $textcolorstage;?>" name="thisstage1" value="<?php echo $thisstage;?>" size="11"></td></tr>
<tr><TD colspan="3" align="center"><input type="submit" name="accept" value="Click to Accept & Update Record"></td></tr>
</form>
</td></tr></table>
<?}
ELSE
{
}
}
ELSE
{

//include("/inks/LMHeader.php");
$sqledit ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime,  Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName
FROM ScheduleOfEvents
LEFT JOIN Acts
ON ScheduleOfEvents.ActID=Acts.ActID
LEFT JOIN Stages
ON ScheduleOfEvents.StageID=Stages.StageID
WHERE (ScheduleOfEvents.MainEVID='$thiseventMainEVID'
AND Acts.ActID='$thisActID')";
$resultedit = @mysql_query($sqledit) or die("couldn't execute thisact query.");
$thisrow=@mysql_fetch_array($resultedit);
$thisStime=$thisrow["Stime"];
$thisEtime=$thisrow["Etime"];
$thisStage=$thisrow["StageName"];



?>


<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="left" valign="top">
<TH colspan="2" class="searchhdr">Schedule Edit Form for an event on <?PHP echo $thisdate?> at <?php echo $venuename?> </th>
<TR><TD>
<form action="editthisact.php" method="GET">
<input type="hidden" name="validvenue" value="<?php echo $validvenue?>">
<input type="hidden" name="thisActID" value="<?php echo $thisActID?>">
<input type="hidden" name="thiseventMainEVID" value="<?php echo $thiseventMainEVID;?>">
<input type="hidden" name="ActName" value="<?php echo $ActName?>">
<tr><TD>ActName: <TD><td><B><?php echo $ActName ?></b></td></tr>
<TR><TD>Start Time: <TD><TD><input type="text" style="color:<?php echo $textcolorstime;?>" name="thisstime1" value="<?php echo $thisstime;?>" size="11"></td></tr>
<TR><TD>Finish Time: <TD><TD><input type="text" style="color:<?php echo $textcoloretime;?>" name="thisetime1" value="<?php echo $thisetime;?>" size="11"></td></tr>
<TR><TD>Stage Name: <TD><TD><input type="text" style="color:<?php echo $textcolorstage;?>" name="thisstage1" value="<?php echo $thisstage;?>" size="11"></td></tr>
<tr><TD colspan="3" align="center"><input type="submit" name="submit" value="Update"></td></tr>
</form>
</td></tr></table>
<?}
?>


