<?PHP
session_start();
require ("/inks/functions.php");
$method="Get";?>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/lmn/stylesheets/lmstyles.css" TYPE="text/css">
<body bgcolor="#0F3925">
<?PHP

//displayLMHeader();
if (!$validvenue)
{
echo "You are not authorized to be here.";

$value="Click Here";
$name="";
$OnClick="http://www.louisvillemusicnews.net";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
}
ElSE
{
   IF (!isset($_POST["action"]))
   {
   echo "<TABLE align=\"Center\"><TR><TD align=\"center\">You must not have clicked on a button. Did you just hit 'Enter'? Click on the button below to go back and try again.";
   echo "</Td></tr><tr><td align=\"center\">";
   $value="Click Here";
lmbackup($value);
   echo "</td></tr></table>";
   }
   ELSE
   {
      IF ($_action=="Replace Act")
      {?>
      <form action="http://www.louisvillemusicnews.net/eventediting/selectact.php" method="<?PHP echo $method;?>">
<input type="hidden" name="thisschedid" value="<?PHP echo $thisschedid;?>">
<table width="360" bgcolor="#FEFCD8" border=0 cellpadding="1" align="center">
<tr><td align="center">
<tr><td class="searchhdr">Search for An Act to Replace Prior Act</td></tr>
<tr><td Class="searchinstructions">Enter a portion of the name of an act you are searching for, e.g. "Nelson," "Orchestra", "Band." Wildcard characters are not necessary. Leave blank for a complete list (Will take time to load).
<tr><td Class="searchinstructions" align="center">
Act Name<BR> 
<input type="text" name="theseactnames" value="" size="25" maxlength="100"><BR>
<?PHP
$type="submit";
$name="submit";
$value="Search For Replacement";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>
&nbsp;&nbsp;
<?PHP $value="Back One";
lmbackup($value); ?>

</td></tr>
</table>
</form>
<?PHP
      } // no schedid
      ELSEIF ($_action=="New_Schedule_Item") // begin act for new schedule item
      {//$value="Search";?>
      <b><form action="http://www.louisvillemusicnews.net/eventediting/selectact.php?thiseventMainEVID=<?PHP echo $thiseventMainEVID; ?>" method="<?PHP echo $method;?>">
      <table width="360" bgcolor="#FEFCD8" border=0 cellpadding="1" align="center">
      <tr><td align="center">
      <tr><td class="searchhdr">Search for An Act For a New Schedule Item for Event <?PHP echo     $thiseventMainEVID; ?></td></tr>
      <tr><td Class="searchinstructions">Enter a portion of the name of an act you are searching for, e.g. "Nelson," "Orchestra", "Band." Wildcard characters are not necessary. Leave blank for a complete list (Will take time to load).
      <tr><td Class="searchinstructions" align="center">
      Act Name<BR> <input type="text" name="theseactnames" value="" size="25" maxlength="100"><BR>
<?PHP 
$type="submit";
$name="submit";
$value="Search";
$OnClick="";
forminputbutton($type, $name, $value,$OnClick);?>


	  &nbsp;&nbsp;
	  <?PHP $value="Back One";
lmbackup($value);?>
	
      </td></tr>
      </table>
      </form></b>
      <?PHP}
   }//end of submit confirmation

}// end of validvenue confirmation

?>



</head>







