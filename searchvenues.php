<?php
session_start();


IF ($_action=="Select A Venue")
{

$display .="<table width=\"580\" align=\"center\">";
$display .="<form action=\"index.php\" method=\"POST\">";
$display .="<tr><td class=\"searchinstructions\" align=\"center\"><table  align=\"center\" border=0>";
$display .="<tr><td class=\"searchhdr\" colspan=\"3\" >Search for Venues</td></tr>";
$display .="<tr><td class=\"venuesearchinstructions\" colspan=\"3\" align=\"center\">Enter a portion of the name of a venue <BR>for which you are searching, for example \"Phoenix,\" \"tavern,\" \"bar.\" <BR>Wildcard characters are not necessary. <br>Leave blank for alphabetical list of all venues with events.";
$display .="<tr><td Class=\"venuesearchinstructions\" align=\"center\">Venue Name<BR> <input type=\"text\" name=\"thesevenuenames\" value=\"\" size=\"25\" maxlength=\"250\">";
$display .="</td></tr><tr><td Class=\"venuesearchinstructions\">";
$display .="<hr width=\"120\" size=\"1 px\"><DIV style=\" color: black;	text-align: Center; font-size: 16px; font-weight: semi-bold; font-family: arial; \">";
$type="submit";
$name="_action";
$value="Find Venue";
$buttons->forminputbutton($type, $name, $value,$onClick);
$display .=$buttons->button;
$display .="</div></td></tr></form></table>";
$display .="<table   align=\"center\">";
$display .="<tr><td class=\"venuesearchinstructions\"><hr width=\"320\" size=\"1 px\">";
$display .="</td></tr><tr><td align=\"center\" class=\"venuesearchinstructions\">";
}
ELSEIF($_action=="Find Venue")
{
$sql = "SELECT DISTINCT Venues.VenueName, Venues.VenueID FROM Venues WHERE VenueName LIKE '%".$thesevenuenames."%' ORDER BY VenueName";

$result = @mysql_query($sql) or die("couldn't execute ".$sql."");
$display .="<table width=\"365\" align=\"Center\">";
$display .="<TR ><TD class=\"searchhdr\">Live Music Venues</td></tr>";
		Do
		{
		$validvenue=$thisrow["VenueID"];
		$venuename=$thisrow["VenueName"];
		$value=$venuename;
			if (!isset($venuename))
			{
			}
			ELSE
			{
				$display .="<TR class=\"venuelist\"><TD   class=\"tdc\"><DIV style=\" color: black;text-align: Center; font-size: 16px; font-weight: semi-bold; font-family: arial; \">";
					$formname="selectvenue";
					$hidden="<input type=\"hidden\" name=\"_action\" value=\"This Venue\">";	
					$name="submit";
					$value=$venuename;
					$onclick="index.php?validvenue=".$validvenue;
					$windowlocation="parent.location";
					$buttons->containedlistbutton($value, $name,$formname,$onclick,$hidden);
				$display .= $buttons->button;
				$display .="<br></div></td></tr>\n";
			}
		}
		while ($thisrow = @mysql_fetch_array($result));
	$display .="<TR class=\"venuelist\"><TD  class=\"tdc\"><DIV style=\" color: black;text-align: Center; font-size: 16px; font-weight: semi-bold; font-family: arial; \">";
	$display .="<hr width=\"360\" size=\"1 px\" >";
		$formname="searchvenue";
		$name="_action";
		$value="Select A Venue";
		$onclick="index.php";
		$windowlocation="parent.location";
		$buttons->containedmenubutton($value, $name,$formname,$onclick);
	$display .= $buttons->button;
	$display .="</div></td></tr>";
} 
//	$display .="<tr><TD style=\"text-align :center; width:240;\"><BR>";
		$formname="membersform";
		$name="_action";
		$value="Members";
		$onclick="index.php";
		$windowlocation="parent.location";
	//	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	//	$display .=$buttons->button;
//	$display .="</td></tr>";
	//$display .="<tr><TD colspan=\"2\"align=\"center\"width=\"160\"><BR>";
	$formname="Log Out";
	$name="_action";
	$value="Log Out";
	$onclick="index.php";
	$formnmae="parent.location";
	//$buttons->containedmenubutton($value, $name,$formname,$onclick);
	//$display .=$buttons->button;
	$display .="<tr><TD colspan=\"2\"align=\"center\"width=\"160\"><BR></td></tr></table>";
	echo $display;
?>
