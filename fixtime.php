<?PHP 
include("functions.php");
if (thisdoorhour1)
{
$thisdoor=$thisdoorhour1.":".$thisdoorminute1." ".$thisdoorampm1;
echo $thisdoor;
}
if($thisdoor)
{
$thistime=$thisdoor;
}
ELSE
{$thisdoor=$thistime;
}

$textcolordoor="Blue";



//echo $thistime;
//echo $inhour;
//echo $inminute;
//echo $inampm;


$inhour="thisdoorhour1";
$inminute="thisdoorminute1";
$inampm="thisdoorampm1";

?>
<Form action="<?PHP $PHP_SELF ?>" method="GET">
<tr><td align="right">
<?PHP $thistime=""; ?>
&nbsp;&nbsp;&nbsp;Doors Open:&nbsp;<?PHP timeselectbox($thistime,$inhour, $inminute,$inampm, $intextcolor); ?>
</td></tr><input type="submit" name="submit" value="Submit">
</form>

