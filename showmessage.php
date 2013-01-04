<?php
session_start();
include("functions.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">


</head>


<?
include("/inks/LMhdrw.inc");
$sendersql="SELECT fname,lname,salutation, venueid,actid FROM lmuser WHERE user_id='$user_id'";
$senderresult=@mysql_query($sendersql,$connection4) OR DIE ("Couldn't select user information for email");
$senderinfo=@mysql_fetch_array($senderresult);
DO
{
$fname=$senderinfo["fname"];
$lname=$senderinfo["lname"];
$salutation=$senderinfo["salutation"];
$from_email["email"];
$venueid1=$senderinfo["venueid"];
$actid1=$senderinfo["actid"];
$from_name=$fname;
$from_name .=" ";
$from_name .=$lname;
}
WHILE($senderinfo=@mysql_fetch_array($senderresult));


if ($venuename)
{
$frombusiness=$venuename;
}
ELSEIF ($actname)
{
$frombusiness=$actname;
}

$from_name .=" ".$frombusiness;
if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET)) 
	{
	

			if ($key=="thisemail")
			{
			$thismedia=$val;
			$mailsql="SELECT * FROM mediaemail WHERE mediaemailid='$thismedia'";
			$mailresult=@mysql_query($mailsql,$connection4) OR DIE ("Couldn't connection for mail");
			$mail=@mysql_fetch_array($mailresult);
			DO
			{
			$to_email=$mail["emailaddress"];
			$to_name=$mail["contactname"]." ".$mail["title"]." ".$mail["businessname"];
			$subject="Events Listing";
			$wholemessage=$addinfo;
			$wholemessage .=$message;
			echo $from_name;
echo "<BR>";
echo $to_name;
			send_mail($to_name, $to_email, $from_name, $from_email, $subject, $wholemessage);
			}
			WHILE ($mail=@mysql_fetch_array($mailresult));

			
			echo "Email sent successfully.";
			}
			ELSE
			{
			}
	
	}
}
?>


