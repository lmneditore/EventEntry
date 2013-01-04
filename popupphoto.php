<?PHP 
Session_start();


 foreach ($_REQUEST AS $key=>$val)
 {
    //  echo $key."=".$val."<BR>";
	 $$key=$val;
    
 }
 
 if(!isset($PhotoID) && isset ($PixID))
 {
 }
 ELSEIF (isset($PhotoID) && !isset($PixID))
 {
	 $PixID=$Photoid;
 }
 

include ("../classes/actphoto.php");
echo "<style>";
echo ".$buttons->lmnbutton";
echo "{";
echo "font-size: 12 px;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "border-style: groove;";
echo "}";
echo "</style>";

//$variables list------
if($stylesheet)
{
}
ELSE
{
$stylesheet="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css";
}?>
<style>
.act { 
background: #f5e3a1; 
color: black; 
text-align: left; 
line-height: 11pt; 
font-size: 9pt; 
font-weight: semi-bold; 
font-family: arial; 
}
.maintable {
background: #f5e3a1; 
border:2;
border-color:#4b3838;
text-align: center;
}
.inserttable
{
background:#f5e3a1;
border:0;
border-color:#0099D1; 
text-align: center;
}
</style>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP  echo $stylesheet;?> TYPE="text/css">




<script type="text/javascript">
<!--
function checksize() {
window.moveTo(0,0)
}

// -->
</script>
</head>


<?PHP 
////displayLMHeader();
include ("/inks/LMhdrw.inc");
if (!isset($PixID))
{
echo "That Photo is not available";
}
ELSE
{
$sql="SELECT * FROM
pixfromevents 
LEFT JOIN LMNContributor 
ON pixfromevents.PhotoBy=LMNContributor.LMNContributorID 
WHERE PixID='".$PixID."'";
$result=@mysql_query($sql);
$numrows=@mysql_query($result);
echo $numrows;
	if (!$numrows<1)
	{
	
	}
	ELSE
	{
	$photo=@mysql_fetch_array($result);
		Do
		{
		$pathtoimage=$photo["PathToPhoto"];
		$PhotoCredit=$photo["WholeName"];
		$PhotoFileName=$photo["Name"];
		$Caption=trim($photo["annotation"]);
		
			if (!$PhotoCredit)
			{
			$PhotoCredit="Bio Photo. Used by Permission";
			}
		}
		WHILE ($photo=@mysql_fetch_array($result));
	}
}


?>
<body onLoad="checksize()" bgcolor="#0c4a7d">
<?PHP 
if (!$PhotoCredit)
{
$PhotoCredit="Bio Photo. Used by Permission";
}
$chosensize="250";
$align="Left";
$thisphoto=new returnimage();
$thisphoto->getimage($pathtoimage,$chosensize,$align);
echo "<table class=\"maintable\" align=\"left\" border=\"1\"><TH>".$Caption."</th>";
echo "<TR><td align=\"left\">";
echo "<table align=\"left\" valign=\"bottom\" class=\"inserttable\"><tr><td>";
echo $thisphoto->thisimage;
echo "</td><td>";
echo "<table align=\"left\"><TR><TD class=\"act\" align=\"Left\" >Photo Credit:<BR><B>".$PhotoCredit."</b></td></tr></table></td></tr>";
echo "<TR><TD>";
closewindow();
echo "</td></tr></table></table></td></td>";

//end of no result
?>
</table>


