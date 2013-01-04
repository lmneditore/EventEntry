<?PHP
//include("/inks/LMHeader.php");
$sqlcheck="SELECT MAX(changedid) AS Maxid FROM eventchange 
WHERE schedid='$thisschedid'
ORDER BY schedid DESC";
$result=@mysql_query($sqlcheck) OR DIE("Couldn't find the maximum changedid.");
$checkid=@mysql_fetch_array($result);
$maxid=$checkid["Maxid"];
if ($maxid>0)
{
echo $maxid;
}
ELSE
{
Echo "No record";
}
?>

