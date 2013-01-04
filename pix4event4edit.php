<?PHP
session_start();
//include("/inks/LMHeader.php");

session_unregister("thisrecord");
?>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css" TYPE="text/css">
<?PHP
$sqlpix="SELECT *  FROM Pix4Event WHERE MainEVID='$thiseventMainEVID'";
$result=@mysql_query($sqlpix) OR DIE ("Couldn't complete Pix4Event query for MainEVID=".$thiseventMainEVID."");
$pix4event=@mysql_fetch_array($result);
IF ($pix4event==NULL)
{
?><Table class="centertable">
<!--#f5e3a1-->
<th class="searchhdr" colspan="2">Photo for Event </th>
<TR>

<TD class="editeventdate" align="center" COLSPAN="2">
<?PHP 
$value="Add Photo";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editpix4event.php?thiseventMainEVID=$thiseventMainEVID&submit=New";
$windowlocation="window.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>


</td></tr></table><?PHP
}
ELSE
{
DO
{
$thumb=$pix4event["PathToThumbs"];
$image=$pix4event["PathToPhoto"];
$valuei="Edit Path to Photo";
$valuet="Edit Path to Thumb";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editpix4event.php?submit=Edit&thiseventMainEVID=$thiseventMainEVID";
$name="";
$windowlocation="window.location";
?><Table class="centertable">
<th class="searchhdr" colspan="3" >Photo for Event </th>
<TR><TD rowspan="4" align="center"><img src="<?PHP echo $thumb;?>" height="75" align="left"><TD class="tdl" colspan=""><?PHP$buttons->lmnbutton($valuei, $name,$OnClick,$windowlocation);?></td><td style="font-size:8 pt;"><?PHP echo $image;?></td></tr>
<TR><TD class="tdr" width="45"><?PHP $buttons->lmnbutton($valuet, $name,$OnClick,$windowlocation);?> </td><TD class="tdl" style="font-size: 8pt;"><?PHP echo $thumb;?></td></tr>
<?PHP 
/*$value="Add Photo";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/editpix4event.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="window.location";
echo "<tr><td align=\"center\" colspan=\"2\">";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);*/?>

<!--<button OnClick="window.location=''http://www.louisvillemusicnews.net/eventediting/editpix4event.php'" style="background-color: "gray"><font color="blue">Add Photo</button>-->
</td></tr></table><?PHP
}
WHILE  ($pix4event=@mysql_fetch_array($result));
}

?>