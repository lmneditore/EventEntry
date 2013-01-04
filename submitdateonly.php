<?PHP 
session_start();
require ("/inks/functions.php");
/*if ($thisactid)
{session_register($thisactid);
}
IF ($thisactname)
{session_register("thisactname");}
If ($thisvenuename)
{session_register("thisvenuename");}
if ($thisvenueid)
{session_register("thisvenueid");}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">



<script language="Javascript">
<!--
function lookupact()
{window.open('Search4Acts.html','Search4Acts', 'fullscreen=no,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,directories=no,location=no,width=230,height=350,left=400,top=100')}
//-->
</script>
	<title>Submit Dates to Louisville Music News Only</title>
</head>

<form action="<?PHP echo $PHP_SELF;?>" method="Post">
<input type="hidden" name="thisactid" value="<?php echo $thisactid; ?>">
<input type="hidden" name="thisvenueid" value="<?php echo $thisvenueid; ?>">
<Table class="inserttable">
<TR><TD align="right">Act Name: </td><TD align="left"><input type="text" name="thisactname1" value="<?PHP echo $thisactname;?>"></td><TD align="left"><input type="Button" value="Look Up Act" onClick="lookupact()"></td></tr>
<TR><TD align="right">Club or Venue Name: </td><TD align="left"><input type="text" name="thisvenuename1" value="<?PHP echo $thisvenuename;?>"></td><TD align="left"><button OnClick="window.location='http://www.louisvillemusicnews.net/eventediting/Search4Venues.html'" style="background-color: "gray"><font color="blue">Look Up Venue Name</button></td></tr>
<TR><TD align="right">Date of Event: </td><TD align="left">
<?PHP 
	  $BeginYear = 2003; 
      $EndYear = 2008;
	  $prefix = "event";
	  
	WriteDateSelect($BeginYear,$EndYear,'',$prefix,$thisdate, $textcolordate);?>
</td></tr>
<tr><td align="right">Event Start:</td><td align="left">
<?
$inhour="thiseventhour1";
$inminute="thiseventminute1";
$inampm="thiseventampm1";
timeselectbox($thistime,$inhour, $inminute,$inampm, $eventtimecolor);?></td></tr>
   <tr><td align="right">Admission:</td><td align="left"> <input type="text" style="color:<?php echo $textcolorprice;?>;" name="thisprice" value="<?php echo $thisprice;?>" size="20"></td></tr>
    <tr><td align=\"left\">Age Restrictions: </td><td align=\"left\">
        <?PHP         include ("http://www.louisvillemusicnews.net/eventediting/agerestrictionlookup.php");?>
</table>
</form>




