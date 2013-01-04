<?PHP 
if ($_action=="Return To This Event")
{
$_action="Edit";
session_unregister("EventStart");
session_unregister("EventEnd");
session_unregister("thisstage");
session_unregister("thisActName");
session_unregister("thisprogramorder");
session_unregister("thisstageid");
session_unregister("thisActID");
session_unregister("status");
session_unregister("AgeLimits");
session_unregister("AgeLimits1");
session_unregister("onsaledate1");
session_unregister("eventmonth");
session_unregister("thisschedid");
unset($thisschedid);
unset($thisactname);
unset($thisactid);
unset($status);
unset($EventStart);
unset($EventEnd);
unset($onsaledate1);
unset($thisstage);
}

// Sections 
// 1. Update
// 2. Delete
// 3. Final Delete
// 4. New
// 5. Add
// 6. Accept
// 7. Edit
// 8. Nothing to Do
// set text colors
$defaulttext="black";
$changedtext="red";

// section to combine event date parts --------------------------------
if (isset($eventmonth))
{
     if ($eventmonth=="0" || $eventday=="00" || $eventmonth=="00" || $eventday=="0")
     { 
     $EventDate=$EventDate;
     }
     ELSE
     {
     $eventday=((strlen($eventday)==1) ? "0".$eventday : $eventday);
     $eventmonth=((strlen($eventmonth)==1) ? $eventmonth="0".$eventmonth : $eventmonth); 
     $EventDate=$eventyear."-".$eventmonth."-".$eventday;
     }
}
ELSE
{
$EventDate=$EventDate;
}

if ($EventDate==$EventDate)
{
$textcolorEventDate=$defaulttext;
}
ELSE
{
$EventDate=$EventDate;
$textcolorEventDate=$changedtext;
}
//echo "This is the event date".$EventDate;
// Section to combine event start time parts into one piece
if ($thiseventhour || $thiseventminute || $thiseventampm)
{
$EventStart1=$thiseventhour.":".$thiseventminute." ".$thiseventampm;
}
// combine door time parts into one
if ($DoorsOpenhour || $DoorsOpenminute || $DoorsOpenampm)
{
$DoorsOpen=$DoorsOpenhour.":".$DoorsOpenminute." ".$DoorsOpenampm;
}
// combine event end time parts into one
if($thisEventEndhour || $thisEventEndminute || $thisEventEndampm)
{
$EventEnd1=$thisEventEndhour.":".$thisEventEndminute." ".$thisEventEndampm;
}
echo "EventEnd1=".$EventEnd1;

//combine On Sale date parts
    if ($onsaleday=="0" OR $onsalemonth=="0" OR $onsaleday=="00" OR $onsalemonth=="00")
    {
    }
    ELSE
    {
        if (strlen($onsaleday)==1)
           {$onsaleday="0".$onsaleday;
           }
           ELSE
           { }
              if (strlen($onsalemonth)==1)
               {$onsalemonth="0".$onsalemonth;
               }
               ELSE
               {
               }
    }
	       $onsaledate=$onsaleyear."-".$onsalemonth."-".$onsaleday;
      if ($onsaledate=="--")
    {$onsaledate=$onsaledate;
    }
   //echo "onsaledate=".$onsaledate;
   $values=array("onsaledate","EventStart","EventEnd","DoorsOpen","status","EventTitle","sponsor","Prices","DescriptionOfEvent","AgeCodeID","eventmonth","eventday","eventyear");
   //thisAgeLimits,validvenue,MainEVID,VenueID"

foreach($_GET as $key=>$val)
{
		
	if(in_array($key,$values)==TRUE)
	{
		if(isset($key))
		{
			$colorkey="textcolor".$key;
			$keyname=$key;
			$$colorkey=(($val==$_session[$key]) ? $defaulttext: $changedtext);
			$key=(($val==$_session[$key]) ? $_session[$key] : $val );
		//	echo $keyname."=".$$keyname."<BR />";
		//t	echo $colorkey."=".$$colorkey."<BR />";
		}
	}
	
	
	
} 
if (!isset($validvenue))
{

$library->displaynoauthorization();
session_unregister;
}
ELSE
{
$library->libvals();
$venueid=$validvenue;
$buttons=new buttons;

IF ($_action=="EditThisEvent")//BEGIN EDIT
{
session_unregister("thisschedid");
unset($thisschedid);
	$MainEVID=$_GET["MainEVID"];
	$cnxn->lm_connection("louisvil_louisvillemusiccom");
       $sql="SELECT MainEvents.MainEVID, MainEvents.EventDate, MainEvents.EventTitle, MainEvents.SeriesID,MainEvents.VenueID,MainEvents.DoorsOpen, MainEvents.EventStart,MainEvents.EventEnd,MainEvents.Prices, MainEvents.DescriptionOfEvent,MainEvents.AgeLimits, MainEvents.AMGGenre, MainEvents.AMGSubCat1, MainEvents.onsaledate, MainEvents.status, MainEvents.sponsor, Venues.VenueName, AgeRestrictions.AgeCodeID, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
FROM MainEvents LEFT JOIN Venues ON MainEvents.VenueID=Venues.VenueID LEFT JOIN AgeRestrictions ON MainEvents.AgeLimits=AgeRestrictions.AgeCodeID 
WHERE (MainEvents.VenueID='".$venueid."' AND MainEvents.MainEVID='".$MainEVID."')";
if($admin=="y") {echo $sql;}
 $result = @mysql_query($sql) or die("couldn't execute ".$sql."");
 $fields = @mysql_num_fields($result);
    DO {
	    for ($i=0; $i < $fields; $i++) 
                    {
                    $fieldname= mysql_field_name($result, $i);
                    $fieldtype=mysql_field_type($result,$i);
                    $fieldnametype=$fieldname."type";
                    $$fieldnametype=$fieldtype;
                        if ($fieldtype=="string")
                        {
                        $$fieldname=strip_tags(stripslashes($thisrow[$fieldname]));
                        }
                        ELSE
                        {
                        $$fieldname=$thisrow[$fieldname];
                        }
			if($admin=="y") {echo $fieldname."=".$$fieldname."<BR>";}
                    }
		   
    }
    WHILE ($thisrow = @mysql_fetch_array($result));
  
session_register("VenueName","EventDate","EventTitle","EventStart","EventEnd","DoorsOpen","Prices","DescriptionOfEvent","AgeCodeID","onsaledate","status","MainEVID");
$selector=new library;
?>
<div class="searchhdr" id="MainEventUpdate">Main Event Update Form for <B><?PHP echo $VenueName;?>&  Event Number&nbsp;<?PHP echo $MainEVID; ?></b></div>
<div ><hr width="360" size="1 px" align="center"  background-color="#f5e3a1">
<form action="index.php?validvenue=<?PHP echo $VenueID;?>&MainEVID=<?PHP echo $MainEVID; ?>" method="GET" style=" color:black; background-color:#f5e3a1">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>"></div>
<div class="SingleListLeft">Change Event Date:</div><div class="SingleListRight">
<?PHP 
	  $BeginYear = 2010; 
	  $EndYear = 2015;
	  $prefix = "event";// prefix is added to Year,Month,Day for Name=
	  $selector->WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$prefix,$EventDate, $textcoloreventyear, $textcoloreventmonth,$textcoloreventday);
echo "</div><div class=\"SingleListLeft\">Currently:</div> <div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorEventDate.";\" value=\"".$EventDate."\" READONLY size=\"10\" name=\"EventDate\"></div>";
echo "<div class=\"SingleListLeft\">Event Title: </div><div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorEventTitle."\" name=\"EventTitle\" value=\"".$EventTitle."\" size=\"50\"></div>";
echo "<div class=\"SingleListLeft\">Sponsor Credit:</div><div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorsponsor.";\" name=\"sponsor\" value=\"".$sponsor."\" size=\"50\"></div>";
echo "<div class=\"SingleListLeft\">Event Start:</div><div class=\"SingleListRight\">"; 
$inhour="thiseventhour";
$inminute="thiseventminute";
$inampm="thiseventampm";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $textcolorEventStart);
?>
</div>
<div class="SingleListLeft">Event End: </div><div class="SingleListRight">
<?PHP 
$inhour="thisEventEndhour";
$inminute="thisEventEndminute";
$inampm="thisEventEndampm";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $textcolorEventEnd);
echo "</div><div class=\"SingleListLeft\">Doors Open:</div><div class=\"SingleListRight\">"; 
$inhour="DoorsOpenhour";
$inminute="DoorsOpenminute";
$inampm="DoorsOpenampm";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $textcolorDoorsOpen);
echo "</div><div class=\"SingleListLeft\">Prices:</div><div class=\"SingleListRight\"> <input type=\"text\" style=\"color:".$textcolorPrices."\" name=\"Prices\" value=\"".$Prices."\" size=\"20\"></div>"; ?>
<div class="SingleListLeft">On Sale Date: </div><div class="SingleListRight">
<?PHP 	  
	  $prefix = "onsale";
	  $startyear=date("Y");
	  $endyear=$startyear+5;
	$selector->WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$prefix,$onsaledate, $textcoloronsaleyear, $textcoloronsalemonth,$textcoloronsaleday);
	echo "&nbsp;&nbsp;Currently: <input type=\"text\" style=\"color:".$textcoloronsaledate.";\" value=\"".$onsaledate."\" READONLY size=\"10\" name=\"onsaledate\"></div>";
echo "<div class=\"SingleListLeft\">Description:</div><div class=\"SingleListRight\"> <textarea cols=\"20\" rows=\"3\" style=\"color:".$textcolorDescriptionOfEvent.";\" name=\"DescriptionOfEvent\">".$DescriptionOfEvent."</textarea></div>";
 echo "<div class=\"SingleListLeft\">Age Restrictions: </div><div class=\"SingleListRight\">";
	$library->agerestriction($AgeCodeID,$textcolorAgeLimits);
echo "</div><div class=\"SingleListLeft\">Display Status:&nbsp;</div><div class=\"SingleListRight\"> ";
$library->statusselectbox($status,$textcolorstatus);
echo "</div><div class=\"containerrow\" id=\"buttonstart\"><hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 echo "<input type=\"hidden\" name=\"_action\" value=\"Update Event\">";
	$value="Update Event";
	$name="_action";
	$type="submit";
	$OnClick="index.php";
	$windowlocation="window.location";
	$buttons-> forminputbutton($type,$name,$value,$onclick);
	echo $buttons->button;
	echo "</form></div>";
    echo "<DIV>";
//$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?MainEVID=".$MainEVID;
//$thiseventactlist="http://www.louisvillemusicnews.net/evententry/editactlist.php";

// include ($thispix4event);
	 ?></div><div><?PHP 
   include ("editactlist.php");
   ?> </div>
<?PHP
}
ELSEIF ($_action=="Update Event") // begin update loop
{//update loo

	$selector=new library;
?>
    
<DIV class="venuesite" id="MainEventUpdatable">Main Event Update Form for <B><?PHP echo $venuename;?> &  Event Number&nbsp;<?PHP echo $thiseventMainEVID; ?> on <?PHP echo $date;?> & <?PHP echo $thisdoor;?></b> </DIV>
    <div ><hr width="360" size="1 px" align="center"  background-color="#f5e3a1">
<form action="index.php?validvenue=<?PHP echo $VenueID;?>&MainEVID=<?PHP echo $MainEVID; ?>" method="GET" style=" color:black; background-color:#f5e3a1">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>"></div>
<div class="SingleListLeft">Change Event Date:</div><div class="SingleListRight">
<?PHP 
echo $EventDate;
	  $BeginYear = 2009; 
	  $EndYear = 2014;
	  $Prefix = "event";// prefix is added to Year,Month,Day for Name=
	  $thistextcolor=$textcolorEventDate;
	   $selector->WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$prefix,$EventDate, $textcoloreventyear, $textcoloreventmonth,$textcoloreventday);
echo "</div><div class=\"SingleListLeft\">Currently:</div> <div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorEventDate.";\" value=\"".$EventDate."\" READONLY size=\"10\" name=\"EventDate\"></div>";
echo "<div class=\"SingleListLeft\">Event Title: </div><div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorEventTitle."\" name=\"EventTitle\" value=\"".$EventTitle."\" size=\"50\"></div>";
echo "<div class=\"SingleListLeft\">Sponsor Credit:</div><div class=\"SingleListRight\"><input type=\"text\" style=\"color:".$textcolorSponor.";\" name=\"sponsor\" value=\"".$sponsor."\" size=\"50\"></div>";
echo "<div class=\"SingleListLeft\">Event Start:</div><div class=\"SingleListRight\">"; 
$inhour="thiseventhour";
$inminute="thiseventminute";
$inampm="thiseventampm";
$library->timeselectbox($EventStart,$inhour, $inminute,$inampm, $textcolorEventStart);
?>
</div>
<div class="SingleListLeft">Event End: </div><div class="SingleListRight">
<?PHP $inhour="thisEventEndhour";
$inminute="thisEventEndminute";
$inampm="thisEventEndampm";
$library->timeselectbox($EventEnd,$inhour, $inminute,$inampm, $textcolorEventEnd);
echo "</div><div class=\"SingleListLeft\">Doors Open:</div><div class=\"SingleListRight\">"; 
$inhour="DoorsOpenhour";
$inminute="DoorsOpenminute";
$inampm="DoorsOpenampm";
$library->timeselectbox($DoorsOpen,$inhour, $inminute,$inampm, $textcolorDoorsOpen);
echo "</div><div class=\"SingleListLeft\">Prices:</div><div class=\"SingleListRight\"> <input type=\"text\" style=\"color:".$textcolorPrices."\" name=\"Prices\" value=\"".$Prices."\" size=\"20\"></div>";
?>
<div class="SingleListLeft">On Sale Date: </div><div class="SingleListRight"><?PHP 	  
	  $prefix = "onsale";
	  $startyear=date("Y");
	  $endyear=$startyear+5;
	  $selector->WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$prefix,$onsaledate, $textcolorsaleyear, $textcolorsalemonth,$textcolorsaleday);
	  echo "&nbsp;&nbsp;Currently: <input type=\"text\" style=\"color:".$textcoloronsaledate.";\" value=\"".$onsaledate."\" READONLY size=\"10\" name=\"onsaledate\"></div>";
	 echo "<div class=\"SingleListLeft\">Description:</div><div class=\"SingleListRight\"> <textarea cols=\"20\" rows=\"3\" style=\"color:".$textcolorDescriptionOfEvent.";\" name=\"DescriptionOfEvent\">".$DescriptionOfEvent."</textarea></div>";
	 echo "<div class=\"SingleListLeft\">Age Restrictions: </div><div class=\"SingleListRight\">";
	$library->agerestriction($AgeCodeID,$textcolorAgeCodeID);
echo "</div><div class=\"SingleListLeft\">Display Status:&nbsp;</div><div class=\"SingleListRight\"> ";
$library->statusselectbox($status,$textcolorstatus);
echo "</div><div class=\"containerrow\" id=\"buttonstart\"><hr width=\"240\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 	$value="Update Event";
	$name="_action";
	$type="submit";
	$OnClick="index.php";
	$windowlocation="window.location";
	$buttons-> forminputbutton($type,$name,$value,$onclick);
	echo $buttons->button;
	
echo "</form></div>";


?>
<!--&nbsp;</td></tr>

    <tr><TD colspan="3"> -->
<?PHP
//$thispix4event="http://www.louisvillemusicnews.net/eventediting/pix4event4edit.php?thiseventMainEVID=".$thiseventMainEVID;

 //    $thiseventactlist="http://www.louisvillemusicnews.net/eventediting/editactlist.php?thiseventMainEVID=".$thiseventMainEVID;

//	 include ($thispix4event);
	 ?>
<!--	<tr><TD colspan="3"> -->
	<?PHP
  //   include ($thiseventactlist);

?>
<!--</td></tr></table> --> 
<?PHP 

}
}
?>



<?PHP
//editthiseventbuttons
echo "<div class=\"containerrow\"><hr width=\"300\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";  
?>
<FORM action="http://www.louisvillemusicnews.net/lmn/eventediting/index.php">
<input type="hidden" name="MainEVID" value="<?PHP echo $MainEVID;?>">

<?PHP

	$value="Update Event";
	$name="_action";
	$OnClick="index.php";
	$windowlocation="window.location";
//	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
//	echo $buttons->button;
	echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
	$value="Back One";
	$buttons->lmbackup($value);
	echo $buttons->button;
	echo "&nbsp;";
	$name="_action";
	$OnClick="index.php";
	$windowlocation="parent.location";
	$value="Members";
	$buttons->lmnbutton($value,$name, $OnClick,$windowlocation);
	echo $buttons->button;
	echo "&nbsp;";
	$value="Edit Another Event";
	$name="_action";
	
	$path=$library->basepath;
	$OnClick=$path."index.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	echo $buttons->button;
	
	?>
  </form>
</div>
<?PHP
//UPdatethisevent buttons
echo "<hr width=\"360\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
$value="Back One";
$buttons->lmbackup($value);
$value="Log Out";
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
echo "&nbsp";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp";
$value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/lmn/evententry/index.php?validvenue=".$VenueID."";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
?>
