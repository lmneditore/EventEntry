<?PHP
session_start();
require ("/inks/functions.php");



$title = "Louisville Acts";

//include("/inks/LMHeader.php");
?>
<?PHP
$method="Get";
unset($thisactname);
$str1="$theseactnames";
if  ($NewScheduleItem=="New_Schedule_Item")
{
$_action="New_Schedule_Item";
}

$actchunk = "%".$str1."%";

if (!isset($_POST["action"]))
{
echo "<TABLE align=\"center\"><TR><TD align =\"center\">";
echo "You must have not clicked on the correct button. Perhaps you just hit 'Enter,' which isn't right. Please click this button to go return to where you were and try again.";
echo "</td></tr><tr><td align=\"center\">";
echo "<INPUT TYPE=\"Button\" VALUE=\"Back\" onClick=\"history.go(-1)\">";
echo "</td></tr></table>";
}
ElSEIF ($_action=="Search For Replacement") // submit exists
{

       $value="Replacement Act";
       $actnamevalue="thisactname";
       $actidvalue="thisactid";
}
ELSEIF ($_action=="Search")
{
       $value="Select";
       $actnamevalue="thisactname";
       $actidvalue="thisactid";
	   $NewScheduleItem="New_Schedule_Item";
}
$sql4 ="SELECT DISTINCT Acts.ActName, Acts.ActID, AMGMusicGenre, AMGSubstyle1, AMGSubstyle2
FROM Acts
WHERE Acts.ActName LIKE '$actchunk'
GROUP BY ActName";


$result4 = @mysql_query($sql4) or die("couldn't execute find act query.");
$thisrow = @mysql_fetch_array($result4);
?>

<table class="centertable">
<TH class="IssueHdr" colspan="2"> Currently Listed Acts With Names Matching * <?php echo $str1;?> *</TH>
<tr><TD><table align="Center">


<?PHP
If ($thisrow["ActID"])
{
    DO 
   {
    $thisactid=$thisrow["ActID"];
    $thisactname=$thisrow["ActName"];
	$thisactname_d=htmlspecialchars($thisactname);
	$thisactname=addslashes($thisactname_d);
    $thisActMainGenre=$thisrow["AMGMusicGenre"];
    $thisActSubstyle1=$thisrow["AMGSubstyle1"];
    $thisActSubstyle2=$thisrow["AMGSubstyle2"];
?>
<tr><TD class="Act" align="center" width="100%"><?PHP echo $thisactname_d;?></td><TD class="Act" align="center" width="100%">
<FORM action="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php" method="GET">
<input type="hidden" name="thiseventMainEVID" value="<?php echo $thiseventMainEVID;?>"> 
<input type="hidden" name="thisactid1" value="<?php echo $thisactid;?>">
<input type="hidden" name="thisactname1" value="<?php echo $thisactname;?>">
<input type="hidden" name="thisschedid" value="<?php echo $thisschedid;?>">   
<?
submitbutton($value);?>
</form>
<?}
   While ($thisrow = @mysql_fetch_array($result4));
}
Else
{
echo "<tr><td class = \"Act\" colspan=\"2\">There are no acts like ".$theseactnames." listed. </td></tr>";
}
mysql_close($connection4);
?>
</td></tr>
</table>
</td></tr>
<TR><TD colspan="2" align="Center">&nbsp;
<?
$value="Add a New Act";
$name="submit";
$OnClick="http://www.louisvillemusicnews.net/eventediting/addact.php?venueid=$validvenue&venuephone=$venuephone";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;

<?
$type="button";
$name="return";
$value="New Search";
$OnClick="history.go(-1)";
forminputbutton($type, $name, $value,$OnClick);?>

</td></tr>
<?PHP
//}
?>
</table>


