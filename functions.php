<?PHP
session_start();
//require("lmvars.inc");
class $library
{
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
    displayloginheader("Event Management Login");?>
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
		$this->display=$display;
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
		//$display .= "<LINK REL=\"stylesheet\" HREF=\"http://www.louisvillemusicnews.net/classes/currentcss.css\" type=\"text/css\" />\n";
		$display .= "<title>Louisville Music News.net Main Menu</title>\n";
		$display .= "<link rel=\"stylesheet\" href=\"http://www.louisvillemusicnews.net/classes/currentcss.css\" type=\"text/css\">\n";
		$display .= "</head>";
		$display .= "<body bgcolor=\"#330000\">\n";
		$display .= "<table valign=\"top\" width=\"583\" align=\"center\" border=\"1\"  bgcolor=\"#f5e3a1\">";
		$display .= "<tr><td align=\"center\" bgcolor=\"#c0c0c0\" colspan=\"5\" valign=\"top\">"; 
		$display .= "<img src=\"http://www.louisvillemusicnews.net/lmn/images/lmcomlogogrey.GIF\" width=\"583\" align=\"center\"></td></tr><tr><td bgcolor=\"#0c4a7d\" colspan=\"5\">"; 
		$display .= "</td></tr><tr><td align=\"center\" width=\"583\" class=\"eventdate\" colspan=\"5\" valign=\"top\" background=\"#0c4a7d\">\n";
		$display .= date("l, F j, Y");
		$display .= "</td></tr></table>";  
		$this->display=$display;
      	}
function displayloginheader($loginheader)
	{
		$display .= "<div style=\"background-color:#f5e3a1; width:580px; border:solid thin #f5e3a1;  margin: auto;\">\n";
		$display .= "<div class=\"IssueHdr\">".$loginheader."</div>\n";
		$this->display=$display;
	}


function displaynoauthorization($colspan)
{
$display .= "<TR><TD align=\"center\" colspan=\"".$colspan."\">You are not authorized to access this page. <BR>Please contact the site adminstrator for assistance.</td></tr>";
$display .= "<TR><TD Align=\"center\" colspan=\"".$colspan."\"><button OnClick=\"parent.location='http://www.louisvillemusicnews.net'\" style=\"background-color: \"grey\"><font color=\"blue\">Click Here</button></td></tr>";
$this->display=$display;
}

} //end of class?>
