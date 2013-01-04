<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
$title = "Act Calendar";
$stylesheet = "http://www.louisvillemusicnews.net/lmn/LMNStyles.css";
echo "<LINK REL=stylesheet HREF=\"$stylesheet\" TYPE=\"text/css\">";
//include("/inks/LMHeader.php");
?>
<?PHP
$str1="$thesevenuenames";
$venuechunk = "%".$str1."%";
$sql4 = "SELECT DISTINCT Venues.VenueName, Venues.VenueID
FROM Venues
WHERE VenueName LIKE '$venuechunk'
ORDER BY VenueName";
$result = @mysql_query($sql4) or die("couldn't execute query.");
?>

<table border="0" width="365" align="Center" bgcolor="#FEF2CF">
<TR><TD ALIGN="CENTER" VALIGN="TOP" colspan="3" class="IssueHdr" style="font-size:18pt; line-height:22pt">Live Music Venues<BR>
<?PHP
DO
{
$thisvenueid=$thisrow["VenueID"];
$thisvenuename=$thisrow["VenueName"];
If ($thisvenueid)
{
echo "<TR><TD class=\"VenuebyRegion\">";?>
<FORM action="http://www.louisvillemusicnews.net/eventediting/submitdateonly.php". method="post">
<input type="hidden" name="thisvenueid" value="<?PHP echo $thisvenueid; ?>">
<input type="hidden" name="thisvenuename" value="<?PHP echo $thisvenuename;?>"> <?php echo $thisvenuename;?></td><td align="center"><input type="submit" name="logthisvenue" value="Select"></td></form>
<?PHP }
}
while ($thisrow = @mysql_fetch_array($result));
mysql_close($connection4);
?>
</table>


