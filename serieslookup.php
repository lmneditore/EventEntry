<?PHP
session_start();

if($validvenue)
{
}
ELSE
{ 
$validvenue=-1;
}
if($seriestext)
{
}
ELSE
{
$seriestext="black";
}
include ("/inks/LMHeader.php");
$sqlseries ="SELECT Series.SeriesID, Series.SeriesTitle
FROM Series
WHERE Series.PresenterOrg='$validvenue'
ORDER BY SeriesTitle";


$result = @mysql_query($sqlseries) or die("couldn't execute  Series query.");
$thisseries = @mysql_fetch_array($result);

if ($thisseries)
{
   DO
   {
      if ($seriesid==$thisseries["SeriesID"])
      {
      $seriesid= $thisseries["SeriesID"];
      $seriesname=$thisseries["SereisTitle"];
      $option_block .= "<OPTION style=\"color: $seriestext; \" value=\"$seriesid\" selected>$seriesname</OPTION>";
       }
       Else
       {
       $seriesid= $thisseries["SereisID"];
       $seriesname=$thisseries["SeriesTitle"];
       $option_block .= "<OPTION style=\"color:$seriestext;\" value=\"$seriesid\">$seriesname</OPTION>";
        }
     }
     While ($thisseries = @mysql_fetch_array($result));
?>

<tr><td colspan=3">
Series: <select name="thisseries1">
<?PHP echo "$option_block"; ?>
</SELECT></td></tr>

<?
}
ELSE
{
}
?>
