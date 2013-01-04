<?PHP 
$MainEVID= $_GET["MainEVID"];
//$cnxn=new lm_netconnection();
//$cnxn->lm_connection("louisvil_louisvillemusiccom");
$sql ="SELECT ScheduleOfEvents.ScheduleID, ScheduleOfEvents.Stime, ScheduleOfEvents.Etime,  Acts.ActName, Acts.ActID, RIGHT(ScheduleOfEvents.Stime,2) as dpart, Stages.StageName, Stages.StageID, ScheduleOfEvents.ProgramOrder, ScheduleOfEvents.status
FROM ScheduleOfEvents LEFT JOIN Acts ON ScheduleOfEvents.ActID=Acts.ActID LEFT JOIN Stages ON ScheduleOfEvents.StageID=Stages.StageID WHERE ScheduleOfEvents.MainEVID='".$MainEVID."' 
ORDER BY Stages.StageName ASC, ProgramOrder ASC, dpart ASC, ScheduleOfEvents.Stime ASC";
$results =mysql_query($sql) or die("couldn't execute actlist query.");
$thisrow=mysql_fetch_array($results);
$numrows=mysql_num_rows($results);
echo $numrows;

?>
<DIV class="centertable">
<DIV class="searchhdr">Acts scheduled for this event</div>

<div class="searchhdr"><B>Act Name</b></div>
<div class="searchhdr"><b>Start</b></div><div class="searchhdr"><b>End</b></div><div class="searchhdr"><b>Status</b></div><div class="searchhdr"><b>Order</b></div>
<?PHP

/* IF ($isstage=="Y")
{
?> <div class="searchhdr"><b>Stage Name</b></div> <div class="searchhdr" colspan="2">actions</div><?PHP 
}
ELSE
{
?> <div class="searchhdr" colspan="2">actions</div><?PHP 
}
*/
Do
    {
    $ActName=htmlspecialchars($thisrow["ActName"]);
    $ScheduleID=$thisrow["ScheduleID"];
    ?>
    <div align="left"><FORM action="editthisscheduleitem.php" method="Get">
    <input type="hidden" name="thisschedid" value="<?PHP  echo $ScheduleID;?>">
    <input type="hidden" name="validvenue" value="<?PHP  echo $validvenue;?>">
    <input type="hidden" name="thiseventMainEVID" value="<?PHP  echo $MainEVID;?>">  
    <div align="left"><b><?PHP  echo $ActName;?></b>
    &nbsp;<div align="left"><?PHP  echo $thisrow["Stime"];?></div><div align="left"><?PHP  echo $thisrow["Etime"];?></div><div align="left"><?PHP  echo  $thisrow["status"];?></div><div align="left"><?PHP  echo $thisrow["ProgramOrder"];?></div>
        <?PHP if ($isstage=="Y")
        {
		echo "<DIV>";
		Echo $thisrow["StageName"];
		ECHO "</div>";
        }
           ?><div align="center">&nbsp;
<?PHP 	
$value="Edit This Item";
//$buttons->submitbutton($value);
?>
</div></form>
<?PHP // echo "<hr width=\"160\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$name="submit";
$value="Delete This Item";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisscheduleitem.php?submit=Delete_This_Item&thisschedid=".$thisschedid."";
//$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
?>
	</div>
<?PHP    
}
While ($thisrow=mysql_fetch_array($results));

?>
</div>

