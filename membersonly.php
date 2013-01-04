<?PHP
session_start();


$class="library";
if(class_exists($class))
	{}
ELSE
{
function __autoload($class)
{
    include($class . '.php');
    // Check to see whether the include declared the class
    if (!class_exists($class, false)) {
        trigger_error("Unable to load class: $class", E_USER_WARNING);
    }
}
}
  $library=new library();
$buttons=new buttons;
$library->displayloginheader("Louisville Music News.net Member Login");

echo "<table align=\"center\"><th class=\"searchhdr\" align=\"center\">Welcome, ".$valid_user." <BR>What's your pleasure?</th>";?>
<tr><td align="center"><BR>
<?PHP
$value="Account Information";
$name="";
$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/personinfo.php?submit=Edit";
$windowlocation="";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->button;
echo "<br /><br />";
$value="Test Page";
$name="_action";
$OnClick="index.php";
$windowlocation="window.location";
$buttons->containedmenubutton($value, $name,$formname,$onclick);
$library->verifycalendaruser($_SESSION["user_id"]);
Echo $library->display;
?><BR><BR><?PHP /*
echo "<tr><TD colspan=\"2\"align=\"center\"width=\"160\"><BR>";
	$formname="Log Out";
	$name="_action";
	$value="Log Out";
	$OnClick="index.php";
	$formnmae="parent.location";
	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	echo $buttons->button;
	echo "</td></tr><tr><TD colspan=\"2\"align=\"center\"width=\"160\"><BR></td></tr></table>"; */
	?>
