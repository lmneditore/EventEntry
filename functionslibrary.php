<?PHP
session_start();
//require("lmvars.inc");
class library {
	
function verifycalendaruser($user_id)
{
	include("louisvillemusic_netcnxn.php");
	$cnxn=new lm_netconnection;
	$cnxn->lm_connection("louisvil_louisvillemusic2");
	$valid=session_is_registered("valid_user");
    if ($valid == "True")
    {
	$buttons=new buttons;
	Global $validvenue, $validact;
             $sqlck="SELECT ActID,VenueID,BoardID from lmuserapproval WHERE lmuserid='".$user_id."'";
             $check=@mysql_query($sqlck) or die("couldn't execute find venue/act query ");
            $checkapprov=@mysql_fetch_array($check);

			if ($checkapprov["VenueID"]==99)
			{
			$value="Select A Venue";
			$name="";
			$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/searchvenues.php";
			$windowlocation="window.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			$display .= $buttons->button;
			?>
			<BR><BR><?PHP
			$value="Select An Act";
			$name="";
			$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/searchact.php?submit=Find_Act";
			$windowlocation="window.location";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			$display .= $buttons->button;
			}
			ELSE
			{
				$validvenue=$checkapprov["VenueID"];
				if ($validvenue)
				{
				session_register("validvenue");
				include("louisvillemusic_netcnxn.php");
				$venuesql="SELECT VenueName FROM Venues WHERE VenueID=".$validvenue."";
				$thisresult=@mysql_query($venuesql) OR DIE ("Couldn't complete the $venuesql query");
				$thisvenue=@mysql_fetch_array($thisresult);
				$venuename=$thisvenue["VenueName"];
				$value=$venuename;
				$name="";
				$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/editthisvenueevents.php?validvenue=$validvenue";
				$windowlocation="window.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
				$display .= $buttons->button;
				}
				$validact=$checkapprov["ActID"];
				if ($validact)
				{
				session_register("validact");
				}
				IF ($validact)
				{
				$value="Select A Venue";
				$name="";
				$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/editthisvenueevents.php?validvenue=$validvenue";
				$windowlocation="window.location";
				$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
				$display .= $buttons->button;
				$display .= "<BR><BR>";      
				}
			}
	}
	ELSE
	{
    $this->displayloginheader("Event Management Login");
    
    ?>
    <Table width="360" align="center"><tr><td class="loginhdr">You are not authorized to be here. Please return to the Main Page or log in.</td></tr>
    <tr><td align="center"><BR><button  OnClick="window.location='http://www.louisvillemusicnews.net/lmn/members/lmlogin.php'" style="background-color:grey;">Log In</button><BR></td></tr>
    <tr><td align="center"><BR><button OnClick="window.location='http://www.louisvillemusicnews.net/lmn/lmhdr.php'" style="background-color:grey;">Main<font color="blue"></button></td></tr></table>
     <?PHP 
     }//Else of Not valid user
}
function displayloginheader($loginheader)
	{
		$display .= "<div style=\"background-color:#f5e3a1; width:580px; border:solid thin #f5e3a1; padding:4px; margin: auto;\">\n";
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
		$display .= "<link rel=\"stylesheet\" href=\"http://www.louisvillemusicnews.net/classes/currentcss.css\" type=\"text/css\">\n";
		
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
		$display .= "<img src=\"http://www.louisvillemusicnews.net/webmanager/images/lmnwebbanner680.gif\" width=\"680px\">"; 
		$display .= "<DIV class=\"eventdate\"\">\n";
		$display .= date("l, F j, Y");
		$display .= "</DIV>";  
		echo $display;
      	}

function displaynoauthorization()
{
$display .= "<DIV style=\"text-align=\"center\">You are not authorized to access this page. <BR>Please contact the site adminstrator for assistance.</DIV>";
$display .= "<DIV style=\"text-align=\"center\"><button OnClick=\"parent.location='http://www.louisvillemusicnews.net'\" style=\"background-color: \"grey\"><font color=\"blue\">Click Here</button></Div>";
	echo $display;
}
function statusselectbox($thisstatus, $textcolorstatus)
{
if ($thisstatus=="DI")
{$thisstatus="OK";
}
ELSE {}
$display .="<select name=\"thisstatus1\" size=\"3\">";
  $statuses = array("OK" => "Display","PE" => "Pending","PR" => "Proprietary","DE" => "Delete","H1"=>"Hold-1","H2"=>"Hold-2","H3"=>"Hold-3","H4"=>"Hold-4");
  while (list ($key, $value) = each ($statuses))
    {
	if ($key==$thisstatus)
	{
	$display .="<option style=\"color:".$textcolorstatus."\" value=\"".$key."\" SELECTED>".$value."</option>";
	}
	ELSE
	{
	$display .="<option style=\"color:".$textcolorstatus."\"  value=\"".$key."\">".$value."</option>";
    }
	}
$display .="</select>";
echo $display;
}
function WriteDateSelect($BeginYear, $EndYear,$IsPosted = true,$Prefix = '',$thisdate, $thistextcolor)
{
  $BeginYear =(!isset($BeginYear) ? date('Y') : $BeginYear);
  $EndYear=(!isset($EndYear) ? $BeginYear+5 : $EndYear);
  $display .="<select style=\"color:".$thistextcolor."\" name=\"".$Prefix. "Year\" >";
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    $display .="<option>".$i."</option>";
  }
  $display .= "</select>-<select style=\"color:".$thistextcolor."\" name=\"". $Prefix."Month\">";
  for ($i = 1; $i < 13; $i++)
  {
    $display .= "<option>".$i."</option>";
  }
  $display .= "</select>-<select style=\"color:".$thistextcolor."\" name=\"".$Prefix."Day\">";
  for ($i = 0; $i <= 31; $i++)
  {
    $display .= "<option>".$i."</option>";
  }
 $display .="</select>";
 echo $display;
}
function timeselectbox($intime,$inhour,$inminute,$inampm,$textcolortime)
{
global $thishour, $thisminute, $thisampm, $thistime;
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
Echo "<select name=\"".$inhour."\" size=\"1\">";
  while (list ($key, $value) = each ($hours))
  {
	if ($key==$thishour)
	{?>
<option style="color:<?echo $textcolortime;?>" value="<? echo $key;?>" SELECTED><?echo $value;?></option><?
	}
	ELSE
	{
	?>
<option style="color:<?echo $textcolortime;?>"  value="<? echo $key;?>"><?echo $value;?></option><?
     }
	}
echo "</select>";

$minutes= array("00" => "00","05" => "05","10" => "10","15" => "15","20" => "20","25" => "25","30" => "30","35" => "35","40" => "40","45" => "45","50" => "50","55" => "55");

echo "<select name=\"".$inminute."\" size=\"1\">";
 while (list ($key, $value) = each ($minutes))
  {
	if ($key==$thisminute)
	{?>
<option style="color:<?echo $textcolortime;?>"  value="<? echo $key;?>" SELECTED><?echo $value;?></option><?
	}
	ELSE
	{
	?>
<option style="color:<?echo $textcolortime;?>"  value="<? echo $key;?>"><?echo $value;?></option><?
     }
	}
echo "</select>";


If ($thisampm=="AM")
{
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."\" value=\"PM\"> PM </FONT>";
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."\" value=\"AM\" checked> AM </FONT>";
}
ELSE
{
echo "<font color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."\" value=\"PM\" checked> PM</FONT>";
echo "<FONT color=\"".$textcolortime."\"><input type=\"radio\" name=\"".$inampm."\" value=\"AM\" > AM </FONT>";

}

}
} //end of class
?>
