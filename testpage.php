<?PHP
Echo "HELLO";
//include("classes/library.php");
if(class_exists("library"))
	{
		echo "class exists";
		$library2=new library;
	}
	ELSE
	{
		echo "no library class";
	}

$dbname="louisvil_louisvillemusiccom";
$fieldname="State";
$outtable="states";
$selvalue="KY";
$emptyvalue="AA";
$keyfieldname="State";
$library2->optionfield_outtable($dbname, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname);
echo $library2->option;
?>
