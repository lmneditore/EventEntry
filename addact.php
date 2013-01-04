<?PHP
session_start();
$useremail=$email;
$lmuser=$user_id;
require ("functions.php");?>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/webmanager/classes/lmstyles.css" TYPE="text/css">



<?PHP


    function CheckEmail($emailaddress)
    {

  if (ereg("^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$", $emailaddress))
  {return true;
   }
   else 
   {
   return false;
   }
      }
function reqnote()
{
echo "<DIV style=\"color:red; font-size: 10px;\"><I>&nbsp;(required field)</i></div>";
}
if ($_action=="Resubmit")
{$_action="Enter New";}
?>

</head>
<body bgcolor="#0F3925">
<?PHP
displayLMHeader($title = "Louisville Music News.net Online Act Editing");
if ($valid_user)//valid user (1)
{
   IF ($_action=="Add")
    {
?>
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<TH class="searchhdr" colspan="2">Basic Act Information input by <?PHP echo $valid_user;?> at <?PHP echo $email;?> </th>
<FORM action="<?PHP $PHP_SELF;?>" bgcolor="#f5e3a1" method="POST">
<input type="hidden" name="thisactid" value="">
<TR><TD align="right">Act Name: </td><td align="left"><input type="text" name="ActName1" size="60" value="" title="Enter act name as it should be used in public announcements." ><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Mail Address: </td><td align="left"><input type="text" name="MailAddress1" size="60" title="Not for public display"></td></tr>
<TR><TD align="right">Secondary Address: </td><td align="left"><input type="text" name="SecondaryAddress1" size="60" title="Not for public display"></td></tr>
<TR><TD align="right">City: </td><td align="left"><input type="text" name="City1" size="60" value=""><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">State: </td><td align="left"><input type="text" name="State1" size="2" value=""><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Zip: </td><td align="left"><input type="text" name="PostalCode1" size="14" ></td></tr>
<TR><TD align="right">Act Public Phone: </td><td align="left"><input type="text" name="publiccontactphone1" size="14" value="" title="Enter number to be used in public announcements."></td></tr>
<TR><TD align="right">Phone For Verification: </td><td align="left"><input type="text" name="phone4verification1" size="14"  value="
<?PHP if ($venueid)
{
echo $venuephone;
session_register($venuephone);
}?>
" title="For use by Louisville Music News.net only"><?PHP reqnote(); ?></td></tr>
<?PHP if ($validact) 
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="<?PHP echo $email;?>" size="<?PHP echo strlen($email);?>" title="Email Address to use for return address" READONLY></td></tr>
<?PHP}
ELSE
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="" size="35" title="Email Address to use for return address"></td></tr>

<?PHP}?>
<tr><TD Colspan="2" align="center"><INPUT TYPE="Button" VALUE="Cancel" onClick="history.go(-1)">&nbsp;&nbsp;<input type="submit" name="submit" value="Enter New"></td></tr>
</form>
</table>
<?PHP
} //$_action A
ELSEIF ($_action=="Enter New")
{
   if ($_POST)
{
reset ($_POST);
   while (list ($key, $val) = each ($_POST)) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname=$key;
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="red";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
           ElSE
          {
          $textcolor="blue";
          $$thiskeycolor=$textcolor;
          $$thiskeylength=$thiskeylen;
          }
   }
}

   //$errors=array();
   if ($ActName1=="")
   {
      if ($errors)
	  {
   $errors=array_merge($errors,array($ActName1=>"This field must be completed."));
    $ActName1="This field must be completed.";
      }
	 ELSE
	 {
	 $errors=array($ActName1=>"This field must be completed.");
	 $ActName1="This field must be completed.";
	 }
   }
   if ($City1=="")
   {
      if ($errors)
      {$errors=array_merge( $errors,array($City1=>"This field must be completed."));
	  	  $City1="This field must be completed.";
       }
	   ElSE
	   {
	   $errors=array($City1=>"This field must be completed.");
       $City1="This field must be completed.";
	   }
   }
   if ($State1=="")
   {
      if ($errors)
      {$errors=array_merge( $errors,array($State1=>"This field must be completed."));
	  $State1="This field must be completed.";
      }
	  ELSE
	  {
      $errors=array($State1=>"This field must be completed.");
      $State1="This field must be completed.";
	  }
	}
   IF ($phone4verification1=="")
   { 
         if ($errors)
        {$errors=array_merge( $errors,array($phone4verification1=>"This field must be completed."));
        $phone4verification1="This field must be completed.";
        }
		ELSE
		{
		$errors=array($phone4verification1=>"This field must be completed.");
        $phone4verification1="This field must be completed.";
		}
   }
  IF ($publiccontactphone1)
  {
  $contactlen=strlen($publiccontactphone1);
       if($contactlen==7)
       {
 $publiccontactphone1=substr($publiccontactphone1,0,3)."-".substr($publiccontactphone1,3,4);
	   }
   }
  $State1=strtoupper($State1);

if ($errors)
{$_actionvalue="Enter New";
$hdrvalue="Act Information Correction";}
ELSE
{$_actionvalue="Accept";
$hdrvalue="Act Information Confirmation";}

?>
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<TH class="searchhdr" colspan="2"><?PHP echo $hdrvalue;?> </th>
<FORM action="<?PHP $PHP_SELF;?>" bgcolor="#f5e3a1" method="POST">
<input type="hidden" name="thisactid" value="">
<TR><TD align="right">Act Name: </td><td align="left"><input type="text" name="ActName1" title="Enter act name as it should be used in public announcements." value="<?PHP echo $ActName1;?>" size="<?PHP echo $ActName1len;?>" style="color:<?PHP echo $ActName1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Mail Address: </td><td align="left"><input type="text" name="MailAddress1" title="Not for public display" style="color:<?PHP echo $MailAddress1color;?>" value="<?PHP echo $MailAddress1;?>" size="<?PHP echo $MailAddress1len;?>"></td></tr>
<TR><TD align="right">Secondary Address: </td><td align="left"><input type="text" name="SecondaryAddress1" title="Not for public display" value="<?PHP echo $SecondaryAddress1;?>" size="<?PHP echo $SecondaryAddress1len;?>" style="color:<?PHP echo $SecondaryAddress1color;?>"></td></tr>
<TR><TD align="right">City: </td><td align="left"><input type="text" name="City1"  value="<?PHP echo $City1;?>" size="<?PHP echo $City1len;?>" style="color:<?PHP echo $City1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">State: </td><td align="left"><input type="text" name="State1"  value="<?PHP echo $State1;?>" size="<?PHP echo $State1len;?>" style="color:<?PHP echo $State1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Zip: </td><td align="left"><input type="text" name="PostalCode1" size="14" value="<?PHP echo $PostalCode1;?>" size="<?PHP echo $PostalCode1len;?>" style="color:<?PHP echo $PostalCode1color;?>"></td></tr>
<TR><TD align="right">Act Public Phone: </td><td align="left"><input type="text" name="publiccontactphone1" size="<?PHP echo $publiccontactphone1len;?>" value="<?PHP echo $publiccontactphone1;?>" title="Enter number to be used in public announcements." style="color:<?PHP echo $publiccontactphone1color;?>"></td></tr>
<TR><TD align="right">Phone For Verification: </td><td align="left"><input type="text" name="phone4verification1" value="<?PHP echo $phone4verification1; ?>" title="For use by Louisville Music News.net only" size="<?PHP echo $phone4verification1len;?>" style="color:<?PHP echo $phone4verification1color;?>"><?PHP reqnote(); ?></td></tr>

<?PHP if ($validact) 
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="<?PHP echo $email;?>" size="<?PHP echo strlen($email);?>" title="Email Address to use for return address" READONLY></td></tr>
<?PHP}
ELSE
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="<?PHP echo $EMailAddress1;?>" size="<?PHP echo strlen($EMailAddress1);?>" title="Email Address to use for return address"></td></tr>

<?PHP}?>
<tr><TD Colspan="2" align="center"><INPUT TYPE="Button" VALUE="Cancel" onClick="history.go(-2)">&nbsp;&nbsp;<INPUT TYPE="Button" VALUE="Back One" onClick="history.go(-1)">&nbsp;&nbsp;<input type="submit" name="submit" value="Resubmit">&nbsp;<input type="submit" name="submit" value="<?PHP echo $_actionvalue;?>"></td></tr>
</form>
<?PHP}
ELSEIF ($_action=="Accept") // submit C
{
	     Include ("/inks/LMHeader.php");
     $sql6="SELECT MAX(ActID) as MAXIMUM FROM Acts WHERE 1";
      $result=@mysql_query($sql6) or die("couldn't execute maxactid query.");
      $actid=@mysql_fetch_array($result);
	  if (strlen($actid["MAXIMUM"])<6)
	  {
      $maxactid=($actid["MAXIMUM"]+100001);
	  }
	  ELSE
	  {$maxactid=($actid["MAXIMUM"]+1);
	  }

// put form with information to insert
//Insert info into acts table
$sql7="INSERT INTO Acts VALUES ('$maxactid','$ActName1','$MailAddress1','$SecondaryAddress1','$City1','$State1','$PostalCode1','$EMailAddress1',' $publiccontactphone1','$phone4verification1','','','',0,0,0,0,2,'$lmuser')";

$resultact= @mysql_query($sql7) or die("couldn't insert new act information.");
$sql8="Select ActName, MailAddress, SecondaryAddress, City, State, PostalCode, EMailAddress,publiccontactphone,phone4verification, ActID
FROM Acts
WHERE ActID='$maxactid'";
$resultact= @mysql_query($sql8) or die("couldn't select new act information.");
$actinfo=mysql_fetch_array($resultact);
$ActName1=$actinfo["ActName"];
$ActName1len=strlen($ActName1);
$MailAddress1=$actinfo["MailAddress"];
$MailAddress1len=strlen($MailAddress1);
$SecondaryAddress1=$actinfo["SecondaryAddress"];
$SecondaryAddresslen=strlen($SecondaryAddress1);
$City1=$actinfo["City"];
$City1len=strlen($City1);
$State1=$actinfo["State"];
$State1len=strlen($State1);
$PostalCode1=$actinfo["PostalCode"];
$PostalCode1len=strlen($PostalCode1);
$publiccontactphone1=$actinfo["publiccontactphone"];
$publiccontactphone1len=strlen($publiccontactphone1);
$phone4verification1=$actinfo["phone4verification"];
$phone4verification1len=strlen($phone4verification1);
$EMailAddress1=$actinfo["EMailAddress"];
$thisactid=$actinfo["ActID"];
$hdrvalue="New Act Information Entered!";


$actmessage=" A new act has been added to the Louisville Music database:<BR>";

$actmessage .="Act Name: <B>".$ActName1."<BR></b>";
$actmessage .="Act MailAddress: <B>".$MailAddress1."<BR></b>";
$actmessage .="Secondary Address: <B>".$SecondaryAddress1."<BR></b>";
$actmessage .="City: <B>".$City1."<BR></b>";
$actmessage .="State: <B>".$State1."<BR></b>";
$actmessage .="Zip: <B>".$PostalCode1."<BR></b>";
$actmessage .="Public Phone: <B>".$publiccontactphone1."<BR></b>";
$actmessage .="Phone for Verification: <B>".$phone4verification1."<BR></b>";
$actmessage .="Email address: <B>".$EMailAddress1."<BR></b>";
$actmessage .="This act was added by ".$valid_user. " at ".$email."";

$subject="New Act Added";
$message=$actmessage;
$senderName=$valid_user;
$senderEmail=$email;
$toList="editor@louisvillemusicnews.net";
$actadded=new email ($subject,            // subject
                    $message,// message body
                    $senderName,                   // sender's name
                    $senderEmail,         // sender's email
                    array($toList), // To: recipients
                    ""      // Cc: recipient
                               );
$actadded->send();

?>
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<TH class="searchhdr" colspan="2"><?PHP echo $hdrvalue;?> </th>
<FORM action="<?PHP $PHP_SELF;?>" bgcolor="#f5e3a1" method="POST">
<input type="hidden" name="thisactid" value="<?PHP echo $thisactid;?>">
<TR><TD align="right">Act Name: </td><td align="left"><input type="text" name="ActName1" title="Enter act name as it should be used in public announcements." value="<?PHP echo $ActName1;?>" size="<?PHP echo $ActName1len;?>" style="color:<?PHP echo $ActName1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Mail Address: </td><td align="left"><input type="text" name="MailAddress1" title="Not for public display" style="color:<?PHP echo $MailAddress1color;?>" value="<?PHP echo $MailAddress1;?>" size="<?PHP echo $MailAddress1len;?>"></td></tr>
<TR><TD align="right">Secondary Address: </td><td align="left"><input type="text" name="SecondaryAddress1" title="Not for public display" value="<?PHP echo $SecondaryAddress1;?>" size="<?PHP echo $SecondaryAddress1len;?>" style="color:<?PHP echo $SecondaryAddress1color;?>"></td></tr>
<TR><TD align="right">City: </td><td align="left"><input type="text" name="City1"  value="<?PHP echo $City1;?>" size="<?PHP echo $City1len;?>" style="color:<?PHP echo $City1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">State: </td><td align="left"><input type="text" name="State1"  value="<?PHP echo $State1;?>" size="<?PHP echo $State1len;?>" style="color:<?PHP echo $State1color;?>"><?PHP reqnote(); ?></td></tr>
<TR><TD align="right">Zip: </td><td align="left"><input type="text" name="PostalCode1" size="14" value="<?PHP echo $PostalCode1;?>" size="<?PHP echo $PostalCode1len;?>" style="color:<?PHP echo $PostalCode1color;?>"></td></tr>
<TR><TD align="right">Act Public Phone: </td><td align="left"><input type="text" name="publiccontactphone1" size="<?PHP echo $publiccontactphone1len;?>" value="<?PHP echo $publiccontactphone1;?>" title="Enter number to be used in public announcements." style="color:<?PHP echo $publiccontactphone1color;?>"></td></tr>
<TR><TD align="right">Phone For Verification: </td><td align="left"><input type="text" name="phone4verification1" value="<?PHP echo $phone4verification1; ?>" title="For use by Louisville Music News.net only" size="<?PHP echo $phone4verification1len;?>" style="color:<?PHP echo $phone4verification1color;?>"><?PHP reqnote(); ?></td></tr>

<?PHP if ($validact) 
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="<?PHP echo $email;?>" size="<?PHP echo strlen($email);?>" title="Email Address to use for return address" READONLY></td></tr>
<?PHP}
ELSE
{?>
<TR><TD align="right">Act Email: </td><td align="left"><Input type="text" name="EMailAddress1" value="<?PHP echo $EMailAddress1;?>" size="<?PHP echo strlen($EMailAddress1);?>" title="Email Address to use for return address"></td></tr>

<?PHP}?>
<tr><TD Colspan="2" align="center"><button OnClick="parent.location='http://www.louisvillemusicnews.net/lmn/members/lmlogout.php'" style="background-color: grey">Log Out</button>&nbsp;<input type="submit" name="submit" value="Add More About This Act">
<?PHPif($validvenue)
{?>
&nbsp;&nbsp;<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?validvenue=<?PHP echo $validvenue;?>'" style="background-color: grey">Return To  Venue Events Calendar</button>
<?PHP}?>
</td></tr>
</form>
<?PHP
} 
ELSEIF ($_action=="Add More About This Act")
{
$hdrvalue="Add Additional Information About".$ActName1." ".$thisactid;?>
<FORM action="<?PHP $PHP_SELF;?>" bgcolor="#f5e3a1" method="POST">
<input type="hidden" name="thisactid" value="<?PHP echo $thisactid;?>"
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="0" width="360" align="center" valign="top">
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">

<TH class="searchhdr" colspan="3"><?PHP echo $hdrvalue;?> </th>

<TR><TD align="right">Act Name: </td><td align="left"><input type="text" name="ActName1" title="Act name for public announcements." value="<?PHP echo $ActName1;?>" size="<?PHP echo $ActName1len;?>" style="color:Black" READONLY></td></tr>
<tr><TD align="right">Brief Description: </td><TD align="left"><textarea col="40" rows="5" name="ActBlurb1"></textarea></td></tr>
<?PHP
include ("/inks/LMHeader.php");
$sqlgenre ="SELECT AMGMGID, AMGMainGenre
FROM AMGMainGenre
WHERE 1
ORDER BY AMGMainGenre";
$result = @mysql_query($sqlgenre) or die("couldn't execute Main Genre query.");

While ($thisgenre = @mysql_fetch_array($result))
{
	$genreid= $thisgenre["AMGMGID"];
	$maingenre=$thisgenre["AMGMainGenre"];
	$option_block .= "<OPTION style=\"color:blue;\" value=\"$genreid\" >$maingenre</OPTION>";

}?>
<TR><TD align="right">Main Genre: </td><td align="left"><Select name="AMGMGID1">
<?PHP echo "$option_block"; ?>
</SELECT></td></tr>
<tr><TD colspan="3" align="center"><Input type="submit" name="submit" value="Enter Additional Information"></td></tr>
</form>
<?PHP
}// end of Add More About This Act
ELSEIF ($_action=="Enter Additional Information")
{
include ("/inks/LMHeader.php");
$sqlupdate="UPDATE Acts SET ActBlurb='$ActBlurb1', AMGMusicGenre='$AMGMGID1' WHERE ActID= '$thisactid'";
$result = @mysql_query($sqlupdate) or die("couldn't execute Act Additional Info Update query.");

$sqlcheck="Select Acts.ActName, Acts.ActBlurb, AMGMainGenre.AMGMainGenre FROM Acts
LEFT JOIN AMGMainGenre
ON Acts.AMGMusicGenre=AMGMainGenre.AMGMGID
WHERE ActID='$thisactid'";
$result2 = @mysql_query($sqlcheck) or die("couldn't execute Act Revision select query.");
$actcheck=@mysql_fetch_array($result2);
$ActGenre=$actcheck["AMGMainGenre"];
$ActBlurb=$actcheck["ActBlurb"];
$ActName=$actcheck["ActName"];
$hdrvalue=" Additional Information About ".$ActName." Has Been Added";?>
<FORM action="<?PHP $PHP_SELF;?>" bgcolor="#f5e3a1" method="POST">
<Table bgcolor="#f5e3a1" bordercolor="#f5e3a1" border="1" width="360" align="center" valign="top">
<TH class="searchhdr" colspan="2"><?PHP echo $hdrvalue;?> </th>

<TR><TD align="right">Act Name: </td><td align="left"><input type="text" name="ActName1" title="Act Name" value="<?PHP echo $ActName;?>" size="<?PHP echo $ActName1len;?>" style="color:Black" READONLY></td></tr>
<tr><TD align="right">Brief Description: </td><TD align="left"><textarea col="40" rows="5" name="ActBlurb1" READONLY><?PHP echo $ActBlurb;?></textarea></td></tr>
<TR><TD align="right">Main Genre: </td><td align="left"><input type="text" name="ActGenre1" value ="<?PHP echo $ActGenre;?>" READONLY></td></tr>
<TR><TD colspan="2"><?PHPif($validvenue)
{?>
&nbsp;&nbsp;<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/editthisvenueevents.php?validvenue=<?PHP echo $validvenue;?>'" style="background-color: grey">Return To Venue Events Calendar</button>&nbsp;&nbsp;<button OnClick="parent.location='http://www.louisvillemusicnews.net/eventediting/addact.php?venueid=<?PHP echo $validvenue;?>&submit=Add'" style="background-color: "grey"><font color="black">Add Another Act </button>
<?PHP}?></td></tr>

<?PHP
}// End of Enter Additional Information

ElSEIF ($_action=="Edit Act Info")
{
include ("/inks/LMHeader.php");
$sqledit="Select ActName, MailAddress, SecondaryAddress, City, State, PostalCode, EMailAddress,publiccontactphone,phone4verification, ActID, EMailAddress ; 
FROM Acts
WHERE ActID='$thisactid'";
$result = @mysql_query($sqledit) or die("couldn't execute get actInfo Update query.");
$ActName1=$actinfo["ActName"];
$ActName1len=strlen($ActName1);
$MailAddress1=$actinfo["MailAddress"];
$MailAddress1len=strlen($MailAddress1);
$SecondaryAddress1=$actinfo["SecondaryAddress"];
$SecondaryAddresslen=strlen($SecondaryAddress1);
$City1=$actinfo["City"];
$City1len=strlen($City1);
$State1=$actinfo["State"];
$State1len=strlen($State1);
$PostalCode1=$actinfo["PostalCode"];
$PostalCode1len=strlen($PostalCode1);
$publiccontactphone1=$actinfo["publiccontactphone"];
$publiccontactphone1len=strlen($publiccontactphone1);
$phone4verification1=$actinfo["phone4verification"];
$phone4verification1len=strlen($phone4verification1);


}//End of Edit Act Info

}// end of is valid user
ELSE
{
displaynoauthorization($colspan);
} //end of valid user (1)

?>
</td></tr></table>


