<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet 
HREF="http://www.louisvillemusicnews.net/lmn/evententry/venueedit.css" TYPE="text/css">

<html>
<head>
	<title>Image File Details</title>
</head>

<body>
<?PHP 
include ("functions.php");
echo "<table width=\"150\" background-color=\"#f5e3a1\" border=\"1\"><th class=\"venuesite\">Here are the details for this file:</th><tr><td class=\"act\">";
echo "filename=".$filename;
echo "<BR>";
echo "filetype=".$filetype;
echo "<BR>";
echo "filesize=".$filesize;
echo "<BR>";
echo "tmp_name=".$tmp_name;

echo "</td></tr><tr><td class=\"act\" align=\"center\">";
$type="button";
$name="close";
$value="Close";
$OnClick="window.close()";
forminputbutton($type, $name, $value,$OnClick);
echo "</td></tr></table>";
?>
</body>
</html>
