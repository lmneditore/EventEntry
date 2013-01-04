<?PHP Session_start();
//setcookie( "", "","");
//include("functions.php");
//include("louisvillemusic_netcnxn.php");
//include("buttonsclass.php");
//$buttons=new buttons;
//$cnxn=new lm_netconnection;
//$cnxn->lm_connection("louisvil_louisvillemusic2");
?>
<BODY>
<HEAD>
<script language="JavaScript"type="text/javascript">
<?PHP include ("lmnformvalidation.js");
?>

</script>
 <script language="JavaScript"type="text/javascript">
if (!navigator.javaEnabled())
{
alert("You must have Javascript enabled to access this login page. Please click the button below to continue.");
<?PHP
	$value="Continue";
	$name="redirect";
	$OnClick="http://www.louisvillemusicnews.net";
	$windowlocation="window.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	echo $buttons->button;
	?>
}
</script>  
</head>
<?PHP
if (isset($valid_user))
  {
  $library->displayloginheader("Louisville Music News.new Member Login");
  $library->display;
           	 session_register("valid_user");
		 session_register("email");
		 session_register("lmusername");
		 session_register("user_id");
	//	setcookie( "email", $email, time()+3600*24*365 );
	if( isset( $cat ) ) 
	{
	$continue="list.php?cat=$cat";
	}
	Else
	{
	$continue="membersonly.php";
	}
	echo "<TR><TD class=\"menu\"colspan=\"2\"align=\"center\"width=\"160\"><BR>You are logged in as:<BR>".$valid_user."<br>at ".$email."<BR><BR></td></tr>";
	echo "<tr><TD width=\"160\"colspan=\"2\"align=\"center\"><BR>";
	$value="Continue";
	$name="";
	$OnClick=$continue;
	$windowlocation="parent.location";
	$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	echo $buttons->button;
	echo "</td></tr>";
	echo "<tr><TD colspan=\"2\"align=\"center\"width=\"160\"><BR>";
	$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
	echo $buttons->button;
	echo "<br><BR></td></tr>";
	return;
  }
ELSE
  {
     if (isset($lmusername) AND isset($password))
     {
  // if the user has just tried to log in and lmuser.password=MD5('$password')
      //include ("/inks/LMhdrw.inc");
	       $hashpw=md5(".$password.");
	       $sql5 = "select count(*), lmuser.email, lmuser.user_id from lmuser where (lmuser.user_name='".$lmusername."' and lmuser.password='".$hashpw."') group by user_name";
	       $result = @mysql_query($sql5) or die("couldn't execute login query.".$sql5."");
	       $thisrow = @mysql_fetch_array($result);
		      if (($thisrow["0"]) >0 )
              {
                 // if they are in the database register the user id
		$valid_user=$lmusername;
		$email = $thisrow["email"];
		$user_id = $thisrow["user_id"];
		session_register("valid_user");
		session_register("email");
		session_register("user_id");
		$library->displayloginheader("Louisville Music News.net Member Login");
		echo "<TR><TD class=\"menu\"colspan=\"2\"width=\"240\">Welcome! <BR>You are logged in as:<BR><BR> $lmusername <br><BR> at $email</td></tr>";
		echo "<tr><TD style=\"text-align :center; width:240;\"><BR>";
		$value="Classified Ads";
		$name="";
		$OnClick="../Classified/account.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
		echo $buttons->button;
		echo "</td></tr>";
		echo "<tr><TD style=\"text-align :center; width:240;\"><BR>";
		$value="Registered Members Only";
		$name="";
		$OnClick="membersonly.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
		echo $buttons->button;
		echo "<br><BR></td></tr>";
		echo "<tr><TD style=\"text-align :center; width:240;\">";
		$OnClick="http://www.louisvillemusicnews.net/lmn/members/lmlogout.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
		echo $buttons->button;
		echo "<br><BR></td></tr>";
           }
	   ELSE
	   {
		echo "<tr><td colspan=\"2\"align=\"center\"><BR>You are not signed up yet.&nbsp; <BR><BR>";
		$value="Click here to register";
		$name="";
		$OnClick="lmregister.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
		echo $buttons->button;
		echo "<br><BR>";
		$value="Back";
		$buttons->lmbackup($value);
		$buttons->$btndisplay;
		Echo "<BR><BR></td></tr>\n";
	   }
        }
        Else
        {
        $library->displayloginheader("Louisville Music News.net Member Login");
	echo $library->display;
           if (isset($lmusername) & ($newreg=="y"))
           {
		echo "<form method=\"post\"action=\"lmlogin.php\">";
		echo "<table align=\"center\"><TR><TD class=\"menu\"colspan=\"2\"align=\"center\"><BR>Thanks for registering. <BR>Type in your password again <BR>to log in.<BR><BR></td></tr>";
		echo "<TR><td width=\"240\"height=\"25\"align=\"center\"><BR>Password</td></tr>\n";
		echo "<TR><td width=\"240\"height=\"25\"colspan=\"2\"align=\"center\"><input type=\"password\"name=\"password\"size=\"20\"maxlength=\"12\"></td></tr>\n";
		echo "</tr>\n";
		echo "<TR> <td width=\"240\"height=\"25\"align=\"center\"colspan=\"2\"><BR>";
		$type="submit";
		$name="submit";
		$value="Log In";
		$OnClick="";
		$buttons->inputbutton($type, $name, $value,$OnClick);
		$buttons->button;
		echo "<BR></td></tr>\n";
		unset($newreg);
		echo "</Form>";
           }
           Else
           {
		   If (isset($lmusername) and !isset($password))
		   {
	// if they've tried and failed to log in
		   echo "<TR><TD class=\"menu\"colspan=\"2\"align=\"center\"><BR>You didn't enter a password.<BR><BR></td></tr>";
		   }
		   else 
		   {
 // they have not tried to log in yet or have logged out
 		echo "<TR><TD class=\"menu\"colspan=\"2\"align=\"center\"><BR>You are not logged in.<BR><BR></td></tr>";
		 // provide form to log in 
		echo "<form method=\"post\"action=\"lmlogin.php\">";
		echo "<TR><td width=\"80\"height=\"25\"><BR>User Name</td>\n";
		echo "<td width=\"160\"height=\"25\"><BR><input type=\"text\"name=\"lmusername\"value=\"".$lmusername."\"size=\"20\"maxlength=\"50\"></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<tr>\n";
		echo "<td width=\"80\"height=\"25\">Password</td>\n";
		echo "<td width=\"160\"height=\"25\"><input type=\"password\"name=\"password\"value =\"".$password."\"size=\"20\"maxlength=\"12\"></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td width=\"80\"height=\"25\"></td>\n";
		echo "<td width=\"120\"height=\"25\"align=\"center\">";
		$type="submit";
		$name="submit";
		$value="Log In";
		$OnClick="";
		$buttons->inputbutton($type, $name, $value,$OnClick);
		$buttons->button;
		echo "</td> </tr>\n";
		echo "</form>\n";
		echo "</table>\n"; 
		echo "</center>\n";
		echo "</div>\n";
		echo "<p align=\"center\"><b>Not Signed Up Yet?&nbsp; <BR>";
		$value="Click here to register!";
		$name="";
		$OnClick="lmregister.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
		echo $buttons->button;
		echo "</b></p>\n";
		echo "<p align=\"center\"><b><a href=\"recoverpass.php\">Forget your password?</a></b></p>\n";
		echo "<p align=\"center\">";
		$value="Back One";
		$buttons->lmbackup($value);
		$buttons->$btndisplay;
		echo "</p>\n";
	   }
   }
 }
 }


?>

