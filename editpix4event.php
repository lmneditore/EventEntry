<?php 
SESSION_START();
require ("/inks/functions.php");
require ("editvars.php");

if (session_is_registered("thiseventMainEVID"))
{
}
ELSE
{
session_register("thiseventMainEVID");
}

$path="http://www.louisvillemusicnews.net/eventediting/";
if ($_action)
{
}
ELSE
{
$_action="Edit";
}

if ($dirpath)
{
}
ELSE
{
$dirpath="../images";
}

function imagelookup($dirpath,$imagetype,$imagesizename)
{

	if (substr(strtolower($dirpath),0,4)=="http")
	{
	echo "alert(\"Cannot lookup photos on other servers.\")";
	}
	ELSE
	{
	}
//open the current directory

$directory = opendir($dirpath);
echo "<TABLE border=\"1\" align=\"center\" class=\"centertable\">";
echo "<form action=\"<".$PHP_SELF."?MainEVID=".$MainEVID."\" method=\"GET\">";
echo "<tr><TD class=\"tdl\">Look Up ".$imagesizename."</td><td class=\"tdr\" colspan=\"2\">";
echo "<SELECT NAME=\"\" size=\"1\">";
while ($file = readdir($directory))
	{
	$filenames[] = $file;
	}
	foreach ($filenames as $file)
	{
	printf ("<OPTION VALUE=\"%s\"",$file);
	printf(">%s</OPTION>",$file);
	}

echo "</SELECT>";
echo "</td></tr>";
echo "</form></table>";
}

function commonbuttons()
{
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
lmbackup($value);
echo "&nbsp;";
$value="Return to this Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
}

?> 


<LINK REL="stylesheet" HREF="LMNStyles.css" TYPE="text/css">
<style>
.tablebody {
background-color: #f5e3a1;
border-color: #ffff33; 
border: 1; 
width: 575; 
text-align: left;
valign:top;
}
.tdl {
font-weight: bold;
color: black;
text-align: right;
}

.tdr {
font-weight: bold;
color: black;
text-align: left;
}

</style>
</head>
<<body bgcolor="#0F3925"><?

//displayLMHeader();?>
<?
if ($thiseventMainEVID)
{
$where="WHERE MainEVID='$thiseventMainEVID'";
if ($MainEVID)
{
}
ELSE
{
$MainEVID=$thiseventMainEVID;
}
}
ELSE
{
$where="WHERE 1 LIMIT 0, 1";
}
function dbconnection($dbhost,$dbusername,$dbpassword,$dbname)
{
global $connection4;
$connection4=@mysql_connect("localhost","louisvil","ADW7FSxg") or die("couldn't connect to host.");
$db=@mysql_select_db("louisvillemusic_com",$connection4) or die("Couldn't select database.");
}
$connection=dbconnection("localhost","louisvil","ADW7FSxg","louisvillemusic_com");

$keyfield=EventPixID;
IF(!isset($_POST["action"]))
{
$connection;
$sqlPix4Event="SELECT Pix4Event.EventPixID, Pix4Event.MainEVID, Pix4Event.PathToThumbs, Pix4Event.PathToPhoto FROM Pix4Event $where";
$result=@mysql_query($sqlPix4Event) or die ("Couldn't do the Pix4Event  query.");
$thisfetch=@mysql_fetch_array($result);

$thisrecord=$thisfetch["EventPixID"];
session_register("thisrecord");
$EventPixID=$thisfetch["EventPixID"];
$EventPixIDlen=strlen($thisfetch["EventPixID"]);
$EventPixIDcolor="Blue";
$EventPixIDsuf="1";
session_register("EventPixID");

$MainEVID=$thisfetch["MainEVID"];
$MainEVIDlen=strlen($thisfetch["MainEVID"]);
$MainEVIDcolor="Blue";
$MainEVIDsuf="1";
session_register("MainEVID");

$PathToThumbs=$thisfetch["PathToThumbs"];
$PathToThumbslen=strlen($thisfetch["PathToThumbs"]);
$PathToThumbscolor="Blue";
$PathToThumbssuf="1";
session_register("PathToThumbs");

$PathToPhoto=$thisfetch["PathToPhoto"];
$PathToPhotolen=strlen($thisfetch["PathToPhoto"]);
$PathToPhotocolor="Blue";
$PathToPhotosuf="1";
session_register("PathToPhoto");

 
   if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $thiskeylen=$$thiskeylength;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylength=$thiskeylen;
		   $$thiskeysuf="2";

           }

           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="red";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}
?>

<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="centertable"><TH class="searchhdr" colspan="2">Photos to Display For Specific Main Events</th><TR><TD class="tdl">
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $thiseventMainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> " READONLY></td><TR>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> "></td><TR>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> "></td><TR>
<TR><TD colspan="2" align="Center">
<?
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$type="submit";
$name="submit";
$value="Update";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
<?
$type="submit";
$name="submit";
$value="New";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
<?
$value="Return to this Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php?thiseventMainEVID=$thiseventMainEVID";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>

&nbsp;

<?
$type="submit";
$name="submit";
$value="List";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?></td></tr></table></form><?PHP 
?>
<form action=<?$PHP_SELF;?>?submit="Select Photo" method="GET">
<TR><TD colspan="1">
<?
imagelookup($dirpath,"","Photo");
?></td></tr>
<TR><TD colspan="1"><?
imagelookup("../images/thumbs","","Thumbnail");
?> </td></tr>
<tr><td colspan="2">
<?
$type="submit";
$name="submit";
$value="Select Photo";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
echo "</td></tr>";
}
ELSE{//submit exists
IF ($_action=="Update")
{
 
    if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylength=$thiskeylen;
		   $$thiskeysuf="2";
           }

           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="red";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}
?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="centertable"><TH class="searchhdr" colspan="2"><I>Items In Red Have Been Changed.</i></TH></tr>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $thiseventMainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> " READONLY></td></tr>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> "></td></tr>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> "></td></tr>
<TR><TD align="Center" colspan="2">
<?
$type="submit";
$name="submit";
$value="Accept";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
</td></tr></table></form><TR><TD colspan="2" align="center">
<?
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
commonbuttons();
}
ELSEIF
($_action=="Accept")
{
$sqlPix4Event="SELECT Pix4Event.EventPixID, Pix4Event.MainEVID, Pix4Event.PathToThumbs, Pix4Event.PathToPhoto FROM Pix4Event $where";
$result=@mysql_query($sqlPix4Event) or die ("Couldn't do the Pix4Event  query.");
$thisfetch=@mysql_fetch_array($result);

$EventPixID=$thisfetch["EventPixID"];
$EventPixIDlen=strlen($thisfetch["EventPixID"]);
$EventPixIDcolor="Blue";
$MainEVID=$thisfetch["MainEVID"];
$MainEVIDlen=strlen($thisfetch["MainEVID"]);
$MainEVIDcolor="Blue";
$PathToThumbs=$thisfetch["PathToThumbs"];
$PathToThumbslen=strlen($thisfetch["PathToThumbs"]);
$PathToThumbscolor="Blue";
$PathToPhoto=$thisfetch["PathToPhoto"];
$PathToPhotolen=strlen($thisfetch["PathToPhoto"]);
$PathToPhotocolor="Blue";
 
    if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $$thiskeylen=$thiskeylength;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylen=$thiskeylength;
		   $$thiskeysuf="2";

           }
           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}

?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="centertable"><TH class="searchhdr" colspan="2"><I>Are You Sure You Want to Change These Items?</i></TH>
<TR><TD>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $thiseventMainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> " READONLY></td></tr>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> " ></td></tr>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> " ></td></tr>
<TR><TD colspan="2" align="center">
<?
$type="submit";
$name="submit";
$value="Final Accept";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
</td></tr></table></form><TR><TD colspan="2" align="center">
<?
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
commonbuttons();
}
ELSEIF ($_action=="Final Accept")
{
   If ($_GET)
   {
   reset($_GET);
   $getcount=count($_GET); 
   $i=0;
    while (list ($key, $val) = each ($_GET))
      {
      $getkey=substr(strrev($key),0,1);
	  $keylen=strlen($key);
	  $shortstring=substr($key,0,($keylen-1));
         IF ($getkey=="2")
         {
             if($i==($getcount-2))
			 {
			 $updates[$i]=" ".$shortstring."="."'".$val."'";
			 $updatearray=array_merge($updatearray,$updates);
			 			 break;
			 }
			 ELSE
			 {
			 $updates[$i]=" ".$shortstring."="."'".$val."'";
 			 $updatearray=array_merge($updatearray,$updates);
			 $i=++$i;
			 }
          }
          if ($getkey=="1")
         {
         }

		  $i=++$i;
       }
       }
	   echo $updates;
$updatestring=implode(",",$updates);
$update1="Update Pix4Event SET ";
$updatetag=" WHERE EventPixID=$thisrecord";
$wholestring=$update1.$updatestring.$updatetag;
$result=@mysql_query($wholestring) or die("couldn't run update table query.");


$connection;
$sqlPix4Event="SELECT Pix4Event.EventPixID, Pix4Event.MainEVID, Pix4Event.PathToThumbs, Pix4Event.PathToPhoto FROM Pix4Event WHERE  EventPixID='$thisrecord' LIMIT 0,1";
$result=@mysql_query($sqlPix4Event) or die ("Couldn't do the Pix4Event  query.");
$thisfetch=@mysql_fetch_array($result);

$EventPixID=$thisfetch["EventPixID"];
$EventPixIDlen=strlen($thisfetch["EventPixID"]);
$EventPixIDcolor="Blue";
$EventPixIDsuf="1";
session_register("EventPixID");

$MainEVID=$thisfetch["MainEVID"];
$MainEVIDlen=strlen($thisfetch["MainEVID"]);
$MainEVIDcolor="Blue";
$MainEVIDsuf="1";
session_register("MainEVID");

$PathToThumbs=$thisfetch["PathToThumbs"];
$PathToThumbslen=strlen($thisfetch["PathToThumbs"]);
$PathToThumbscolor="Blue";
$PathToThumbssuf="1";
session_register("PathToThumbs");

$PathToPhoto=$thisfetch["PathToPhoto"];
$PathToPhotolen=strlen($thisfetch["PathToPhoto"]);
$PathToPhotocolor="Blue";
$PathToPhotosuf="1";
session_register("PathToPhoto");

?><FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<input type="hidden" name="MainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<TABLE class="centertable"><TH class="searchhdr" colspan="2">The record has been updated.</th>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $thiseventMainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> " READONLY></td><TR>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> "></td><TR>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> "></td><TR>
<TR><TD colspan="2" align="Center">
</td></tr></table></form><TR><TD colspan="2" align="center">
<?
echo "<DIV align=\"center\">";
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\">";
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\">";
$value="Return to this Event";
$name="";
$OnClick="http://www.louisvillemusicnews.net/eventediting/maineventedit.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "&nbsp;";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "</div>";
}
ELSEIF ($_action=="New")
{
?>
<TABLE class="centertable"><TH class="searchhdr" colspan="2">Add A New Photo for this Event</th>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<input type="hidden" name="MainEVID" value="<?PHP echo $thiseventMainEVID;?>">
<TR><TD class="tdl" >MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVID;?>" value="<?PHP echo $thiseventMainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="5" READONLY></td></tr>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs " value=""  style="color:<?PHP echo $PathToThumbscolor;?>" size="66"></td></tr>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto" value=""  style="color:<?PHP echo $PathToPhotocolor;?>" size="66"></td></tr>
<TR><td class="act" align="center" colspan="2">Include complete path to photo, e.g., "http://www.mydomain/mydirectory/imagename.jpg"</td></tr>
<tr><TD align ="center" colspan="2" >
<?

echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$type="submit";
$name="submit";
$value="Add";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
<?
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;<BR>
<tr><TD colspan="3" align="center">
<?


commonbuttons();

?>
</td></tr>
</form>
</td></tr></table>
<?
}
ELSEIF ($_action=="Add")
{

//include("/inks/LMHeader.php");

$pixmaxid="SELECT Max(Pix4Event.EventPixID) as MAXID FROM Pix4Event";
$sqlid=@mysql_query($pixmaxid,$connection4) OR DIE ("Couldn't select the Max ID from Pix4event");
//$max=@mysql_fetch_array($sqlid);
echo $sqlid;
$Pix4EventMaxID=($sqlid+1);
$sqlcols="Show columns FROM Pix4Event";
$result=@mysql_query($sqlcols) or die("couldn't execute first table query.");
$countcols=@mysql_num_rows($result);
$fields=@mysql_fetch_array($result);
$insertstr1="INSERT into Pix4Event VALUES ('$Pix4EventMaxID','$thiseventMainEVID','$PathToThumbs1','$PathToPhoto1')";
$newrec=@mysql_query($insertstr1) or die ("Couldn't do the Pix4Event query.");


$sqlPix4Event="SELECT *  FROM Pix4Event WHERE EventPixID='$Pix4EventMaxID' LIMIT 0,1";
$result=@mysql_query($sqlPix4Event) or die ("Couldn't do the Pix4Event  query.");
$thisfetch=@mysql_fetch_array($result);

$thisrecord=$thisfetch["EventPixID"];
session_register("thisrecord");
$EventPixID=$thisfetch["EventPixID"];
$EventPixIDlen=strlen($thisfetch["EventPixID"]);
$EventPixIDcolor="Blue";
$EventPixIDsuf="1";
session_register("EventPixID");

$MainEVID=$thisfetch["MainEVID"];
$MainEVIDlen=strlen($thisfetch["MainEVID"]);
$MainEVIDcolor="Blue";
$MainEVIDsuf="1";
session_register("MainEVID");

$PathToThumbs=$thisfetch["PathToThumbs"];
$PathToThumbslen=strlen($thisfetch["PathToThumbs"]);
$PathToThumbscolor="Blue";
$PathToThumbssuf="1";
session_register("PathToThumbs");

$PathToPhoto=$thisfetch["PathToPhoto"];
$PathToPhotolen=strlen($thisfetch["PathToPhoto"]);
$PathToPhotocolor="Blue";
$PathToPhotosuf="1";
session_register("PathToPhoto");

?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
<TABLE class="centertable"><TH class="searchhdr" colspan="2">Photo Successful Added For This Event</th><TR><TD>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $MainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> "></td><TR>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> "></td><TR>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> "></td><TR>
<TR><TD colspan="2" align="Center">
<?
$type="submit";
$name="submit";
$value="Update";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
<?
$type="submit";
$name="submit";
$value="New";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
echo "&nbsp;";
$type="submit";
$name="submit";
$value="List";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
echo "<TR><TD colspan=\"2\" align=\"center\">";

$value="Return to Event";
$name="return";
$OnClick=$path."maineventedit.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
&nbsp;</td></tr>

</td></tr></table></form><?PHP 


}
ELSEIF ($_action=="Edit")
{
$connection;
$sqlPix4Event="SELECT *  FROM Pix4Event WHERE MainEVID='$thiseventMainEVID' LIMIT 0,1";
$result=@mysql_query($sqlPix4Event) or die ("Couldn't do the Pix4Event  query.");
$thisfetch=@mysql_fetch_array($result);

$thisrecord=$thisfetch["EventPixID"];
session_register("thisrecord");
$EventPixID=$thisfetch["EventPixID"];
$EventPixIDlen=strlen($thisfetch["EventPixID"]);
$EventPixIDcolor="Blue";
$EventPixIDsuf="1";
session_register("EventPixID");

$MainEVID=$thisfetch["MainEVID"];
$MainEVIDlen=strlen($thisfetch["MainEVID"]);
$MainEVIDcolor="Blue";
$MainEVIDsuf="1";
session_register("MainEVID");

$PathToThumbs=$thisfetch["PathToThumbs"];
$PathToThumbslen=strlen($thisfetch["PathToThumbs"]);
$PathToThumbscolor="Blue";
$PathToThumbssuf="1";
session_register("PathToThumbs");

$PathToPhoto=$thisfetch["PathToPhoto"];
$PathToPhotolen=strlen($thisfetch["PathToPhoto"]);
$PathToPhotocolor="Blue";
$PathToPhotosuf="1";
session_register("PathToPhoto");

?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
<TABLE class="centertable"><TH class="searchhdr" colspan="2">Edit The Path To the Photo for This Event</th><TR><TD>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="MainEVID<?PHP echo $MainEVIDsuf;?>" value="<?PHP echo $MainEVID;?>"  style="color:<?PHP echo $MainEVIDcolor;?>" size="<?PHP echo $MainEVIDlen;?> "></td><TR>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?> "></td><TR>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?> "></td>
<TR><TD class="act"></td><td class="act" align="center" colspan="2">Include complete path to photo, e.g., "http://www.mydomain/mydirectory/imagename.jpg"</td></tr>

<TR><TD colspan="2" align="Center">
<?
$type="submit";
$name="submit";
$value="Update";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
</td></tr></table></form>
<?
echo "<DIV align=\"center\"><hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
commonbuttons(); 
echo "</div>";
}
ELSEIF ($_action=="Select This Photo")
{
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
		$$thiskeyname=$thiskeyval;
		$$thiskeylength=($thiskeylen);
		
		}
	}
?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">
<TABLE class="centertable"><TH class="searchhdr" colspan="2">Photo Selected For Main Event <?$MainEVID?></th><TR><TD>
<TR><TD class="tdl">MainEVID :</td><TD class="tdr"><input type="text" name="thiseventMainEVID" value="<?PHP echo $thiseventMainEVID;?>"  style="color:"black" size="8" READONLY></td><TR>
<TR><TD class="tdl">PathToThumbs :</td><TD class="tdr"><input type="text" name="PathToThumbs<?PHP echo $PathToThumbssuf;?>" value="<?PHP echo $PathToThumbs;?>"  style="color:<?PHP echo $PathToThumbscolor;?>" size="<?PHP echo $PathToThumbslen;?>"></td><TR>
<TR><TD class="tdl">PathToPhoto :</td><TD class="tdr"><input type="text" name="PathToPhoto<?PHP echo $PathToPhotosuf;?>" value="<?PHP echo $PathToPhoto;?>"  style="color:<?PHP echo $PathToPhotocolor;?>" size="<?PHP echo $PathToPhotolen;?>"></td><TR>
<TR><TD colspan="2" align="Center"><?
If (!$thisrecord)
{
$type="submit";
$name="submit";
$value="Add";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
}
ELSE
{
$type="submit";
$name="submit";
$value="Update";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
}
?>
&nbsp;</form></td></tr>
<?php echo "<TR><TD colspan=\"3\" align=\"Center\">";
echo "<hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Select Photo From LMN Archive";
$name="submit";
$OnClick="lookupactphoto.php?submit=Find";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);

commonbuttons();

}
}
?>