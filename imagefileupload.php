<?PHP 
Session_start();
include("functions.php");
//$variables list------

$stylesheet="http://www.louisvillemusicnews.net/lmn/evententry/venueedit.css";




	
//functions list 

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet; ?> TYPE="text/css">

<?PHP 
displayLMHeader();


	
//functions list 

?>
<table align="center" width="480"><th class="searchhdr" colspan="3">Photo Uploads</th><tr><td class="act" colspan="3">
<form enctype="multipart/form-data" action="imageupload.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="30000">
Lookup file: <input type="file" name="newUploadedFile"><?PHP 
echo "<BR>";
$type="submit";
$name="_action";
$value="Send File";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick); ?>

</form>
</td></tr></table>




</body>
</html>
