<?PHP 
Session_start();
include("functions.php");
include ("/inks/lmbucnx.inc");
function commonbuttons()
{
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
lmbackup($value);
echo "&nbsp;";
$value="Return to this Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
}
//$variables list------
if($stylesheet)
{
}
ELSE
{
$stylesheet="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css";
}

function check4file($image,$chosensize)
{
	global $fp;
	global $imgvar;
	global $actualsize0;
	global $actualsize1;
  $fp = @fopen($image,"r");
        if (!$fp)
        {
		}
		ELSE
		{
        $size = getimagesize($image);
            if ($size[0]>$size[1])//If width is greater than height
            { $actualsize0=$size[0];
			$actualsize1=$size[1];
            $imgvar="width=\"".$chosensize."\"";
			            }
            Else
            {
            $imgvar="height=\"".$chosensize."\"";
            }
        }
 
}
//functions list 
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet;?> TYPE="text/css">



</head>

<?PHP
//displayLMHeader();
$sqlbu="SELECT PhotoFileName, PathToThumbs,PathToPhoto, photosonline.PhotoID FROM
actsxphotos
LEFT JOIN photosonline ON actsxphotos.photoid =photosonline.PhotoID
WHERE actsxphotos.actid='$thisactid'";
$result=@mysql_query($sqlbu,$connectionbu) OR DIE ("Unable to look up Photo information for $thisactid");
$photos=@mysql_fetch_array($result);
?><table class="maintable" align="center" border="medium" width="560">
<TH class="photosearchhdr" colspan="2" align="Center"><?PHP echo $actname; ?> Photos in the Louisville Music News Archives</th>
<?PHP
$chosensize="50";
DO
{
if ($photos)
{
$filename=$photos["PhotoFileName"];
$thumbpath=$photos["PathToThumbs"];
$imagepath=$photos["PathToPhoto"];
$thisphotoid=$photos["PhotoID"];

check4file($thumbpath,$chosensize);


if (!$imgvar)
	{
	}
	ELSE
	{
	echo "<TR><TD class=\"act\" align=\"right\">$filename <BR>";
	
$value="Select This Photo";
$name="";
$OnClick="editpix4event.php?submit=$value&PathToThumbs=$thumbpath&PathToPhoto=$imagepath";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	
	
	echo "</td><TD class=\"act\" align=\"left\">";
	check4file($imagepath,$chosensize);
		if (!$fp)
		{
		echo "<img src=\"$thumbpath\" height=\"50\" align=\"left\"></td></tr>";
		}
		ELSE
		{

		$sizeofpix=getimagesize($imagepath);
		$winw=$sizeofpix[0]+300;
		$winh=$sizeofpix[1]+90;
		echo "<table align=\"left\"><tr><TD align=\"center\"><a href=\"javascript:void(window.open('popupphoto.php?PhotoID=$PhotoID', 'popupphotowindow', 'width=$winw, height=$winh, menubar=yes, toolbar=no, scrollbars=no, resizeable=1'))\" ><img src=\"$thumbpath\" height=\"50\" align=\"left\"></a></td><td style=\" font-size: 7 pt; font-weight: 400; text-align: left;\">Click for<BR> largest image.</td></tr>";
echo "</table>";
echo "</td></tr>";
		}
	}
}
ELSE
{
echo "<TR><TD class=\"act\" align=\"center\">There are no photos for this act available in the Louisville Music News archives.</td> </tr>";
}

}
WHILE ($photos=@mysql_fetch_array($result));

echo "<tr><td align=\"center\" colspan=\"2\" >";
$value="Search Again";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
commonbuttons();
echo "</td> </tr>";?>
</table>


