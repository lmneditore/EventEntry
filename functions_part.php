<?PHP
include("buttonsclass.php");
class functionsclass 
{
	function displayloginheader($loginheader)
	{
		$lihdr="<table bgcolor=\"#f5e3a1\" width=\"580\" align=\"center\" border=\"1\" bordercolor=\"#f5e3a1\" cellpadding=\"4\">\n";
		$lihdr .="<tr><td class=\"IssueHdr\">".$loginheader."</font></td></tr></table>\n";
		//$lihdr .="  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor= \"#f5e3a7\">\n";
		$this->lihdr=$lihdr;
	}
	function displayheader()
	{
		$buttons=new buttons();
		$title = "LouisvilleMusicNews.net Main Menu ";
		$htdisplay="<html><head><LINK REL=stylesheet HREF=\"http://www.louisvillemusicnews.net/lmn/LMNStyles.css\" TYPE=\"text/css\">";
		$htdisplay .="</head><title>".$title."</title>\n";
		$htdisplay .="<link rel=\"stylesheet\" href=\"http://www.louisvillemusicnews.net/main/lmstyles.css\" type=\"text/css\">\n"; 
		$htdisplay .="</head>\n\n";
		$htdisplay .="<body bgcolor=\"#0F3925\">\n\n";
		$htdisplay .="<table valign=\"top\" width=\"583\" align=\"center\" border=\"1\"  bgcolor=\"#f5e3a1\">";
		$htdisplay .="<tr><td align=\"center\" bgcolor=\"#c0c0c0\" colspan=\"5\" valign=\"top\">"; 
		$htdisplay .="<img src=\"http://www.louisvillemusicnews.net/lmn/images/lmcomlogogrey.GIF\" width=\"583\" align=\"center\"></td></tr><tr><td bgcolor=\"#0c4a7d\" colspan=\"5\">";
		$htdisplay .="</td></tr><tr><td align=\"center\" width=\"583\" class=\"eventdate\" colspan=\"5\" valign=\"top\" background=\"#0c4a7d\">"; 
		$htdisplay .=date("l, F j, Y");
		$htdisplay .="</td></tr><tr></table>";
		$this->title=$title;
		$this->header=$htdisplay;
    	}
	function verifycalendaruser($user_id)
	{
	$valid=session_is_registered("valid_user");
	    if ($valid == "True")
	    {
            include("../inks/louisvillemusic_netcnxn.php");
	    $cnxn=new lm_netconnection();
	    $cnxn->lm_connection("louisvil_louisvillemusic2");
	Global $validvenue, $validact;
		     $sqlck="SELECT ActID,VenueID,BoardID from lmuserapproval WHERE lmuserid='$user_id'";
		     $check=@mysql_query($sqlck) or die("couldn't execute find venue/act query ");
		    $checkapprov=@mysql_fetch_array($check);
				if ($checkapprov["VenueID"]=="99")
				{
				$value="Select A Venue";
				$name="";
				$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/searchvenues.php?_action=Find_Venue";
				$windowlocation="window.location";
				lmnbutton($value, $name,$OnClick,$windowlocation); ?>
				<BR><BR><?PHP 
				$value="Select An Act";
				$name="";
				$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/searchact.php?_action=Find_Act";
				$windowlocation="window.location";
				lmnbutton($value, $name,$OnClick,$windowlocation);
				}
				ELSE
				{
			 $validvenue=$checkapprov["VenueID"];
				if ($validvenue)
				{
				session_register("validvenue");
				include("../inks/louisvillemusic_netcnxn.php");
				$venuesql="SELECT VenueName FROM Venues WHERE VenueID=$validvenue";
				$thisresult=@mysql_query($venuesql) OR DIE ("Couldn't complete the $venuesql query");
				$thisvenue=@mysql_fetch_array($thisresult);
				$venuename=$thisvenue["VenueName"];
				$value=$venuename;
				$name="";
				$OnClick="http://www.louisvillemusicnews.net/lmn/evententry/editthisvenueevents.php?validvenue=$validvenue";
				$windowlocation="window.location";
				lmnbutton($value, $name,$OnClick,$windowlocation);
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
				lmnbutton($value, $name,$OnClick,$windowlocation); ?>
				<BR><BR>
			<?PHP      }
				}
		}
		ELSE
		{
	   // displayloginheader("Event Management Login");
	    echo $this->lihdr;
	    ?>
	    <Table width="360" align="center"><tr><td class="loginhdr">You are not authorized to be here. Please return to the Main Page or log in.<?PHP echo $valid_user; ?></td></tr>
	    <tr><td align="center"><BR><button  OnClick="window.location='http://www.louisvillemusicnews.net/members/lmlogin.php'" style="background-color: "grey">Log in<font color="blue"></button><BR></td></tr>
	    <tr><td align="center"><BR><button OnClick="window.location='http://www.louisvillemusicnews.net/lmn/lmhdr.php'" style="background-color: "grey">Main<font color="blue"></button></td></tr></table>
	     <?PHP 
	     }//Else of Not valid user
	}
	     
}
?>

