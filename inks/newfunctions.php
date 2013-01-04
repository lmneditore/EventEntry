<?
require( "lmvars.inc" );
function newPwd($length)
{
global $repassword;
  // start with a blank password
  $repassword = "";
  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
  // set up a counter
  $i = 0; 
  // add random characters to $password until $length is reached
  while ($i < $length) 
  { 
    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    // we don't want this character if it's already in the password
    if (!strstr($repassword, $char)) 
	{ 
      $repassword .= $char;
      $i++;
    }
  }
  // done!
  //return $repassword;
}// end of generate password
function verifycalendaruser($user_id)
{

    if (isset($_SESSION["valid_user"]))
    {
		IF (!isset($_SESSION["user_id"]))
			{
			echo "No valid user number.";
			}
			ELSE // check for each type
			{
				include("../inks/LMhdrw.inc");
			$sqlck="SELECT * from lmuserapproval 
			LEFT JOIN approval_type ON
			lmuserapproval.type_id=approval_type.type_id
			WHERE lmuser_id='$user_id'
			ORDER BY approval_type.type_id";
			$check=@mysql_query($sqlck) or die("couldn't execute validate user query ");
			$checkapprov=@mysql_fetch_array($check);
			$numrows=@mysql_num_rows($check);
			$numfields=@mysql_num_fields($check);
			//check for buttons to display
				if ($user_id==24)
				{
					DO
					{
					$findname="Find_".$checkapprov["app_name"];
					$value="Select ".$checkapprov["app_name"];
					$name="";
					$OnClick="http://".$checkapprov["adminfile"]."?submit=".$findname;
					$windowlocation="window.location";
					lmnbutton($value, $name,$OnClick,$windowlocation);?>
					<BR><BR><?
					}
					WHILE ($checkapprov=@mysql_fetch_array($check));
				}
				ELSE
				{
				Do
				{
				$app_name=$checkapprov["app_name"];
				$typename=$checkapprov["type"];
				$$typename=$checkapprov["id_value"];
					IF (!$VenueID)
					{
					}
					ELSE
					{
					$validvenue=$VenueID;
					session_register("validvenue");
					include("../inks/LMHeader.inc");
					$venuesql="SELECT VenueName FROM Venues WHERE VenueID='$validvenue'";
					$thisresult=@mysql_query($venuesql,$connection4) OR DIE ("Couldn't complete the $venuesql query");
					$thisvenue=@mysql_fetch_array($thisresult);
					Do
					{
					$value=$thisvenue["VenueName"];
					}
					WHILE ($thisvenue=@mysql_fetch_array($thisresult));
					$name="";
				$OnClick="http://www.louisvillemusicnews.net/evententry/editthisvenueevents.php?validvenue=$validvenue";
					$windowlocation="";
					lmnbutton($value, $name,$OnClick,$windowlocation);
						echo "<BR><BR>";
					}
					IF (!$ActID)
					{
					}
					ELSE
					{
					$validact=$ActID;
			 		//$_SESSION["validact"]=$validact;
					$value="Edit Act";
					$name="";
					$OnClick="http://www.louisvillemusicnews.net/evententry/Actinfo.php=$validact";
					$windowlocation="window.location";
					lmnbutton($value, $name,$OnClick,$windowlocation);
					echo "<BR><br>";
					}
					IF (!$teacherid)
					{
					}
					ELSE
					{
					include("../inks/LMHeader.inc");
					$value="Teacher Listing";
					$name="";
					$OnClick="http://www.louisvillemusicnews.net/teachers/teacherinfo.php?submit=Show_Teacher&teacherid=$teacherid";
					$windowlocation="window.location";
					lmnbutton($value, $name,$OnClick,$windowlocation);
					echo "<BR><BR>";
					}
				}
				WHILE ($checkapprov=@mysql_fetch_array($check));
			}
		}
/*			IF ($validact)
			{
			$value="Select A Venue";
			$name="";
			$OnClick="http://www.louisvillemusicnews.net/evententry/editthisvenueevents.php?validvenue=$validvenue";
			$windowlocation="window.location";
			lmnbutton($value, $name,$OnClick,$windowlocation);
		<?      }*/
	}
	ELSE //Else of Not valid user
	{
    displayloginheader("Event Management Login");?>
    <DIV class="centertable"><DIV class="loginhdr">You are not authorized to be here. Please return to the Main Page or log in.<? echo $valid_user;?></div>
    <DIV>
<?	
$value="Log in";
$name="submit";
$OnClick="window.location='http://www.louisvillemusicnews.net/members/lmlogin.php'"; 
lmnbutton($value, $name,$OnClick,$windowlocation);
?></td></tr>
    <tr><td align="center"><BR>
	<?
	$value="Main";
	$name="submit";
	$OnClick="http://www.louisvillemusicnews.net/lmn/lmhdr.php";
	lmnbutton($value, $name,$OnClick,$windowlocation);
?></td></tr></table>
     <? 
     }
}


function opendb1()
{
include("../inks/LMHeader.inc");
}

function opendb2()
{
include("../inks/LMhdrw.inc");
}

function displayloginheader($loginheader)
	{
		echo "<table class=\"centertable\" width=\"580\" align=\"center\" >\n";
echo "<tr><td class=\"IssueHdr\" width=\"580\">$loginheader</font></td></tr>\n";
		echo "<div align=\"center\">\n";
		echo "  <center>\n";
		echo "  <table class=\"centertable\">\n";
	}
	
	
	function displayLMHeader( $title = "Louisville Music.com Main Menu" )
	{

		echo "<body class=\"body\">\n";
		echo "<div   class=\"centertable\">";
		echo "<DIV class=\lmhdr\">"; 

		echo "<img src=\"http://www.louisvillemusicnews.net/lmn/newlmnwebflagw.jpg\" width=\"600\" align=\"center\"></DIV><DIV class=\"lmhdr\"";

      include ("http://www.louisvillemusicnews.net/lmn/menuwhite.php");
	 
      ?>
		</DIV>
		<DIV class="lmhdr"> 
     <?PHP
      echo date("l, F j, Y");
      ?>
      </DIV>
    <?PHP
	}

	
	
	
	function WriteDateSelect($BeginYear, 
                         $EndYear, 
                         $IsPosted = true,
                         $Prefix = '',$thisdate, $thistextcolor)
{

//$thisyear=substr($thisdate,0,4);
//$thismonth=substr($thisdate,5,2);
//$thisday=substr($thisdate,8,2);

//if (substr($thisday,0,1))
//{
//$thisday=(substr($thisday,1,1));
//}
//ELSE
//{
//$thisday=$thisday;
//}

    if (! $BeginYear)
  {
    $BeginYear = date('Y');
  }
		
  if (! $EndYear)
  {
    $EndYear = $BeginYear+5;
  }
  
  echo "<select style=\"color:".$thistextcolor."\" name=\"".$Prefix. "Year\" >";
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    echo "<option ";
		
//   if ($i == $thisyear)
  //    { echo "selected";
	//  }
//	  Else
//	  {
//	  }
    echo ">".$i."</option>";
  }
	
  echo "</select>-<select style=\"color:".$thistextcolor."\" name=\"". $Prefix."Month\">";
  for ($i = 0; $i <= 12; $i++)
  {
    echo "<option";
//    if ($i == $thismonth)
  //    {echo "selected";
	//  }
//	  ELSE
//	  {}
    echo ">".$i. "</option>";
	 }
  echo "</select>-<select style=\"color:".$thistextcolor."\" name=\"".$Prefix."Day\">";
  for ($i = 0; $i <= 31; $i++)
  {
    echo "<option ";
		
//    if ($i == $thisday)
  //    {echo "selected";}
//		ELSE{}
    echo ">".$i."</option>";
  }

  echo "</select>";
  return;
}

	
	function sentMail( $from, $to, $subject, $body )
	{
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ios-8859-1\r\n";
		$headers .= "From: {$from}\r\n";
		$result = @mail( $to, $subject, $body, $headers );
		if( $result ) return true;
		else return false;
	}
	
	function verifyUser()
	{
		global $ADMIN_EMAIL;
 session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
		session_start();
		global $lmusername, $password;
		if( session_is_registered( "lmusername" ) && session_is_registered( "password" ) )
		{
			$result = mysql_query( "SELECT user_name, password FROM lmuser WHERE user_name='$username' AND BINARY password='$password'" ) or error( "Login failed, please contact <a href=\"$ADMIN_EMAIL\">adminstrator</a>" );
			if( mysql_num_rows( $result ) == 1 ) return true;
		}
		return false;
	}
	
	
	Function displaynoauthorization($colspan)
{
echo "<TR><TD align=\"center\" colspan=\"".$colspan."\">You are not authorized to access this page. <BR>Please contact the site adminstrator for assistance.</td></tr>";
echo "<TR><TD Align=\"center\" colspan=\"".$colspan."\"><button OnClick=\"parent.location='http://www.louisvillemusicnews.net'\" style=\"background-color: \"grey\"><font color=\"blue\">Click Here</button></td></tr>";

}

function statusselectbox($thisstatus, $textcolorstatus)
{
if ($thisstatus=="DI")
{$thisstatus="OK";
}
ELSE {}
echo "<select name=\"thisstatus1\" size=\"3\">";
  $statuses = array ("OK" => "Display",
                        "PE" => "Pending",
						"PR" => "Proprietary",
                        "DE"  => "Delete",
						"H1"=>"Hold-1",
						"H2"=>"Hold-2",
						"H3"=>"Hold-3",
						"H4"=>"Hold-4");
  while (list ($key, $value) = each ($statuses))
    {
	if ($key==$thisstatus)
	{?>
<option style=\"color:"<?echo $textcolorstatus;?>"   value="<? echo $key;?>" SELECTED><?echo $value;?></option><?
	}
	ELSE
	{
	?>
<option style=\"color:"<?echo $textcolorstatus;?>"  value="<? echo $key;?>"><?echo $value;?></option><?

    }
	}
echo" </select>";
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

function timefix($intime)// Function to fix incoming time entries

{
global $intime;
$intime=strtoupper(trim($intime));
$intime=ereg_replace("P"," P",$intime); //Add white space to front of A or P
$intime=ereg_replace("A"," A",$intime); //Add white space to front of A or P
    IF (substr($intime,0,4)=="NOON")// check for Noon and Mid
    {
    $intime="12:00 PM";
    }
    ELSEIF (substr($intime,0,3)=="MID")
    { 
    $intime="12:00 AM";
    }
	ELSEIF ($intime=="MIDNIGHT")
	{ 
    $intime="12:00 AM";
    }
	ELSEIF ($intime=="MIDNITE")
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


if($pos === false) // there is not a colon
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

if (strlen($thishour)==1)
{
$thishour="0".$thishour;
}
ELSE
{$thishour=$thishour;
}
$intime=$thishour.":".$thisminute." ".$thisampm;
	
}// end of timefixfunction

// mediasent is Y or N, typechange is 1=New, 2=change, 3=delete

function posteventchange($thiseventMainEVID, $thisschedid,$mediasent,$user_id, $typechange,$oldschedid)
{
include("../inks/LMHeader.inc");
$changedate = date("Y-m-d");

$sql="Select * FROM eventchange 
WHERE (mainevid='$thiseventMainEVID' AND schedid='$thisschedid') 
ORDER BY changedid DESC;";
$check=@mysql_query($sql) or die("Couldn't check on this change.");
$changedata=@mysql_fetch_array($check);
// check to see if there is already an eventchange record for this date for this event.
if ($changedata["mainevid"]==NULL)
{
        $sqlpost="INSERT INTO eventchange VALUES ('','$thiseventMainEVID','$thisschedid', '$changedate','0000-00-00','$user_id','$typechange','$oldschedid')";
         $result=@mysql_query($sqlpost) or die("couldn't execute post change for".$schedid."query.");
return;
}
ELSEIF ($sent2media=="0000-00-00")// If media info has not been sent, update record to add schedule id.
{
         $sqlpostchange="UPDATE eventchange SET schedid='$thisschedid', user_id='$user_id', typechange='$typechange',oldschedid='$oldschedid' WHERE (mainevid='$thiseventMainEVID' AND schedid='$thisschedid' AND sent2media='0000-00-00')";
         $result=@mysql_query($sqlpostchange) or die ("Unable to revise the eventchange record for ".$thiseventMainEVID."and ".$thisschedid);
return;
}
ELSE // If media info has been sent, add a new record
{
         $sqlpost="INSERT INTO eventchange VALUES ('','$thiseventMainEVID','$thisschedid', '$changedate','0000-00-00','$user_id','$typechange','$oldschedid')";
         $result=@mysql_query($sqlpost) or die("couldn't execute post change for".$schedid."query.");
}

}//Function End Bracket

function isstage()
{
if ($isstage=="Y")
{?>
<TR><TD align="right">Stage Name: </TD>
<? include($stageselectbox);
}
ELSE
{
}
}
function showstatus($thisstatus)
{

if ($thisstatus=="DE")
{
echo "<Span style=\"font-size: 11 px; color:red;\">Deleted</span>";
}
ELSEIF ($thisstatus=="OK")
{echo "<Span style=\"font-size: 11 px; color:blue;\">Display</span>";
}
ELSEIF ($thisstatus=="PE")
{
Echo "<Span style=\"font-size: 11 px;color:\"#00cc00\";>Pending</span>";
}
ELSE
{echo "<Span style=\"font-size: 11 px; color:blue;\">Display</span>";
}
}

function isprsent($sent2media)
{
if ($sent2media=="0000-00-00")
{
echo "<BR>&nbsp;<Span style=\"font-size: 11 px; color:red;\">NOT SENT</span>";
}
ELSE
{
echo "<BR>&nbsp;<Span style=\"font-size: 11 px; color:blue;\">Sent on ".$sent2media."</span>";
}
}



function checkisfile($image,$chosensize)
{
  $fp = fopen($image,"r");
        if ($fp)
        {
        $size = getimagesize($image);
        global $imgvar;
            if ($size[0]>$size[1])//If width is greater than height
            { 
            $imgvar="width=\"".$chosensize."\"";
            }
            Else
            {
            $imgvar="height=\"".$chosensize."\"";
            }
        }
      ELSE
        {
        }
}

function lookup($file2open)
{
echo "<script language=\"Javascript\">";
echo "function lookup()";
echo "{window.open('$file2open','Search', 'fullscreen=no,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,directories=no,location=no,width=230,height=350,left=400,top=100')}";
echo "</script>";
}


	
	
	
if ( ! defined( 'MAIL_CLASS_DEFINED' ) ) {
        define('MAIL_CLASS_DEFINED', 1 );

class email {

        // the constructor!
        function email ( $subject, $message, $senderName, $senderEmail, $toList, $ccList=0, $bccList=0, $replyTo=0) {
                $this->sender = $senderName . " <$senderEmail>";
                $this->replyTo = $replyTo;
                $this->subject = $subject;
                $this->message = $message;

                // set the To: recipient(s)
                if ( is_array($toList) ) {
                        $this->to = join( $toList, "," );
                } else {
                        $this->to = $toList;
                }

                // set the Cc: recipient(s)
                if ( is_array($ccList) && sizeof($ccList) ) {
                        $this->cc = join( $ccList, "," );
                } elseif ( $ccList ) {
                        $this->cc = $ccList;
                }
                
                // set the Bcc: recipient(s)
                if ( is_array($bccList) && sizeof($bccList) ) {
                        $this->bcc = join( $bccList, "," );
                } elseif ( $bccList ) {
                        $this->bcc = $bccList;
                }

        }

        // send the message; this is actually just a wrapper for 
        // PHP's mail() function; heck, it's PHP's mail function done right :-)
        // you could override this method to:
        // (a) use sendmail directly
        // (b) do SMTP with sockets
        function send () {
                // create the headers needed by PHP's mail() function

                // sender
                $this->headers = "From: " . $this->sender . "\n";

                // reply-to address
                if ( $this->replyTo ) {
                        $this->headers .= "Reply-To: " . $this->replyTo . "\n";
                }

                // Cc: recipient(s)
                if ( $this->cc ) {
                        $this->headers .= "Cc: " . $this->cc . "\n";
                }

                // Bcc: recipient(s)
                if ( $this->bcc ) {
                        $this->headers .= "Bcc: " . $this->bcc . "\n";}
	      $this->headers .= "MIME-Version: 1.0\n";
	  $this->headers .= "Content-Type: text/html; charset=iso-8859-1"; 
                return mail ( $this->to, $this->subject, $this->message, $this->headers );
                
        }
}


}
function send_mail($to_name, $to_email, $from_name, $from_email, $subject, $wholemessage)
{ 
//  strip the slashes out of these strings. 
   while(list($key,$val)=each($_REQUEST)){ 
       $$key = stripslashes( $$val ); 
    } 
$to_name=$to_name."<".$to_email.">";
$headers .= "From:".$from_name."<".$from_email.">\r\n"; 
$headers .= "To:".$to_name."\r\n"; 
$headers .= "Reply-To:<".$from_email.">\r\n"; 
$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "X-Priority: 1\r\n"; 
$headers .= "X-MSMail-Priority: High\r\n"; 
$headers .= "X-Mailer: PHP 4.x"; 
mail($to_email, $subject, $wholemessage, $headers);

}

function prsentupdate($validvenue)
{
include("../../inks/LMHeader.inc");
$sql="SELECT * FROM MainEvents WHERE (VenueID='$validvenue' AND sent2media='0000-00-00')";
$allrecs=@mysql_query($sql,$connection4) OR DIE("couldn't complete sql=".$slq." query.");
$copy2oldsql=@mysql_fetch_array($allrecs);

$date = date("Y-m-d");
DO
{
$insert="";
	include("../../inks/LMHeader.inc");
	$pre_sent="SELECT MainEvents_Old.MainEVID AS OldMainEVID FROM MainEvents_Old WHERE MainEvents_Old.MainEVID='$MainEVID'";
	$preresult=@mysql_query($pre_sent,$connection4) OR DIE ("Couldn't do pre_sent query=".$MainEVID."");
	$preexists=@mysql_fetch_array($preresult);
	DO {
		if($preexists["OldMainEVID"]>0 AND $preexists["sent2media"]=='0000-00-00')
		{
					$oldupdate="UPDATE MainEvents_Old SET MainEvents_Old.sent2media='$date', datechanged='$date' WHERE MainEvents_Old.MainEVID='$MainEVID'";
		}
		ELSE
		{
		$insert .="INSERT INTO MainEvents_Old VALUES ('','".$copy2oldsql["MainEVID"]."','".$copy2oldsql["EventDate"]."','".$copy2oldsql["EventTitle"]."','".$copy2oldsql["SeriesID"]."','".$copy2oldsql["VenueID"]."','".$copy2oldsql["DoorsOpen"]."','".$copy2oldsql["EventStart"]."','".$copy2oldsql["EventEnd"]."','".$copy2oldsql["Prices"]."','".$copy2oldsql["KindOfEvent"]."','".$copy2oldsql["DescriptionOfEvent"]."','".$copy2oldsql["Confirmed"]."','".$copy2oldsql["Advertiser"]."','".$copy2oldsql["ContactNumber"]."','".$copy2oldsql["AgeLimits"]."','".$copy2oldsql["DataSourceID"]."','".$copy2oldsql["AMGGenre"]."','".$copy2oldsql["AMGSubCat1"]."','".$copy2oldsql["AMGSubCat2"]."','".$copy2oldsql["onsaledate"]."','".$copy2oldsql["input_site"]."','".$copy2oldsql["status"]."','0000-00-00','".$user_id."','".$copy2oldsql["sponsor"]."','".$date."' )";
		$runinsert=@mysql_query($insert,$connection4) OR DIE ("Couldn't insert record number=".$MainEVID."");
//$oldMainEVID=$preexists["MainEVID"];
		}
	}
	while ($preexists=@mysql_fetch_array($preresult));
$MainEVID=$copy2oldsql["MainEVID"];
}
WHILE ($copy2oldsql=@mysql_fetch_array($allrecs));

$sql="SELECT * FROM MainEvents WHERE (VenueID='$validvenue' AND sent2media='0000-00-00')";
$sendrecs=@mysql_query($sql,$connection4) OR DIE("couldn't complete sql=".$slq." query.");
$updatesent=@mysql_fetch_array($sentrecs);
DO
{
$sqlupdate="UPDATE MainEvents SET MainEvents.sent2media='$date' WHERE MainEvents.MainEVID='$MainEVID'";
$update=@mysql_query($sqlupdate,$connection4) OR DIE ("Couldn't update sent records");

}
WHILE ($updatesent=@mysql_fetch_array($sentrecs));
RETURN;
}//end of updatesent2media 


function updatemainevent($thiseventMainEVID,$status)
{
Include ("../inks/LMHeader.inc");
    $sqlmaineventup="SELECT * FROM MainEvents WHERE MainEVID='$thiseventMainEVID'";
$rec=@mysql_query($sqlmaineventup) or die("couldn't execute mainevents delete query for MainEVID=".$thiseventMainEVID.".s");
$result=@mysql_fetch_array($rec);

	if ($result["sent2media"]=='0000-00-00')
	{
	}
	ELSE
	{// copy to MainEvents_OLD
	DO 
	{
	$mainevid=$result["MainEVID"];
	$eventdate=$result["EventDate"];
	$eventtitle=$result["EventTitle"];
	$seriesid= $result["SeriesID"];
	$venueid= $result["VenueID"];
	$doorsopen=$result["DoorsOpen"];
	$eventstart= $result["EventStart"];
	$eventend= $result["EventEnd"];
	$prices= $result["Prices"];
	$kindofevent=$result["KindOfEvent"];
	$descriptionofevent= $result["DescriptionOfEvent"];
	$confirmed= $result["Confirmed"];
	$advertiser= $result["Advertiser"];
	$contactnumber=$result["ContactNumber"];
	$agelimits= $result["AgeLimits"];
	$datasourceid=$result["DataSourceID"];
	$amggenre= $result["AMGGenre"];
	$amgsubcat1= $result["AMGSubCat1"];
	$amgsubcat2= $result["AMGSubCat2"];
	$onsaledate= $result["onsaledate"];
	$input_site= $result["input_site"];
	$status= $result["status"];
	$sponsor=$result["sponsor"];
	$sent2media=$result["sent2media"];
	$datechanged=date("Y-m-d");
	
	$sqlmaineventinsert="INSERT INTO MainEvents_Old VALUES ('','$mainevid','$eventdate', '$eventtitle','$seriesid', '$venueid','$doorsopen', '$eventstart','$eventend','$prices','$kindofevent', '$descriptionofevent','$confirmed','$advertiser','$contactnumber','$agelimits','$datasourceid', '$amggenre',  '$amgsubcat1', '$amgsubcat2', '$onsaledate','$input_site','$status','$user_id', '$datechanged','$sponsor','$sent2media')";
	$results=@mysql_query($sqlmaineventinsert) or die("couldn't execute insert MainEvent_Old query ");
	}
	WHILE ($result=@mysql_fetch_array($rec));
	}
$sql="UPDATE MainEvents SET sent2media='0000-00-00', status='$status' WHERE MainEvents.MainEVID='$thiseventMainEVID'";
$resetmedia=@mysql_query($sql,$connection4) OR DIE ("Unable to reset sent2media for Main EVID =".$thiseventMainEVID."");
mysql_close($connection4);
}

function backupbnews()// Used with the breaking news file and db. 
{
$archivecontent="";
$typebreak="<BR>";
include ("../inks/LMHeader.inc");
$sql="SELECT bnewsid, recorddate, headline,story,bnews.actid, authorid,WholeName,ActName FROM bnews 
LEFT JOIN LMNContributor ON
bnews.authorid=LMNContributor.LMNContributorID
LEFT JOIN Acts ON
bnews.actid=Acts.ActID
WHERE killdate<DATE_SUB(curdate(), INTERVAL 30 DAY)
ORDER BY bnewsid";
$selectresult=@mysql_query($sql) OR DIE ("Unable to select breaking news table.");
$oldbnews=@mysql_fetch_array($selectresult);
DO 
{
$archivecontent .=$typebreak."<A Name=\"#StoryID".$oldbnews["bnewsid"]."\"><B>".$oldbnews["bnewsid"]."</b></a>".$typebreak."";
$archivecontent .="RecordDate=".$oldbnews["recorddate"]."".$typebreak."";
$oldbheadline=stripslashes($oldbnews["headline"]);
$archivecontent .="Headline=".$oldbheadline."".$typebreak."";
$archivecontent .="Author=".$oldbnews["WholeName"]."".$typebreak."";
	If (!$oldbnews["ActName"])
	{
	}
	ELSE
	{
	$archivecontent .="Act Name =".$oldbnews["ActName"]."".$typebreak."";
	}
	$oldstory=stripslashes($oldbnews["story"]);
$archivecontent .="Story=".$oldstory."".$typebreak."";
$archivecontent .=$typebreak."</b></i>";

}
WHILE ($oldbnews=@mysql_fetch_array($selectresult));


echo $archivecontent;
$filename="oldbnews.txt";
		If (!$handle = fopen($filename, 'a')) 
		{
		print "Cannot open file ($filename)";
		exit;
		}
		$handle=fopen($filename, "w");
	fwrite($handle, $archivecontent);
	fclose($handle);
$bnewsid=$oldbnews["bnewsid"];
$recdate=$oldbnews["recorddate"];
$headline=$oldbnews["headline"];
$actid=$oldbnews["actid"];
$author=$oldbnews["authorid"];
$storyurl="archives/oldbnews.php#StoryID=".$bnewsid."";

include("../inks/lm2hdr.inc");
if ($bnewsid>0)
{
$insertsql="INSERT INTO oldbnews VALUES ('$bnewsid','$recdate','$headline','$author','$actid','$storyurl')";
$insertoldbnewsinfo=@mysql_query($insertsql,$connection2) OR DIE ("Unable to insert info about story=".$headline."");
@mysql_close($connection2);
}
ELSE
{
}
include("../inks/LMHeader.inc");
$sqldelete="DELETE FROM bnews WHERE killdate<DATE_SUB(curdate(), INTERVAL 30 DAY)";
$delresult=@mysql_query($sqldelete,$connection4,$windowlocation) OR DIE ("Unable to complete bnews deletion.");
$mysql_close($connection4);
}
//$bgcolor,$fontsize,$fontweight,$color,$fontvariant,$width,
function lmnbutton($value, $name,$OnClick,$windowlocation)
{
$len=strlen($value);
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10 pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
echo "}";
echo "</style>";

If ($windowlocation)
{
}
ELSE
{
}$windowlocation="parent.location";


echo "<button OnClick=\"$windowlocation='$OnClick'\" class=\"lmnbutton\" name=\"$name\" >$value</button>";
}

function forminputbutton($type, $name, $value,$OnClick)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
//echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
echo "font-align: center;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"lmnbutton\" >";
}

function inputbutton($type, $name, $value, $OnClick)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 12pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"lmnbutton\" onClick=\"$OnClick\">$value</button>";
}

function submitbutton($value)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbutton\" >";
}

function actionbutton($value)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"submit\" name=\"action\" value=\"".$value."\" class=\"lmnbutton\" >";
}

function lmnalertbutton($value, $name,$OnClick)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10 pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "border-style: groove;";
echo "}";
echo "</style>";


echo "<button OnClick=\"$OnClick\" class=\"lmnbutton\" name=\"$name\" onmouseover=\"font-weight: 'bold';\" >$value</button>";
}

function lmbackup($value)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 12 pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<button name=\"BackUp\" value=\"$value\" class=\"lmnbutton\" onClick='history.go(-1)'>$value</button>";
}
function closewindow()
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 12 pt;";
echo "background-color: #0c4a7d;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<form><input type=\"button\" value=\"Close\" class=\"lmnbutton\" onClick=\"javascript:window.close();\"></form>";
}
function stageselectbox($venueid,$stagecolorstatus)
{
include("../inks/LMHeader.inc");
$sql="SELECT StageName, StageID FROM Stages WHERE VenueID='$venueid'";
$sqlstage=@mysql_query($sql,$connection4) OR DIE ("Unable to complete the stages query." );
$stages=@mysql_fetch_array($sqlstage);
$numstages=count($stages);

echo "<select name=\"thisstage1\" size=\"$numbstages\">";
 
 DO
 {
?> <Option style="color: <?echo $stagecolorstatus;?>" value="<? echo $stages["StageID"]; ?>"><? echo $stages["StageName"]; ?></option>  
<?}
 WHILE ($stages=@mysql_fetch_array($sqlstage));
}


function documentheaders($company, $stylesheet,$url,$meta)
{
	if (!$company)
	{
	$company="Louisville Music.com";
	}
	if(!$stylesheet)
	{
	$stylesheet="http://www.louisvillemusicnews.com/stylesheets/LMNStyleswhite.css";
	}
	if (!$url)
	{
	$url="www.louisvillemusicnews.net";
	}
?>
<HTML>
<HEAD>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<LINK REL="stylesheet" HREF="<? echo $stylesheet;?> " TYPE="text/css">
<!-- Copyright 2004 By <? echo $company; ?>. All rights reserved. Portions of text may be used in accordance with the doctrine of "Fair Use," provided proper credits and referencing to <? echo $company; ?> at <? echo $url;?> . Reuse of photographs on this site is strictly prohibited. Any unauthorized use of this document and the content herein is strictly forbidden.-->
<?
if (!$meta)
{
$meta="<meta name=\"ROBOTS\" content=\"ALL\">

<meta name=\"distribution\" content=\"global\">

<META name=\"Keywords\" content=\"music,Louisville,Kentucky,Southern, Indiana, live,blues,rock, country, bluegrass, Christian, Celtic, hardcore, musicians, jazz, mountain, original, reviews, features, events, songwriters\">

<meta HTTP-EQUIV=\"resource-type\" content=\"document\">

<meta name=\"Classification\" content=\"Music and Entertainment News\">

<meta HTTP-EQUIV=\"Content-Type\" content=\"text/css; charset=iso-8859-1\">";
}
echo $meta;
echo "</head>";
}

function anchor($url, $window)
{
echo "<A HREF=\"".$url."\" TARGET=\"$window\" onClick=\"window.open('$url', 'win', 'status'); return false\">";
}

function defaultmemberbuttons()
{
		$OnClick="http://www.louisvillemusicnews.net/members/lmlogout.php";
		$windowlocation="parent.location";
		lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
		$redo="http://www.louisvillemusicnews.net/members/membersonly.php";
		?>&nbsp;&nbsp;<?
		$OnClick=$redo;
		$windowlocation="parent.location";
		lmnbutton("Members Page","", $OnClick,$windowlocation);
		// buttonrow ("Continue","");
}



function displayHeader()
	{
		echo "<html>\n";
		echo "<head>\n";
		$title = "Louisville Music.com Main Menu ";
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
		echo "<title>$title</title>\n";
		echo "<link rel=\"stylesheet\" href=\"http://www.louisvillemusicnews.net/stylesheets/LMNStyleswhite.css\" type=\"text/css\">\n"; 
		?>
<script language="Javascript" type="Text/Javascript">
	function changebgcolor() 
	{
		var allbuttons = document.getElementsByTagName("button")
		for (var i = 0; i < allbuttons.length; i++) 
		{
			allbuttons[i].onmouseover = function() 
			{
				this.style.backgroundColor = '#0c4a7d'
				this.style.fontWeight='600'
				this.style.color='#f2f2f2'
				this.style.fontVariant='small-caps'
			}
			allbuttons[i].onmouseout = function() 
			{
				this.style.backgroundColor = '#0c4a7d'
				this.style.fontWeight='normal'
				this.style.color='white'
				this.style.fontVariant='normal'
			}
		}
	}
window.onload = changebgcolor

</script>
		<?PHP 
		
		echo "</head>\n";
		echo "<body bgcolor=\"#0c4a7d\">\n";
		echo "<DIV class=\"mainbody\">";
		echo "<DIV class=\lmhdr\">"; 
		echo ("<img src=\"http://www.louisvillemusicnews.net/lmn/newlmnwebflagw.jpg\" width=\"583\" align=\"center\"></DIV><DIV class=\lmhdr\">");

      include ("http://www.louisvillemusicnews.net/lmn/menuwhite.php");
?>     </DIV>
	   <DIV class=\"TodaysDate\">  
     <?PHP 
      echo date("l, F j, Y");
      ?>
      </DIV>
    <?PHP 
}
	
	
	
	function loginbutton()
	{
	$value="Log In";
	$name="submit";
	$OnClick="http://www.louisvillemusicnews.net/members/lmlogin.php";
	lmnbutton($value, $name,$OnClick,$windowlocation);
	}

function getimage($pathtoimage,$chosensize)
{
global $thisimage;
	if (ereg("Http",$pathtoimage))
	{
	$pathtoimage=ereg("Http", "http",$pathtoimage);
	}
	if (!fopen($pathtoimage,'r')) 
	{
	$pathtoimage=eregi("louisvillemusicnews.com", "louisvillemusicnews.net",$pathtoimage);
		if (!(@fclose(@fopen($pathtoimage,'r'))))
		{
		}
		ELSE
		{
			$size = getimagesize($pathtoimage);
			if ($size[0]>$size[1])//If width is greater than height
			{ 
			$thisimage="<img src=\"".$pathtoimage."\" align=\"left\" width=\"".$chosensize."\">";
			}
			Else
			{
			$thisimage="<img src=\"".$pathtoimage."\" align=\"left\" height=\"".$chosensize."\">";
			}
		}
	}
	ELSE
	{
	$size = getimagesize($pathtoimage);

		if ($size[0]>$size[1])//If width is greater than height
		{ 
		$thisimage="<img src=\"".$pathtoimage."\" align=\"left\" width=\"".$chosensize."\">";
		}
		Else
		{
		$thisimage="<img src=\"".$pathtoimage."\" align=\"left\" height=\"".$chosensize."\">";
		}
	}
}
function adrank($bizid)
{
global $adrank;
include("../inks/LMhdrw.inc");
$adsql="select lm_pageapps.adrank FROM lm_pageapps 
LEFT JOIN lm_apporders ON
lm_pageapps.adid=lm_apporders.adid
WHERE lm_apporders.startdate<CurDate() AND lm_apporders.enddate>curdate() AND lm_apporders.bizid='$bizid'";
$result=@mysql_query($adsql);
$rankarray=@mysql_fetch_array($result);
$adrank=$rankarray["adrank"];
@mysql_close();
}
	