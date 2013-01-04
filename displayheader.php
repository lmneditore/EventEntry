<?PHP 
Session_start();
//include("functions.php");
function lmbutton($value, $name,$OnClick,$windowlocation)
{
$len=strlen($value);
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 9 pt;";
echo "background-color: #0F3925;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: thick ridge #bdd7c8;";
echo "border-right-width: thick;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "width: ".$len.";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
	If ($windowlocation)
	{
	}
	ELSE
	{
	$windowlocation="parent.location";
	}

	echo "<button OnClick=\"$windowlocation='$OnClick'\" class=\"lmnbutton\" name=\"$name\" onmouseover=\"font-weight: 'bold';\" onmouseout=\"font-weight: 'normal';\">$value</button>";
}

//$variables list------
?>
<html>
<head>
</head>

<body>

<?PHP 
//displayLMHeader();
echo "<table width=\"580\"><TR><TD>";
lmbutton("This Is the Button", $name,$OnClick,$windowlocation);
?>
</td></tr></table>
</body>
</html>
