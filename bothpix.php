<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet 
HREF="http://www.louisvillemusicnews.net/lmn/evententry/venueedit.css" TYPE="text/css">

<html>
<head>
	<title>Duplicate Photos</title>
</head>

<body>
<?PHP 
include ("functions.php");
echo "<table width=\"150\" background-color=\"#f5e3a1\" border=\"1\"><th class=\"venuesite\">Here are the duplicate images.</th><tr><td class=\"act\">";
echo "<img src=\"$storedimage \"> - Photo already in database";
echo "<BR>";
echo "<img src=\"$thumbpath \"> - Photo being uploaded";
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