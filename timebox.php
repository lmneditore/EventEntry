<?PHP 

include("functions.php");



// example
$thiseventtime="";
correcttimeformat($thiseventtime);
$thisshour=$thishour;
$thissminute=$thisminute;
$thissampm=$thisampm;
echo "<table>";
echo "<FORM>";
echo "<tr><td align=\"right\" style=\"color:".$thisstimecolor."\">Start Time: </td><td align=\"left\">";

timeselectbox(shour,sminutes,sAMPM,$thisshour,$thissminute, $thissampm, $thisstimecolor);
//echo "</td></tr><tr><td align=\"right\" style=\"color:".$thisetimecolor."\">End Time: </td><td align=\"left\">";
//timeselectbox(ehour,eminutes,eAMPM,$thisehour,$thiseminute,$thiseampm, $thisetimecolor);
//echo "</td></tr></form>";
//echo "</table>"; ?>
