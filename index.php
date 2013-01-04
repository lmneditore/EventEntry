<?PHP
session_start();
include ("pageloadclass.php");
$Load = new pageLoad;
include("classes/library.php");
$library= new library;
include("classes/buttonsclass.php");
$buttons=new buttons;
include("classes/louisvillemusic_netcnxn.php");
$cnxn=new lm_netconnection;
$cnxn->lm_connection("louisvil_louisvillemusic2");
//include("classes/cleantext.php");
include("businessweblink.php");
$globals["library"];
$globals["buttons"];
$globals["cnxn"];
$library->displayLMHeader();
echo "<div class=\"mainbox\">";
if(isset($valid_user) || isset($valid_adminuser))
{
	echo "<div class=\"navbar\"><DIV style=\"position:relative; float:left; align:center;\"><FORM Action=\"index.php\" Method=\"POST\">";
	$value="Log_Out";
	echo $buttons->_actionbutton($value);
	echo "</FORM></DIV>";
	echo "<DIV style=\"position:relative; float:left;align:center;\"><FORM Action=\"index.php\" Method=\"POST\">";
	$value="Members";
	echo $buttons->_actionbutton($value);
	echo "</FORM></DIV></div>";  
	}
 //echo $_action;
 	if(!isset($_action))
	{
		include("eventmanagementlogin.php");
	}
	ELSE
	{
		switch ($_action)
		{
		case "Register":
		include("lmregister.php");
		break;
		case "Log In":
		include("eventmanagementlogin.php");
		break;
		case "Members":
		include("membersonly.php");
		break;
		case "Log_Out":
		include("lmlogout.php");
		break;
		case "Select A Venue":
		include("searchvenues.php");
		break;
		case "Select An Act":
		include("searchact.php");
		break;
		case "Find Act":
		include("searchact.php");
		break;
		case "Find Venue":
		include("searchvenues.php");
		break;
		case "This Venue":
		include("editthisvenueevents.php");
		break;
		case "EditThisEvent":
		include("maineventeditB.php");
		break;
		case "Update Event";
		include("maineventeditB.php");
		break;
		case "EditThisSeries":
		include("maineventeditA.php");
		break;
		case "this_act":
		include("actinfo.php");
		break;
		case "Update_Act":
		include("actinfo.php");
		break;
		case "Final_Act_Update":
		include("actinfo.php");
		break;
		case "Test Page";
		include("testpage.php");
		break;
		case "Edit Blurb";
		include("dailyblurbedit.php");
		break;
		case "List Blurbs";
		include("dailyblurbedit.php");
		break;
		case "Preview Blurb";
		include("dailyblurbedit.php");
		break;
		case "Save Blurb Update";
		include("dailyblurbedit.php");
		break;
		case "Delete Blurb";
		include("dailyblurbedit.php");
		break;
		case "Confirm Delete Blurb";
		include("dailyblurbedit.php");
		break;
		case "Save New Blurb";
		include("dailyblurbedit.php");
		break;
		case "Confirm Blurb Edit";
		include("dailyblurbedit.php");
		case "Add New Act";
		include("actinfo.php");
		break;
		case "Edit Another Event";
		include("editthisvenueevents.php");
		break;
		}
	}
	echo 'This page loaded in ' . $Load->getLoadTime() . ' seconds';
echo "</font></div>";

?>
