<?PHP session_start();
foreach($_REQUEST as $name=>$value)
		{$$name=$value;}
$thisincludepath="http://www.louisvillemusicnews.net/";
include ("../inks/functions.php");
//include("pagelog.inc");
include("../inks/LMhdrw.inc");
include("../classes/buttonsclass.php");
include ("../classes/browserlog.php");
$buttons=new buttons;
if (isset($returnpath))
{
unset ($returnpath);
}

if (isset($thisid))
{
}
Else
{
$thisid=2;
}

$sql="SELECT * FROM lmnwebpages WHERE lmnwebpages.lmnsectionid='$thisid'";

$result = @mysql_query($sql, $connection4) or die("couldn't execute lmhdr query.");
$thispage = @mysql_fetch_array($result);
$numfields=@mysql_num_fields($result);
Do
{

	for ($i=0; $i<$numfields; $i++) 
	{
	$thisfield=@mysql_field_name($result,$i);
	$$thisfield=$thispage[$thisfield];
	
	}
}
WHILE ($thispage = @mysql_fetch_array($result));
//$QUERY_STRING1 = $_SERVER["QUERY_STRING"];

//$QUERY_STRING = ereg_replace(" ", _, $QUERY_STRING1);
$stylesheet="http://www.louisvillemusic.com/stylesheets/LMNStyleswhiteZ.css";
if (!isset($stylesheet))
{
$stylesheet="http://www.louisvillemusic.com/stylesheets/LMNStyleswhiteZ.css";
}
elseif ($stylesheet=="http://www.louisvillemusic.com/stylesheets/lmnbrowserscss.php")
{
$stylesheet="http://www.louisvillemusic.com/stylesheets/LMNStyleswhiteZ.css";
}

$page="http://www.louisvillemusic.com/lmn/".$templatename;
$page=$templatename;
documentheaders($company, $stylesheet,$url,$meta);
?>
<body>
<!--  This is the outside container DIV -->
<DIV class="mainbody">

<DIV class="mainheader"> 
<?PHP 
echo "<img src=\"".$hdr."\"  class=\"hdrimage\">"; 
?>
</DIV>
<?PHP

?>
<DIV class="menuhdr">
<?PHP
include($umenuname);
?>
</DIV>

<DIV class="eventdate">

<?PHP
echo date("l, F j, Y");
?>
</DIV>

<!-- <DIV class="mainpage"> -->

<?PHP
$page=str_replace("http://www.louisvillemusic.com/lmn/","",$page);

include($page);

?>
<!-- </DIV> -->

<DIV class="bottomdiv"><?PHP
include($bmenu);
@mysql_close();
//include ("$bmenu");
?>
</div>
<DIV class="bottomdiv"><span style="font-size: 8pt; font-variant: small-caps;"><a href="../lmn/LMcomTermsOfUse.php" target="_blank">Terms Of Use</a>&nbsp;|&nbsp;<a href="../lmn/LMcomPrivacyPolicy.php target="_blank">Privacy Policy</a></span>
</div>

</DIV>
</body>
</html>
<?PHP

//$bcount= new logbrowser();
?>
