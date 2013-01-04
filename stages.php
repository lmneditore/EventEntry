<?PHP
session_start();
include ("/inks/LMHeader.php");
require ("editvars.php");


IF ($thisstageid)
{
    If 
    ($thisstageid==$thisstageid1)
    {$stagetext=$defaulttext;
    }
    ELSE
    {
    $thisstageid=$thisstageid1;
    $stagetext=$changedtext;
    }
}
ELSE
{
$stagetext=$defaulttext;
}
	
	?>
	

	<?
$sqlcountstage ="SELECT Count(StageName) as numstage
FROM Stages
WHERE Stages.VenueID='$venueid'
GROUP BY VenueID";

$stagecount = @mysql_query($sqlcountstage) or die("couldn't execute stage count query.");
$thiscount = @mysql_fetch_array($stagecount);
$numstage=$thiscount["numstage"];
If ($numstage)
{
$size=$numstage;?>
<tr><td colspan="2">
Stage: </td><td><select name="thisstageid1" size="<?php echo $size?>">
<?
}
ELSE
{
}

$sqlstage ="SELECT Stages.StageID, Stages.StageName 
FROM Stages
WHERE Stages.VenueID='$venueid'";
$results = @mysql_query($sqlstage) or die("couldn't execute stage query.");
$thisrow = @mysql_fetch_array($results);
    DO
    {

          if ($thisrow["StageID"]==$thisstageid)
         {
         $AC=$thisrow["StageID"];
         $AR=$thisrow["StageName"];
		// echo $AC;
         echo "<OPTION style=\"color:".$stagetext."\" value=\"".$AC."\" SELECTED>".$AR."</OPTION>";
         }
         ELSE
         {
         $AC= $thisrow["StageID"];
         $AR=$thisrow["StageName"];
         echo "<OPTION style=\"color:".$stagetext."\" value=\"".$AC."\">".$AR."</OPTION>";
         }

     }
    While ($thisrow = @mysql_fetch_array($results));
?>


</SELECT></td></tr>

