<?PHP
session_start();
//require("lmvars.inc");

class library {
function libvals()
{
	$this->basepath="http://www.louisvillemusicnews.net/lmn/evententry/";
}

function verifycalendaruser($user_id)
{
	$path=$_SESSION["path"];
	if(class_exists("lm_netconnection"))
	{
	}
	ELSE { 
	include("louisvillemusic_netcnxn.php");
	}
	$cnxn=new lm_netconnection;
	$cnxn->lm_connection("louisvil_louisvillemusic2");
	$valid=session_is_registered("valid_user");
    if ($valid == "True")
    {
	$buttons=new buttons;
	Global $validvenue, $validact;
             $sqlck="SELECT ActID,VenueID,BoardID from lmuserapproval WHERE lmuserid='".$user_id."'";
             $check=@mysql_query($sqlck) or die("couldn't execute find venue/act query ");
            $thisrow=@mysql_fetch_array($check);
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
                    }
			if ($thisrow["VenueID"]==99)
			{
				$value="List Blurbs";
				$formname="venueform";
			$name="_action";
			$onclick="index.php";
			$windowlocation="window.location";
			$buttons->wactionbutton($value, $name,$formname,$onclick);	
			$display .= $buttons->button;
			$value="Select A Venue";
			$formname="venueform";
			$name="_action";
			$onclick="index.php";
			$windowlocation="window.location";
			$buttons->wactionbutton($value, $name,$formname,$onclick);	
			$display .= $buttons->button;
			$value="Select An Act";
			$formname="actform";
			$name="_action";
			$onclick="index.php";
			$windowlocation="window.location";
			$buttons->wactionbutton($value, $name,$formname,$onclick);
			$display .= $buttons->button;
			}
			ELSE
			{
				$validvenue=$thisrow["VenueID"];
				if ($validvenue==TRUE)
				{
				session_register("validvenue");
				//include("louisvillemusic_netcnxn.php");
				$venuesql="SELECT VenueName FROM Venues WHERE VenueID=".$validvenue."";
				$thisresult=@mysql_query($venuesql) OR DIE ("Couldn't complete the $venuesql query");
				$thisvenue=@mysql_fetch_array($thisresult);
				$venuename=$thisvenue["VenueName"];
				$value=$venuename;
				$name="_action";
				$onclick="index.php";
				$windowlocation="window.location";
				$buttons->wactionbutton($value, $name,$formname,$onclick);
				$display .= $buttons->button;
				}
				$validact=$thisrow["ActID"];
				if ($validact==TRUE)
				{
				session_register("validact");
				}
				IF ($validact==TRUE)
				{
				$value="Select A Venue";
				$formname="venueform";
				$name="_action";
				$onclick="index.php";
				$windowlocation="window.location";
				$buttons->wactionbutton($value, $name,$formname,$onclick);
				$buttons->lmnbutton($value, $name,$onclick,$windowlocation);
				$display .= $buttons->button;
				$display .= "<BR><BR>";      
				}
			}
			$this->display=$display;
	}
	ELSE
	{
    $this->displayloginheader("Event Management Login");
     $display .= "<Table width=\"360\" align=\"center\"><tr><td class=\"loginhdr\">You are not authorized to be here. Please return to the Main Page or log in.</td></tr>";
   $display .= "<tr><td align=\"center\"><BR><button  onclick=\"window.location='\"http://http://www.louisvillemusicnews.net/lmn/members/lmlogin.php'\" style=\"background-color:grey;\">Log In</button><BR></td></tr>";
    $display .= "<tr><td align=\"center\"><BR><button onclick=\"window.location='http://www.louisvillemusicnews.net/lmn/lmhdr.php'\" style=\"background-color:grey;\">Main<font color=\"blue\"></button></td></tr></table>";
    $this->display=$display;
     }//Else of Not valid user
}
function displayloginheader($loginheader)
	{
		$display .= "<div style=\"background-color:#ffffff; width:580px; border:solid thin #ffffff; padding:4px; margin: auto;\">\n";
		$display .= "<div class=\"IssueHdr\">".$loginheader."</div>\n";
		echo $display;
	}
	

function displayLMHeader()
	{
		$display .= "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n";
		$display .= "<body><head>\n";
		$display .= "<meta name=\"ROBOTS\" content=\"ALL\">\n";
		$display .= "<meta name=\"distribution\" content=\"global\">\n";
		$display .= "<META name=\"Keywords\" content=\"Louisville,Kentucky,Southern Indiana,live,music,musicians,reviews,features,events,songwriters\">\n";
		$display .= "<meta HTTP-EQUIV=\"resource-type\" content=\"document\">\n";
		$display .= "<meta name=\"Classification\" content=\"Music and Entertainment News\">\n";
		$display .= "<meta HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">";
		$display .= "<LINK REL=\"stylesheet\" HREF=\"LMNStyles.css\" type=\"text/css\" />\n";
		$display .= "<title>Louisville Music News.net Main Menu</title>\n";
	//	$display .= "<link rel=\"stylesheet\" href=\"classes/currentcss.css\" type=\"text/css\">\n";
		$display .="<LINK REL stylesheet=\"http://www.louisvillemusicnews.net/lmn/stylesheets/venueedit.css\" type=\"text/css\">";
		$display .="<script language=\"JavaScript\" type=\"text/javascript\" src=\"wyzz.js\"></script>";
		$display .="<script type=\"text/javascript\">\n";
		$display .="function validate_required(field,alerttxt)\n";
		$display .="{ with (field)\n";
		$display .="{\n";
		$display .="if (value==null||value==\"\")\n";
		$display .="{\n";
		$display .="alert(alerttxt);\n";
		$display .="return false;\n";
		$display .="}\n";
		$display .="else\n";
		$display .="{\n";
		$display .="return true;\n";
		$display .="   }\n";
		$display .="  }\n";
		$display .="}\n";
		$display .="</script>\n";
		$display .= "</head>";
		$display .= "<body bgcolor=\"#330000\">\n";
		$display .= "<DIV class=\"header\">";
		$display .= "<img src=\"http://www.louisvillemusicnews.net/images/lmnwebflagwlogo2008.gif\" width=\"680px\">"; 
		$display .= "<DIV class=\"eventdate\">\n";
		$display .= date("l, F j, Y");
		$display .= "</DIV></div>";  
		echo $this->display=$display;
      	}

function displaynoauthorization()
{
$display .= "<DIV style=\"text-align=\"center\">You are not authorized to access this page. <BR>Please contact the site adminstrator for assistance.</DIV>";
$display .= "<DIV style=\"text-align=\"center\"><button onclick=\"parent.location='http://http://www.louisvillemusicnews.net'\" style=\"background-color: \"grey\"><font color=\"blue\">Click Here</button></Div>";
	echo $display;
}
function statusselectbox($status, $textcolorstatus)
{
	
if ($status=="DI")
{$status="OK";
}
ELSE {}
$display .="<select name=\"status\" style=\"color:".$textcolorstatus.";\">";
  $statuses = array("OK" => "Display","PE" => "Pending","PR" => "Proprietary","DE" => "Delete","H1"=>"Hold-1","H2"=>"Hold-2","H3"=>"Hold-3","H4"=>"Hold-4");
  while (list ($key, $value) = each ($statuses))
    {
	    $selected=(($key==$status) ? "SELECTED" : "");
	$display .="<option value=\"".$key."\" ".$selected.">".$value."</option>";
    }
$display .="</select>";
echo $display;
}

function timeselectbox($intime,$inhour,$inminute,$inampm,$textcolortime)
{
global $thishour, $thisminute, $thisampm, $thistime;
$textcolortime=(!isset($textcolortime) ? "black" : $textcolortime);
$intime=strtoupper(trim($intime)); // convert to all uppercase and trim whitespaces
$intime=ereg_replace("P"," P",$intime); //Add white space to front of A or P
$intime=ereg_replace("A"," A",$intime);
$intime=ereg_replace("  "," ",$intime);//strip white spaces
IF (substr($intime,0,4)=="NOON")// check for Noon and Mid
{
$intime="12:00 PM";
}
ELSEIF (substr($intime,0,3)=="MID")
{ 
$intime="12:00 AM";
}
if (substr($intime,-2)=="P.")
{$intime=ereg_replace("P.","PM",$intime);
}
ELSEIF (substr($intime,-2)=="A.")
{$intime=ereg_replace("A.","AM",$intime);
}
ELSEIF(substr($intime,-1)=="P")
{ $intime=ereg_replace("P","PM",$intime); // change P to PM
}
ELSEIF (substr($intime,-1)=="A")
{$intime=ereg_replace("A","AM",$intime); //Change A to AM
}
ELSEIF (substr($intime,-4)=="P.M.")
{
$intime=ereg_replace("P.M.","PM",$intime); // change P to PM
}
ELSEIF (substr($intime,-4)=="A.M.")
{
$intime=ereg_replace("A.M.","AM",$intime); // change P to PM
}
$thisampm=substr(trim($intime),-2,2);
$strend=strlen($intime);
$strend=($strend-2);
$hoursandm=substr($intime,0,$strend);
$hoursandm=trim($hoursandm);
$pos = strrpos($hoursandm, ":");
if($pos === false) 
{
$timelen=strlen($hoursandm);
   if ($timelen==1)
   {$thishour="0".$hoursandm;
   $thisminute="00";
   
   }
   Else
   {
   $thishour=$hoursandm;
      $thisminute="00";
   }
}
ELSE
{
$thishour=substr($hoursandm,0,$pos);
$thisminute=substr($hoursandm,$pos+1,2);
}
$thistime=$thishour.":".$thisminute." ".$thisampm;

$hours = array ("00" => "0","01" => "1","02" => "2","03"  => "3","04"  => "4","05"  => "5","06"  => "6","07"  => "7","08"  => "8","09"  => "9", "10"  => "10", "11"  => "11", "12"  => "12");
Echo "<select name=\"".$inhour."1\" size=\"1\">";
  while (list ($key, $value) = each ($hours))
  {
	if ($key==$thishour)
	{
		echo "<option style=\"color:".$textcolortime."\" value=\"".$key."\" SELECTED>".$value."</option>";
	}
	ELSE
	{
		echo "<option style=\"color:".$textcolortime."\"  value=\"".$key."\">".$value."</option>";
     }
	}
	echo "</select>";

$minutes= array("00" => "00","05" => "05","10" => "10","15" => "15","20" => "20","25" => "25","30" => "30","35" => "35","40" => "40","45" => "45","50" => "50","55" => "55");

echo "<select name=\"".$inminute."1\" size=\"1\">";
 while (list ($key, $value) = each ($minutes))
  {
	if ($key==$thisminute)
	{
		echo "<option style=\"color:".$textcolortime."\"  value=\"".$key."\" SELECTED>".$value."</option>";
	}
	ELSE
	{
		echo "<option style=\"color:".$textcolortime."\"  value=\"".$key."\">".$value."</option>";
     }
	}
echo "</select>";


If ($thisampm=="AM")
{
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."1\" value=\"PM\"> PM </FONT>";
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."1\" value=\"AM\" checked> AM </FONT>";
}
ELSE
{
echo "<font color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."1\" value=\"PM\" checked> PM</FONT>";
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."1\" value=\"AM\" > AM </FONT>";
}

}
function agerestriction($AgeCodeID,$textcolorAgeCodeID) 
	{
$cnxn=new lm_netconnection;
$cnxn->lm_connection("louisvil_louisvillemusiccom");
$sql ="SELECT AgeRestrictions.AgeRestriction, AgeRestrictions.AgeCodeID FROM AgeRestrictions WHERE 1";
$result = @mysql_query($sql) or die("couldn't execute age restriction query.");
$thisrow = @mysql_fetch_array($result);
	$display .= "<select name=\"AgeCodeID1\" style=\"color:".$textcolorAgeCodeID.";\">";
	    DO
	    {
	    $selected=(($thisrow["AgeCodeID"]==$AgeCodeID) ? "SELECTED" : "");
	    $display .= "<OPTION  value=\"".$thisrow["AgeCodeID"]."\" ".$selected.">".$thisrow["AgeRestriction"]."</OPTION>";
	    }
	    While ($thisrow = @mysql_fetch_array($result));
	$display .= "</select>";
	echo $display;
	} 

//class dateselect {
function WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$prefix,$thisdate, $textcoloryear, $textcolormonth,$textcolorday)
{
	//echo $thisdate;
  $BeginYear =(!isset($BeginYear) ? date('Y') : $BeginYear);
  $EndYear=(!isset($EndYear) ? $BeginYear+5 : $EndYear);
  $pyearname=$prefix."year";
  $pyear=$prefix."year";
  $pmonthname=$prefix."month";
  $pmonth=$prefix."month";
   $pday=$prefix."day";
  $pdayname=$prefix."day";
  $pyear=substr($thisdate,0,4);
  $pmonth=(substr($thisdate,5,2)==0 ? substr($thisdate,7,1) : substr($thisdate,5,2));
  $pday=(substr($thisdate,8,1)==0 ? substr($thisdate,9,1) : substr($thisdate,8,2)); 
  $months=array("January","February","March", "April","May","June","July","August","September","October","November","December");
  $datedisplay .="<select  name=\"".$pyearname."1\" style=\"color:".$textcoloryear.";\">";
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
	  $selected=(($i==$pyear) ? "SELECTED" : "");
	  $datedisplay .="<option name=\"".$pyearname."\"  ".$selected." >".$i."</option>";
  }
  $datedisplay .= "</select><select name=\"". $pmonthname."1\" style=\"color:".$textcolormonth.";\">";
  foreach($months as $key=>$value)
  {
	  $key++;
	    $selected=(($key==$pmonth) ? "SELECTED" : "");
  $datedisplay .= "<option value=\"".$key."\"  ".$selected." >".$value."</option>";
  }
  $datedisplay .= "</select><select name=\"".$pdayname."1\" style=\"color:".$textcolorday.";\">";
  for ($i = 1; $i <= 31; $i++)
  {
	    $selected=(($i==$pday) ? "SELECTED" : "");
    $datedisplay .= "<option ".$selected." value=\"".$i."\">".$i."</option>";
  }
 $datedisplay .="</select>";
 $this->date=$datedisplay;
}
function optionfield_outtable($dbname, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname)
{
	$cnxn=new lm_netconnection;
	$cnxn->lm_connection($dbname);
//	global $keyfieldname;
//	global $$keyfieldname;

		if (!isset($selvalue))
		{ 
		$sqlouttable="SELECT * FROM $outtable WHERE 1 ORDER BY $keyfieldname";
		$outtableresult=@mysql_query($sqlouttable) OR DIE ("Can't open the $outtable table");
		}
		ELSE
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1  ORDER BY $keyfieldname";
		$outtableresult=@mysql_query($sqlouttable) OR DIE ("Can't open the $outtable."); 
		} 
		$outtablelist=@mysql_fetch_array($outtableresult);
		
		DO
		{$thisfieldname=$outtablelist[$keyfieldname];
			if ($outtablelist[$fieldname]=="")
			{
			$this->option .="<OPTION value=\"".$emptyvalue."\">".$outtablelist[$fieldname]."\n";
			}
			ELSEIF ($outtablelist[$keyfieldname]==$selvalue)
			{
			$this->option .="<OPTION value=\"".$outtablelist[$keyfieldname]."\" SELECTED>".$outtablelist[$fieldname]."\n";
			}
			ELSE 
			{
			$this->option .="<OPTION value=\"".$outtablelist[$keyfieldname]."\">".$outtablelist[$fieldname]."\n";
			}
		}
		WHILE ($outtablelist=@mysql_fetch_array($outtableresult));
		mysql_close();
	//	$this->option .="</SELECT>";
	
}
}
//end of class
?>
