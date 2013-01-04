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

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet; ?> TYPE="text/css">

<html>
<head>
</head>

<body>
<?PHP 
$filename=$_FILES["userfile"]["name"];
echo "filenamne=".$filename;
echo "<BR>";
$filetype=$_FILES["userfile"]["type"];
echo "filetype=".$filetype;
echo "<BR>";
$filesize=$_FILES["userfile"]["size"];
echo "Size=".$filesize;
echo "<BR>";
$tmpname=$_FILES["userfile"]['tmp_name'];
echo "tempname=".$tmpname;
echo "<BR>";
$dimen=getimagesize($tmpname);

//$_FILES['userfile']['error']
$width=$dimen[0];
echo "Width=".$width;
echo "<BR>";
$height=$dimen[1];
echo "Height=".$height;



?>


</body>
</html>
