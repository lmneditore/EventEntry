<?PHP 
Session_start();

//include("/inks/LMHeader.php");

function commonbuttons($thiseventMainEVID)
{
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
lmbackup($value);
echo "&nbsp;";
echo "<form action=\"http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID\" method=\"POST\" name=\"Return_to_Event\">";
$value="Return_to_this_Event";
submitbutton($value);
echo "</form>";
echo "&nbsp;";
echo "<form action=\"http://www.louisvillemusicnews.net/lmn/members/lmlogout.php\" method=\"POST\">";
$value="Log Out";
submitbutton($value);
}
//$variables list------
if($stylesheet)
{
}
ELSE
{
$stylesheet="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css";
}
$str1="$theseactnames";

$actchunk = "%".$str1."%";

if ($_action)
{
}
ELSE
{
$_action="Find";
}
 if ($_GET)
	{
reset ($_GET);
	   while (list ($key, $val) = each ($_GET)) 
	   {
		$thiskeyval=$val;
		$thiskeyname=$key;
		$thiskeycolor=$thiskeyname."color";
		$thiskeylength=$thiskeyname."len";
		$thiskeysuf=$thiskeyname."suf";
		$thiskeylen=strlen($thiskeyval);
		$$thiskeysuf="1";
		$$thiskeycolor="black";
		$$thiskeylength=($thiskeylen-13);
		}
	}

//displayLMHeader();
//functions list 

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet;?>" TYPE="text/css">



</head>

<body bgcolor="#0F3925">


<?PHP
if ($_action=="Find")
{?>
<table class="MainTable">
<tr><td colspan="3">
<form action="<?PHP echo $PHP_SELF;?>" method="Post">
<TR><TD class="photosearchhdr" colspan="3"><b>Find an Act </b></td></tr>
<tr><td Class="act" colspan="3">Enter a portion of the name of an act you are searching for, e.g. "Monarch," "Orchestra", "Band".<BR> Wildcard characters are not necessary.
<tr><td Class="act" colspan="3">
<b>Act Name</b><BR> <input type="text" name="theseactnames" value="" size="25" maxlength="100"><BR>
<BR>
<?PHP 
$type="submit";
$name="submit";
$value="Search";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
echo "</form>";
commonbuttons($thiseventMainEVID);
?>

</td></tr>
</table>
<?PHP
}
ElSEIF ($_action=="Search")
{
$sql4 ="SELECT DISTINCT Acts.ActName, Acts.ActID
FROM Acts
WHERE Acts.ActName LIKE '$actchunk'";


$result4 = @mysql_query($sql4) or die("couldn't execute query.");
$thisrow = @mysql_fetch_array($result4);
?>
<body >
<table class="maintable">
<TH class="searchhdr" colspan="2">Matching Acts </TH>

<?PHP
DO
{
	If ($thisrow)
	{
	$act=$thisrow["ActName"];
	$escapedact=addslashes($act);

	$actid=$thisrow["ActID"];
echo "<tr><TD class=\"act\" style=\"text-align:right;\" width=\"290\">";
echo $act;
	echo "</td><td class=\"act\" style=\"text-align:left;\" width=\"290\">";
	
$value="Select Act";
$name="submit";
$OnClick="http://www.louisvillemusicnews.net/eventediting/onlinephotolookup.php?submit=Select Act&thisactid=$actid&actname=$escapedact";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	}
	Else
	{
	echo "<tr><td class = \"Act\">There are no records for any acts like 	$actchunk.</td></tr>";
	}
}
While ($thisrow = @mysql_fetch_array($result4));
echo "<TR><TD class=\"act\" colspan=\"3\">";

echo "<hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Search Again";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);

commonbuttons();

mysql_close($connection4);
?>
</table>
<?PHP
}
ElSEIF ($_action=="Select Act")
{

$pixsql="SELECT Acts.ActName, Photos.PathToThumbs, Photos.PathToPhoto, Photos.PhotoID, Photos.PhotoCredit FROM Photos
LEFT JOIN Acts
ON Acts.ActID=Photos.ActID
WHERE Acts.ActID='$actid'
GROUP BY PhotoID";
$pix=@mysql_query($pixsql,$connection4) OR DIE ("Could not look up photos.");
$actphoto=@mysql_fetch_array($pix);
$actname=$actphoto["ActName"];
echo "<table  style=\" border: thick; border-style: ridge; border-color:#c8cec9; bgcolor:#FEFCD8; cellpadding: 5; align: center; width:580px;\"><th class=\"title\" colspan=\"3\">Select Photo For<BR> $actname</th>";
DO
{
	if ($actphoto)
	{
		$PathToThumbs=$actphoto["PathToThumbs"];
		$PathToPhoto=$actphoto["PathToPhoto"];
		$chosensize="125";
		checkisfile($PathToThumbs,$chosensize);
		echo "<TR><TD class=\"act\"><form action=\"http://www.louisvillemusicnews.net/eventediting/editpix4event.php\" method=\"GET\" >";
		$type="hidden";
		$name="PathToThumbs";
		$value=$PathToThumbs;
		$OnClick="";
		forminputbutton($type, $name, $value,$OnClick);

		$type="hidden";
		$name="PathToPhoto";
		$value=$PathToPhoto;
		$OnClick="";
		forminputbutton($type, $name, $value,$OnClick);
		echo "<img src=$PathToThumbs $imgvar >&nbsp; ";
		$type="submit";
		$name="submit";
		$value="Select Photo";
		$OnClick="";
		forminputbutton($type, $name, $value,$OnClick);
		echo "&nbsp;</form>";
		echo "</td></tr>";
	}
	ELSE
	{
	echo "<TR><TD class=\"act\" colspan=\"3\">There are no photos available for this act.</td></tr>";
	}

}
WHILE ($actphoto=@mysql_fetch_array($pix));
echo "<tr><td class=\"act\" colspan=\"3\">";
$value="Back One";
lmbackup($value);
echo "</td></tr>";
}
?>
</td></tr></table>



