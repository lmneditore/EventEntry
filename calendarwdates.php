<?PHP
session_start();
include ("../eventediting/functions.php");

 documentheaders($company, $stylesheet,$url,$meta);
// Variables
$thisinterval="42";
?>


<style type="text/css">
.dayofweekbar
{
	background:#0c4a7d;
	color: #f5e3a7;
	text-align: center;
	font-size:9 pt;
	font-weight: bold;
	font-family: arial;
	font-style: normal;
	width: 14%;
	}
.centertable 
{ 
	background: #f5e3a7;
	border-width: thick;
	border-color: black;
	width: 100%;
}
.daybox
{
	display: block;
	position: relative;
	background: #f5e3a7;
	vertical-align: top;
}
#DIV1
{
	display: block;
	position: relative;
	width: 65px;
}
#P1
{
	display: block;
	position: relative;
	width: 5px;
	left: 5px;
	top: 4px;
	vertical-align: top;
	font-size: 10pt;
	font-family: kabul ultra, arial;
	color: #0c4a7d;
	font-weight: bold;
}
#DIV2
{
	display: block;
	position: relative;
	width: 580px;
}
#SPAN3
{
	display: block;
	position: relative;
	left: 18px;
	top: -15px;
	vertical-align: top;
}
#EM3
{
	display: block;
	position: absolute;
	vertical-align: top;
	left: 18px;
	top: 0px;
	color: #0c4a7d;
	font-weight: 800;
	font-size: 10 pt;
	text-align: left;
	font-family: kabul ultra, arial;
	}
.actlist
{
	margin-top: 5px; 
	margin-right: 5px; 
	margin-left: 5px; 
	font-size: 8.5 pt;
	font-weight: 400;
	font-family: kabulultra, arial;
}
.more
{
	display: block; 
	position: relative;
	top: 5px; 
	right: 5px; 
	bottom: 5px; 
	left: 10px; 
	font-size: 9 pt;
	font-style: italic;
	font-weight: 300;
	font-family: arial;
	}
.headliner
{
	margin-top: 5px; 
	margin-right: 5px; 
	margin-bottom: 5px; 
	margin-left: 5px; 
	font-size: 10 pt;
	font-weight: 600;
	font-family: kabulultra, arial;
}
.searchhdr
{
	background:#0c4a7d;
	color: #f5e3a7;
	text-align: center;
	font-size: 12 pt;
	font-weight: bold;
	font-family: arial;
	font-style : italic;
	}
	.eventtitle
{
	font-size: 9 pt;
	color: #0c4a7d;
	font-weight: ultrabold;
	text-transform: capitalize;
	margin: 5px 0px 0px 5px;
}
	.eventprice	
{
	display: block; 
	position: relative;
	font-size: 8 pt;
	color: #0c4a7d;
	font-weight: bold;
	margin: 5px 0px 0px 5px;
	text-align: left;
	vertical-align: bottom;
}
</style>
<?
function datebox($daynum, $month, $path)
{

if (!$path)
{
$month=strtoupper($month);
	if(strlen($month)==0)
	{
	echo "<TD valign=\"top\"><DIV ID=\"DIV1\"><P ID=\"P1\">&nbsp;$daynum&nbsp;</p></DIV>";
	}
	ELSE
	{
	echo "<TD valign=\"top\"><DIV ID=\"DIV1\"><P ID=\"P1\">&nbsp;$daynum&nbsp;<EM ID=\"EM3\">$month </EM></P></DIV>";
	}
}
ELSE
{
	if(strlen($month)==0)
	{
	echo "<TD valign=\"top\"><DIV ID=\"DIV1\"><P ID=\"P1\">&nbsp;$daynum&nbsp;<SPAN ID=\"SPAN3\"><img src=\"$path\" width=\"50px\"></SPAN></P></DIV>";
	}
	ELSE
	{
	echo "<TD valign=\"top\"><DIV ID=\"DIV1\"><P ID=\"P1\">$daynum&nbsp;</p><EM ID=<\"EM3\">$month</EM><SPAN ID=\"SPAN3\"><img src=\"$path\"></SPAN></P></DIV>";
	}
}


}
function eventdata($eventtitle, $prices,$actlist, $sponsor, $seriestitle, $ages)
{
	if (!$seriestitle)
	{
	}
	ELSE
	{
	echo "<DIV class=\"eventtitle\">$seriestitle</div>";
	}

	if (!$sponsor)
	{
	}
	ELSE
	{
	echo "<DIV class=\"eventtitle\">$sponsor</div>";
	}
	if (!$eventtitle)
		{
		}
		ELSE
		{
		echo "<DIV class=\"eventtitle\">$eventtitle</div>";
		}
		include ($actlist);
		if (!$prices)
		{
			if (!$ages)
			{
			}
			ELSE
			{
			echo "<DIV class=\"eventprice\">$ages</div>";
			}
		}
		ELSE 
		{
			if (!$ages)
			{
			echo "<DIV class=\"eventprice\">$prices</div>";
			}
			ELSE
			{
			echo "<DIV class=\"eventprice\">Adm: $prices&nbsp;&nbsp;<BR>Ages: $ages</div>";
			}
		}
}

?>


</head>

<?
//displayLMHeader();
if(!$thisdate)
{
$thisdate=date("Y-m-d");
}
// submit a date
$somedate=strtotime($thisdate);//create a TIMESTAMP
$datearray=getdate($somedate);//Call a date array from the TIMESTAMP
$month = $datearray['mon']; // GET MONTH
$wday = $datearray['wday']; // GET DAY OF WEEK
$year = $datearray['year']; // GET YEAR
$mday=$datearray['mday'];//GET DAY OF MONTH
$backup=$mday-$wday;
IF ($wday==0)
{
$startday=$thisdate;
}
ELSEIF ($backup<0)
{
	if ($month==1)
	{
	$startmonth=12;
	$startyear=$year-1;
	$ld=mktime(0,0,0,$month,0,$startyear); 
	$lastday=strftime("%d",$ld);
	$startday=$lastday+$mday-$wday;
	}
	ELSE
	{
	$startmonth=$month-1;
	$startyear=$year;
	$ld=mktime(0,0,0,$month,0,$startyear); 
	$lastday=strftime("%d",$ld);
	$startday=$lastday+$backup;
	}
}
ELSE
{
	
	$startmonth=$month;
	$startyear=$year;
	$startday=$backup;
	$endday=$startday+28;

}
$startat=$startyear."-".$startmonth."-".$startday;
include("/inks/LMHeader.inc");

// select everything that's needed from Series, Pix4Event, etc
$sql4="Create TEMPORARY TABLE VenueEvents Select MainEvents.MainEVID, MainEvents.EventDate, MainEvents.Prices, MainEvents.EventStart, Series.SeriesTitle, MainEvents.EventTitle, Pix4Event.PathToThumbs, MainEvents.sponsor, AgeRestriction FROM MainEvents
LEFT JOIN Series ON
MainEvents.SeriesID=Series.SeriesID
LEFT JOIN Pix4Event ON
MainEvents.MainEVID=Pix4Event.MainEVID
LEFT JOIN AgeRestrictions ON
MainEvents.AgeLimits=AgeRestrictions.AgeCodeID
WHERE MainEvents.VenueID='$thisvenueid' 
GROUP BY MainEvents.MainEVID";
$result1=@mysql_query($sql4,$connection4) OR DIE ("Unable to creat VenueEvents Temporary table.");
$tempfetch=@mysql_fetch_array($result1);



$sqlv="SELECT * FROM Venues 
WHERE Venues.VenueID=$thisvenueid";
$venname=@mysql_query($sqlv,$connection4) OR DIE ("Unable to get the Venues table to open");
$venueinfo=@mysql_fetch_array($venname);
$VenueName=$venueinfo["VenueName"];
$calsql="SELECT DAYOFMONTH(dates) as DOM, MONTHNAME(dates) AS MON, YEAR(dates) AS YEAR, dates, Prices, EventStart, EventTitle, MainEVID, sponsor, SeriesTitle, PathToThumbs, AgeRestriction FROM Dates
LEFT JOIN VenueEvents
ON Dates.dates=VenueEvents.EventDate
WHERE (dates>='$startat' AND dates<(DATE_ADD('$startat',INTERVAL '$thisinterval' Day)))"; 
$result=@mysql_query($calsql,$connection4) OR DIE ("Couldn't find the time");
$thesedates=@mysql_fetch_array($result);
?>
<TABLE class="centertable" border="1" width=\"580\" align="LEFT" valign="TOP">
<TH class="searchhdr" colspan="7">Music Events For <?PHP echo $VenueName;?> for <?php echo $thesedates["MON"];?>, <?php echo $year;?></th>
<TR><TD class="dayofweekbar">Sunday</td><TD class="dayofweekbar">Monday</td><TD class="dayofweekbar">Tuesday</td><TD class="dayofweekbar">Wednesday</td><TD class="dayofweekbar">Thursday</td><TD class="dayofweekbar">Friday</td><TD class="dayofweekbar">Saturday</td></tr><TR>
<?
$i=0;
DO
{
$mod=($i % 7);

if ($MON==$thesedates["MON"])
{
	if ($mod==0)
	{
	$daynum=$thesedates["DOM"];
	$eventtitle=$thesedates["EventTitle"];
	$prices=$thesedates["Prices"];
	$seriestitle=$thesedates["SeriesTitle"];
	$month="";
	$eventid=$thesedates["MainEVID"];
	$ages=$thesedates["AgeRestriction"];
	$path=$thesedates["PathToThumbs"];
	$ages=$thesedates["AgeRestriction"];
	$actlist="http://www.louisvillemusicnews.net/test/venueschedulebox.php?thismaineventevid=".$thesedates["MainEVID"];
		echo "<TR>";
		datebox ($daynum, $month, $path);
		if ($eventid)
		{
		eventdata($eventtitle, $prices,$actlist, $sponsor, $seriestitle,$ages);
		}
		ELSE
		{
		Echo "<BR><BR><BR><BR>";
		}
	$i=($i+1);
	$MON=$thesedates["MON"];
	}
	ELSE 
	{
	$month="";
	$daynum=$thesedates["DOM"];
	$eventtitle=$thesedates["EventTitle"];
	$prices=$thesedates["Prices"];
	$seriestitle=$thesedates["SeriesTitle"];
	$eventid=$thesedates["MainEVID"];
	$ages=$thesedates["AgeRestriction"];
	$actlist="http://www.louisvillemusicnews.net/test/venueschedulebox.php?thismaineventevid=".$thesedates["MainEVID"];
	$path=$thesedates["PathToThumbs"];
	$ages=$thesedates["AgeRestriction"];
			datebox ($daynum, $month, $path);
			eventdata($eventtitle, $prices,$actlist, $sponsor, $seriestitle, $ages);
	$i=($i+1);
	$MON=$thesedates["MON"];
	}
}
ELSE
{
if ($mod==0)
	{
	$daynum=$thesedates["DOM"];
	$month=$thesedates["MON"];
	$eventtitle=$thesedates["EventTitle"];
	$prices=$thesedates["Prices"];
	$ages=$thesedates["AgeRestriction"];
	$actlist="http://www.louisvillemusicnews.net/test/venueschedulebox.php?thismaineventevid=".$thesedates["MainEVID"];
	$path=$thesedates["PathToThumbs"];
	$ages=$thesedates["AgeRestriction"];
//break columns here start a new row
		echo "<TR>";
		datebox ($daynum, $month, $path);
		eventdata($eventtitle, $prices,$actlist, $sponsor, $seriestitle, $ages);
	$i=($i+1);
	$MON=$thesedates["MON"];
	}
	ELSE 
	{
	$daynum=$thesedates["DOM"];
	$month=$thesedates["MON"];
	$eventtitle=$thesedates["EventTitle"];
	$prices=$thesedates["Prices"];
	$ages=$thesedates["AgeRestriction"];
	$actlist="http://www.louisvillemusicnews.net/test/venueschedulebox.php?thismaineventevid=".$thesedates["MainEVID"];
	$path=$thesedates["PathToThumbs"];
	$ages=$thesedates["AgeRestriction"];
		datebox ($daynum, $month, $path);
		eventdata($eventtitle, $prices,$actlist, $sponsor, $seriestitle, $ages);
	$i=($i+1);
	$MON=$thesedates["MON"];
	}
}

}
WHILE ($thesedates=@mysql_fetch_array($result));
echo "</tr><TR><TD colspan=\"7\" align=\"center\">";
echo "<hr width=\"500\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
 $value="Back One";
lmbackup($value);
echo "&nbsp";
$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
$windowlocation="parent.location";
$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "&nbsp";
$value="Edit Another Event";
	  $name="Edit";
	  $OnClick="http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php";
	  $windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation );
?>
</table>


