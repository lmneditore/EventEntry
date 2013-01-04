<?PHP 
Session_start();
if (!$validvenue)
{
header("Location: http://www.louisvillemusicnews.net"); 
}
ELSE
{//set various images sizes for output
$ImageMaxWidth="300";
$maxthumbwidth="300";;
$maxthumbheight="150";
$ImageMaxHeight="150";

if ($redo=="Try Again Or Look Up Another File")
{$_action="";
}
/*if (!$newUploadedFile)
{
$_action="";

echo "<script type=\"text/javascript\" language=\"JavaScript\">";
echo "alert(\"The photo look up field cannot be empty. Please look up a photo file\")";
echo "</script>";
}*/

include ("/inks/functions.php");

function imageType($filetype)
	{
	global $filetype;
		if( eregi( "image/jpeg", $filetype))
		{ // JPG
			 $filetype= "JPG";}
		elseif( eregi( "image/png", $filetype))
		{
		  // PNG
	 	$filetype="PNG";}
		elseif(eregi("image/pjpeg",$filetype))
		{$filetype="JPG";
		}
		elseif(ereg("image/gif", $filetype))
		{
		$filetype="GIF";
		}
		else
		{
		$filetype="NONE";
		}
	}



function resize( $postImage, $filename, $width, $height, $maxWidth, $maxHeight, $tWidth, $tHeight,$filetype)
{
		
		if( $width > $maxWidth & $height <= $maxHeight )
		{
			$ratio = $maxWidth / $width;
		}
		elseif( $height > $maxHeight & $width <= $maxWidth )
		{
			$ratio = $maxHeight / $height;
		}
		elseif( $width > $maxWidth & $height > $maxHeight )
		{
			$ratio1 = $maxWidth / $width;
			$ratio2 = $maxHeight / $height;
			$imratio = ($ratio1 < $ratio2)? $ratio1:$ratio2;
		}
		else
		{
			$imratio = 1;
		}
		$nWidth = floor($width*$imratio);
		$nHeight = floor($height*$imratio);
		echo $nWidth;
		
		if( $width > $tWidth & $height <= $tHeight )
		{
			$ratio = $tWidth / $width;
		}
		elseif( $height > $tHeight & $width <= $tWidth )
		{
			$ratio = $tHeight / $height;
		}
		elseif( $width > $tWidth & $height > $tHeight )
		{
			$ratio1 = $tWidth / $width;
			$ratio2 = $tHeight / $height;
			$tratio = ($ratio1 < $ratio2)? $ratio1:$ratio2;
		}
		else
		{
			$tratio = 1;
		}
		$ntWidth = floor($width*$tratio);
		$ntHeight = floor($height*$tratio);
		echo $ntWidth;
		
		
		
		
		
		function LoadJpeg ($imgname) {
    $im = @imagecreatefromjpeg ($imgname); /* Attempt to open */
    	if (!$im) 
		{ /* See if it failed */
        $im  = imagecreate (150, 30); /* Create a blank image */
        $bgc = imagecolorallocate ($im, 255, 255, 255);
        $tc  = imagecolorallocate ($im, 0, 0, 0);
        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring ($im, 1, 5, 5, "Error loading $imgname", $tc);
		    }
    return $im;
}

	
		$newImage= imagecreate($nWidth,$nHeight);
		$newThumb=imagecreate($ntWidth,$ntHeight);

		$background_color = imagecolorallocate($newImage, 255, 255,255);
		$background_color = imagecolorallocate($newThumb, 255, 255,255);
		$im2=imagecreatefromjpeg($postImage);
		if (!$im2) 
		{ /* See if it failed */
        $imerror  = imagecreate (150, 30); /* Create a blank image */
        $bgc = imagecolorallocate ($imerror, 255, 255, 255);
        $tc  = imagecolorallocate ($imerror, 0, 0, 0);
        imagefilledrectangle ($imerror, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring ($imerror, 1, 5, 5, "Error loading $imgname", $tc);
		}
		return $im2;
		
		ImageCopyResized($newImage,$im2, 0, 0, 0, 0, $nWidth, $nHeight, $width, $height);	
		ImageCopyResized($newThumb,$im2, 0, 0, 0, 0, $ntWidth, $ntHeight, $width, $height);	

		$saveimage="../images/".$filename;
		$savethumb="../images/thumbs/".$filename;
		imagejpeg( $newImage, $saveimage,90 );
		imagejpeg( $newThumb, $savethumb,90 );
		imagedestroy($newImage);
		imagedestroy($newThumb);
		imagedestroy($im2);
		Global $imagepath;
		Global $thumbpath;
		$imagepath="http://www.louisvillemusicnews.net/images/".$filename;
		$thumbpath="http://www.louisvillemusicnews.net/images/thumbs/".$filename;
}
?>

<?PHP
if ($_action==NULL)
{
//displayLMHeader();
?><table align="center" width="480"><th class="searchhdr" colspan="3">Photo Uploads</th><tr><td class="act" colspan="3">
<form enctype="multipart/form-data" action="<?PHP echo $PHP_SELF; ?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
<b>Look up file:</b> <input type="file" name="newUploadedFile" size="45"><?PHP
echo "<BR>";
$type="submit";
$name="submit";
$value="Upload This File";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);
echo "</form>";
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 $value="Back One";
lmbackup($value);
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp";
$value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );?>

</td></tr></table>


<?PHP
}
ELSEIF ($_action=="Upload This File")
{
	//Get Files details and assign names
	$filename=$_FILES["newUploadedFile"]["name"];
	$filetype=$_FILES["newUploadedFile"]["type"];
	$filesize=$_FILES["newUploadedFile"]["size"];
	$tmp_name=$_FILES["newUploadedFile"]["tmp_name"];
	imageType($filetype);
	session_register("filename");
	session_register("filetype");
	session_register("filesize");
	session_register("tmp_name");
//check if any file details are null	
//displayLMHeader();
		if ($filename==NULL)// Check to see if there is a filename
		{
			//displayLMHeader();?>
			<form action="<?PHP echo $PHP_SELF;?>" method="Post"><?PHP
			echo "<table class=\"inserttable\" align=\"center\" >";
			echo "<tr><td class=\"act\" colspan=\"2\">There is a problem with uploading this file. Please try again.</td></tr>";?>
			<TR><TD class="act" colspan="2"><?PHP
			$value="Cancel the Upload";
			$name="Cancel";
			$OnClick=$PHP_SELF;
			$windowlocation="parent.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			echo "&nbsp";
			echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
			$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
			$windowlocation="parent.location";
			echo "&nbsp";
			$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
			$value="Edit Another Event";
			$name="Edit";
			$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
			$windowlocation="parent.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
			echo "</td></tr></table>";
			exit;?>
			</form><?PHP
		}
		ELSEIF ($filename)
		{
		// Check to see if this file is already in the database.
		include ("/inks/lmbuhdr.inc");
		$sql="Select * FROM photosonline WHERE 
		PathToPhoto like '%$filename%'";
		$result=@mysql_query($sql,$connection4) OR DIE ("Couldn't eyeball the photosonline datatable.");
		$picture=@mysql_fetch_array($result);
		$storedimage=$picture["PathToThumbs"];
		@mysql_close($connection4);
		include ("/inks/LMHeader.php");
		$sql="Select * FROM Photos WHERE 
		PathToPhoto like '%$filename%'";
		$result=@mysql_query($sql,$connection4) OR DIE ("Couldn't eyeball the photos datatable.");
		$picture=@mysql_fetch_array($result);
		$storedimage2=$picture["PathToThumbs"];
		@mysql_close($connection4);
		$filelen=strlen($filename);
			IF ((substr($storedimage,-$filelen)==$filename) || (substr($storedimage2,-$filelen)==$filename))
			{
				if (substr($storedimage2,-$filelen)==$filename)
				{$storedimage=$storedimage2;
				}
			//displayLMHeader();?>
			<form action="<?PHP echo $PHP_SELF;?>" method="Post"><?PHP
			echo "<table class=\"inserttable\" align=\"center\" >";
			echo "<tr><td class=\"act\" colspan=\"2\">This photo is already listed in the LMN database.</td></tr>";?>
			<TR><TD class="act" colspan="2"><?PHP
			$value="Cancel the Upload";
			$name="Cancel";
			$OnClick=$PHP_SELF;
			$windowlocation="parent.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			echo "&nbsp";
			echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
			$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
			$windowlocation="parent.location";
			echo "&nbsp";
			$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
			$value="Edit Another Event";
			$name="Edit";
			$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
			$windowlocation="parent.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
			echo "</td></tr></table>";
			exit;?>
			</form><?PHP
			}
			ELSE
			{
				IF ($filetype=="NONE")// Check to see if the filetype is correct 
				{ 
					echo "<TABLE Class=\"inserttable\" align=\"center\" colspan=\"2\"><tr><Td class=\"act\">This file has not been uploaded. <BR>There seems to be some question about the kind of graphic file it is. <BR>Please confirm that <BR>1. The file is a jpeg (*.jpg) and <BR>2. The file exists. Then try again. <BR>";
				echo "<a href=\"javascript:void(window.open('imagefiledetails.php?filename=$filename&filetype=$filetype&filesize=$filesize&tmp_name=$tmp_name', 'popupphotowindow', 'width=175, height=175, menubar=yes, toolbar=no, scrollbars=no, resizeable=yes'))\" >File Details</a>";
				Echo "</td></tr>";
				echo "<TR><td class=\"act\" colspan=\"2\">";
				$name="redo";
				$value="Try Again Or Look Up Another File";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/imageupload.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick, $windowlocation);
				echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" 	align=\"center\">";
				$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
				$windowlocation="parent.location";
				echo "&nbsp";
				$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
				$value="Edit Another Event";
				$name="Edit";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
				echo "</td></tr></table>";
				exit;
				}
				ELSEIF ($filename==NULL || $filetype==NULL || $filesize==0 || $tmp_name==NULL || $filesize==NULL || $filetype=="NONE")
				{//if file details are null Display "File Not Uploaded" Message
			//	//displayLMHeader();
				echo "<TABLE Class=\"inserttable\" align=\"center\" colspan=\"2\"><tr><Td class=\"act\">This file cannot be uploaded. <BR>Please confirm that <BR>1. The file is a jpeg (*.jpg) and <BR>2. The file exists. Then try again. <BR>";
				echo "<a href=\"javascript:void(window.open('imagefiledetails.php?filename=$filename&filetype=$filetype&filesize=$filesize&tmp_name=$tmp_name', 'popupphotowindow', 'width=175, height=175, menubar=yes, toolbar=no, scrollbars=no, resizeable=yes'))\" >File Details</a>";
				Echo "</td></tr>";
				echo "<TR><td class=\"act\" colspan=\"2\">";
				$name="redo";
				$value="Try Again Or Look Up Another File";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/imageupload.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick, $windowlocation);
				echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" 	align=\"center\">";
				$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
				$windowlocation="parent.location";
				echo "&nbsp";
				$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
				$value="Edit Another Event";
				$name="Edit";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
				echo "</td></tr></table>";
				exit;
				}
				ELSEIF (!is_uploaded_file($tmp_name)) 
				{ //check if $filename exists the temporary directory
				////displayLMHeader();
				echo "<TABLE Class=\"inserttable\" align=\"center\" colspan=\"2\"><tr><Td class=\"act\">This file has not been uploaded. <BR>There may be a problem with the file or with the connection. <BR>Check that the file is not corrupt and try again. <BR>";

				echo "<a href=\"javascript:void(window.open('imagefiledetails.php?filename=$filename&filetype=$filetype&filesize=$filesize&tmp_name=$tmp_name', 'popupphotowindow', 'width=175, height=175, menubar=yes, toolbar=no, scrollbars=no, resizeable=yes'))\" >File Details</a>";
				Echo "</td></tr>";
				echo "<TR><td class=\"act\" colspan=\"2\">";
				$name="redo";
				$value="Try Again Or Look Up Another File";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/imageupload.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick, $windowlocation);
				echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" 	align=\"center\">";
				$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
				$windowlocation="parent.location";
				echo "&nbsp";
				$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
				$value="Edit Another Event";
				$name="Edit";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
				echo "</td></tr></table>";
				EXIT;
				}
				ELSE
				{
				move_uploaded_file($tmp_name, "../images/tmp_".$filename); 
				$postImage="../images/tmp_".$filename;
				$dimen=getimagesize($postImage);
				$width=$dimen[0];
				$height=$dimen[1];
				$maxwidth=$ImageMaxWidth;
				$tWidth=$maxthumbwidth;
				$tHeight=$maxthumbheight;
				$maxheight=$ImageMaxHeight;
				resize($postImage, $filename, $width, $height, $maxwidth, $maxheight,$tWidth,$tHeight, $filetype);
				$lenimagepath=strlen($imagepath);
				$lenthumbpath=strlen($thumbpath);
				include ("/inks/LMHeader.php");
				$sqlcount="SELECT Max(PhotoID) as MaxPhotoID FROM Photos";
				$getid=@mysql_query($sqlcount,$connection4) OR DIE("Just couldn't find the 	maximum Photo ID in Photos.");
				$MaxID=@mysql_fetch_array($getid);
				$MaxPhotoID=(($MaxID["MaxPhotoID"])+1);
				session_register("$MaxPhotoID");
				$updatephotos="INSERT INTO Photos Values('$MaxPhotoID','$ActID','$thumbpath','$imagepath' , '$PhotoCredit', '$Caption', '$Alt', '$PhotoType', '$KillDate', '$StartDate')";
				$insertphotoresult=@mysql_query($updatephotos,$connection4) OR DIE ("Couldn't see my way to add this photo (\"$filename.\") to the photos database."); 
				////displayLMHeader();
				echo "<Table align=\"center\" width=\"480\" class=\"maintable\"><th class=\"searchhdr\">The photo has been uploaded and a thumbnail created.</th>";
				?><tr><td class="act">
				<FORM action="<?PHP $PHP_SELF; ?>" method="POST">
				<input type="hidden" name="filename" value="<?PHP $filename;?>">
				<tr><TD class="act" align="Left">
				<b>Image:</b> <img src="<?PHP echo $imagepath; ?>" align="left"><Br><input type="text" name="photopath" value="<?PHP echo $imagepath; ?>" size="<?PHP echo $lenimagepath;?> ">
				</td></tr>
				<tr><TD class="act" align="Left">
				<b>Thumb:</b> <img src="<?PHP echo $thumbpath; ?>" align="left"><BR><input type="text" name="thumbpath" value="<?PHP echo $thumbpath; ?>" size="<?PHP echo $lenimagepath; ?>">
				<tr><TD colspan="4" align="center"><?PHP
				echo "<a href=\"javascript:void(window.open('imagefiledetails.php?filename=$filename&filetype=$filetype&filesize=$filesize&tmp_name=$tmp_name', 'popupphotowindow', 'width=175, height=175, menubar=yes, toolbar=no, scrollbars=no, resizeable=yes'))\" >File Details</a>";?></td></tr>
				<tr><td colspan="3" align="Center"><?PHP
				echo " <hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
				$type="submit";
				$name="submit";
				$value="Assign To An Act";
				$OnClick=$PHP_SELF;
				forminputbutton($type, $name, $value,$OnClick);?>
				</form>		</td></tr>
				<TR><TD class="act"><?PHP 
				echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
				echo "&nbsp";
				$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
				$windowlocation="parent.location";
				echo "&nbsp";
				$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
				$value="Return to Venue List";
				$name="Edit";
				$OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
				$windowlocation="parent.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
				}
			}
		}
}
ELSEIF ($_action=="Assign To An Act")
{
//displayLMHeader();
?>      <b><form action="<?PHP $PHP_SELF;?>" method="POST">
<input type="hidden" name="filename" value="<?PHP $filename;?>">
      <table width="360" bgcolor="#FEFCD8" border=0 cellpadding="1" align="center">
      <tr><td align="center">
      <tr><td class="searchhdr">Search For An Act To Assign Photo <?PHP echo $filename;?></td></tr>
      <tr><td Class="searchinstructions">Enter a portion of the name of an act you are searching for, e.g. "Nelson," "Orchestra", "Band." Wildcard characters are not necessary. Leave blank for a complete list (Will take time to load).
      <tr><td Class="searchinstructions" align="center">
      Act Name<BR> <input type="text" name="theseactnames" value="" size="25" maxlength="100"><BR>
<?PHP 
$type="submit";
$name="submit";
$value="Search For Acts";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;
	  <?PHP $value="Back One";
lmbackup($value);
?>
</td></tr>
</td></tr></table></form>
<?PHP
}
ELSEIF ($_action="Search For Acts")
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
<?PHP //displayLMHeader();?>
<table bgcolor="#f5e3a1" border=1 bordercolor="blue" align="center" cellpadding="1" valign="top">
<TH class="IssueHdr">Currently Listed Acts Matching <?PHP$actchunk;?></TH>

<?PHP
While ($thisrow = @mysql_fetch_array($result4))
If ($thisrow["ActName"])
{
echo"<tr><TD class=\"Act\" align=\"center\">";
echo $thisrow["ActName"];
$thisactid=$thisrow["ActID"];
echo "&nbsp;";
$type="submit";
$name="submit";
$value="Assign to This Act";
$OnClick="http://louisvillemusicnews.net/eventediting/imageupload.php?thisactid=$thisactid";
forminputbutton($type, $name, $value,$OnClick);
echo "</td></tr>";
}
Else
{
echo "<tr><td class = \"Act\">There are no records for any acts matching $actchunk.</td></tr>";
}
mysql_close($connection4);?>
</table>
<?PHP
}
}
?>
</td></tr>
</td></tr></table>

