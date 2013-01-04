<?PHP 
Session_start();
//include("../functions.php");
//$variables list------
if($stylesheet)
{
}
ELSE
{
$stylesheet="http://www.louisvillemusicnews.net/lmn/LMNStyles.css";
}
//functions list 
echo "title = \"".$title."\"";
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet; ?> TYPE="text/css">

<html>
<head>
</head>

<body>
<?PHP 
$dirpath="../headliners/images";
imagelookup($dirpath,"","Photo");
?>&nbsp;<?PHP 
$dirpaththumbs="../headliners/images/thumbs";
imagelookup($dirpaththumbs,"","Thumbnail");
?>


</body>
</html>
