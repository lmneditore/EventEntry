<?PHP
session_start();
if($eventtypetext)
{
}
ELSE
{
$eventtypetext="black";
}
include ("/inks/LMHeader.php");
$sqltype ="SELECT EventType.EventTypeID, EventType.TypeofEvent
FROM EventType
WHERE 1
ORDER BY TypeofEvent";


$result = @mysql_query($sqltype) or die("couldn't execute event Type query.");

While ($thistype = @mysql_fetch_array($result))
{
if ($thiseventype==$thistype["EventTypeID"])
{
	$ETID= $thistype["EventTypeID"];
	$ET=$thistype["TypeofEvent"];
	$option_block .= "<OPTION style=\"color: $eventtypetext; \" value=\"$ETID\" selected>$ET</OPTION>";
}
Else
	{
	$ETID= $thistype["EventTypeID"];
	$ET=$thistype["TypeofEvent"];
	$option_block .= "<OPTION style=\"color:$eventtypetext;\" value=\"$ETID\">$ET</OPTION>";
	}
}?>

<tr><td colspan=3">
Event Type: <select name="thiseventtype1">
<?PHP echo "$option_block"; ?>
</SELECT>