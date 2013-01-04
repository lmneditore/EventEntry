<?PHP 
session_start();
include ("/inks/functions.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?PHP

if (!$validvenue)
{
header("Location: http://www.louisvillemusicnews.net"); 
}
ELSE
{
//include("/inks/LMHeader.php");
$str1="$theseactnames";

$actchunk = "%".$str1."%";



$sql4 ="SELECT DISTINCT Acts.ActName, Acts.ActID
FROM Acts
WHERE Acts.ActName LIKE '$actchunk'
GROUP BY ActName";


$result4 = @mysql_query($sql4) or die("couldn't execute query.");
?>
<body >
<?PHP displayLMHeader();?>
<table bgcolor="#f5e3a1" border=1 bordercolor="blue" align="center" cellpadding="1" valign="top">
<TH class="IssueHdr">Currently Listed Acts</TH>

<?PHP
While ($thisrow = @mysql_fetch_array($result4))
If ($thisrow["ActName"])
{
echo"<tr><TD class=\"Act\" align=\"center\">";
$thisactid=$thisrow["ActID"];
$type="submit";
$name="submit";
$value="This Act";
$OnClick="http://louisvillemusicnews.net/eventediting/imageupload.php?submit=Assign To An Act&thisactid=$thisactid";
forminputbutton($type, $name, $value,$OnClick);
echo "</td></tr>";
}
Else
{
echo "<tr><td class = \"Act\">There are no records for any acts currently listed.</td></tr>";
}
mysql_close($connection4);
?>

</table>
<?PHP}?>


