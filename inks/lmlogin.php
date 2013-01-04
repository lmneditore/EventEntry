<?PHP Session_start();
//setcookie( "", "","" );
require ("functions.php");
displayLMHeader();
?>

<body>
<?PHP 
if (isset($valid_user))
  {
     $loginheader="LouisvilleMusicNews.net Member Login";
  displayloginheader($loginheader);
  
         session_register("valid_user");
		 session_register("email");
		 session_register("lmusername");
		 session_register("user_id");
	//	setcookie( "email", $email, time()+3600*24*365 );
	if( isset( $cat ) ) 
	{
	$continue="list.php?cat=$cat" ;
	}
	Else
	{
	$continue="membersonly.php" ;
	}
  
       echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>You are logged in as:<BR> $valid_user <br>at $email<BR><BR></td></tr>";
echo "<tr><TD width=\"160\" colspan=\"2\" align=\"center\" ><BR>";

$value="Continue";
$name="";
$OnClick=$continue;
$windowlocation="parent.location";
lmnbutton($value, $name,$OnClick,$windowlocation);
echo "</td></tr>";
// echo "<TR><TD width=\"160\" colspan=\"2\" align=\"center\">< a href=\"http://www.louisvillemusicnews.net/lmhdr.php?thisid=\"\">Message Board</a></td></tr>";
//echo "<TR><TD width=\"160\" colspan=\"2\" align=\"center\">< a href=\"http://www.louisvillemusicnews.net/lmhdr.php?thisid=\"\">Event Submission</a></td></tr> ";
echo "<tr><TD colspan=\"2\" align=\"center\" width=\"160\" ><BR>";
$OnClick="http://www.louisvillemusicnews.net/members/lmlogout.php";
$windowlocation="parent.location";
lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
echo "<br><BR></td></tr>";
return;
  }
ELSE
  {
     if (isset($lmusername) AND isset($password))
     {

  // if the user has just tried to log in

      include ("../inks/louisvillemusic_netcnxn.php");
      $cnxn=new lm_netconnection();
      $cnxn=lm_connection("louisvil_louisvillemusic2");
       $sql5 = "select count(*), lmuser.email, lmuser.user_id from lmuser where (lmuser.user_name='$lmusername' and lmuser.password=PASSWORD('$password'))
group by user_name";
       $result = @mysql_query($sql5) or die("couldn't execute login query.");
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
         $loginheader="LouisvilleMusicNews.net Member Login";
 displayloginheader($loginheader);
   
       echo "<TR><TD class=\"menu\" colspan=\"2\" width=\"240\">Welcome! <BR>You are logged in as:<BR><BR> $lmusername <br><BR> at $email</td></tr>";
echo "<tr><TD style=\"text-align :center; width:240;\"><BR>";
$value="Classified Ads";
$name="";
$OnClick="../Classified/account.php";
$windowlocation="parent.location";
lmnbutton($value, $name,$OnClick,$windowlocation);
echo "</td></tr>";
echo "<tr><TD style=\"text-align :center; width:240;\"><BR>";
$value="Registered Members Only";
$name="";
$OnClick="membersonly.php";
$windowlocation="parent.location";
lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<br><BR></td></tr>";

    echo "<tr><TD style=\"text-align :center; width:240;\">";
	$OnClick="http://www.louisvillemusicnews.net/members/lmlogout.php";
	$windowlocation="parent.location";
	lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
	echo "<br><BR></td></tr>";
	return;
	           }
			   ELSE
			   {
			echo "<tr><td colspan=\"2\" align=\"center\"><BR>You are not signed up yet.&nbsp; <BR><BR>";
		$value="Click here to register";
		$name="";
		$OnClick="lmregister.php";
		$windowlocation="parent.location";
		lmnbutton($value, $name,$OnClick,$windowlocation);
		echo "<br><BR>";
		$value="Back";
lmbackup($value);
				Echo "<BR><BR></td></tr>\n";
			   }
        }
        Else
        {
            $loginheader="LouisvilleMusicNews.net Member Login";
        displayloginheader($loginheader);
           if (isset($lmusername) & ($newreg=="y"))
           {
              echo "  <form method=\"post\" action=\"lmlogin.php\">";
           echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\"><BR>Thanks for registering. <BR>Type in your password again <BR>to log in.<BR><BR></td></tr>";
		echo "      <TR><td width=\"240\" height=\"25\" align=\"center\"><BR>Password</td></tr>\n";
		echo "      <TR><td width=\"240\" height=\"25\" colspan=\"2\" align=\"center\"><input type=\"password\" name=\"password\" size=\"20\" maxlength=\"12\"></td></tr>\n";
		echo "    </tr>\n";
		echo "     <TR> <td width=\"240\" height=\"25\" align=\"center\" colspan=\"2\"><BR>";

$type="submit";
$name="submit";
$value="Log in";
$OnClick="";
inputbutton($type, $name, $value,$OnClick);
echo "<BR></td></tr>\n";
        unset($newreg);
        echo "</Form>";

           }
           Else
           {
		   If (isset($lmusername) and !isset($password))
		   {
           // if they've tried and failed to log in
           echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\"><BR>You didn't enter a password.<BR><BR></td></tr>";
           }
           else 
           {
            // they have not tried to log in yet or have logged out
           echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\"><BR>You are not logged in.<BR><BR></td></tr>";
              // provide form to log in 
           echo "  <form method=\"post\" action=\"lmlogin.php\">";
		echo "      <TR><td width=\"80\" height=\"25\"><BR>User Name</td>\n";
		echo "      <td width=\"160\" height=\"25\"><BR><input type=\"text\" name=\"lmusername\" value=\"$lmusername\" size=\"20\" maxlength=\"50\"></td>\n";
		echo "    </tr>\n";
		echo "    <tr>\n";
		echo "    <tr>\n";
		echo "      <td width=\"80\" height=\"25\">Password</td>\n";
		echo "      <td width=\"160\" height=\"25\"><input type=\"password\" name=\"password\" value =\"$password\" size=\"20\" maxlength=\"12\"></td>\n";
		echo "    </tr>\n";
		
		echo "    <tr>\n";
				echo "      <td width=\"80\" height=\"25\"></td>\n";
		echo "      <td width=\"120\" height=\"25\" align=\"center\" >";
		$type="submit";
	$name="submit";
	$value="Log in";
	$OnClick="";
	inputbutton($type, $name, $value,$OnClick);
		
		echo " </td> </tr>\n";
		echo "  </form>\n";
		echo "  </table>\n"; 
		echo "  </center>\n";
		echo "</div>\n";
		echo "<p align=\"center\"><b>Not Signed Up Yet?&nbsp; <BR>";
		$value="Click here to register!";
		$name="";
		$OnClick="lmregister.php";
		$windowlocation="parent.location";
		lmnbutton($value, $name,$OnClick,$windowlocation);
		echo "</b></p>\n";
		echo "<p align=\"center\"><b><a href=\"recoverpass.php\">Forget your password?</a></b></p>\n";
		echo "<p align=\"center\">";
		$value="Back One";
		lmbackup($value);
		echo "</p>\n";
		
		}
   }
 }
 }
?>
</body>
</html>