<?PHP
session_start();
require ("functions.php");
displayLMHeader();
?>
	


<?PHP

  if (isset($valid_user))
  {
  displayloginheader("Louisville Music News.net Member Login");
       echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>You are logged in as:<BR><BR> $lmusername <br><BR>$email</td></tr>";
echo "<tr><TD width=\"160\" colspan=\"2\" align=\"center\" ><BR><a href=\"membersonly.php\">Members section</a></td></tr>";
    echo "<tr><TD colspan=\"2\" align=\"center\" width=\"160\" ><a href=\"lmlogout.php\"><BR>Log out</a><br><BR></td></tr>";
return;
  }
ELSE
  {
     if (isset($lmusername) AND isset($password))
     {
include ("/inks/LMhdrw.inc");
  // if the user has just tried to log in

include("/inks/LMhdrw.inc");
       $sql5 = "select count('user_name'), email, user_id from lmuser where (user_name='$lmusername' and password=PASSWORD('$password'))
group by user_name";
       $result = @mysql_query($sql5) or die("couldn't execute login query.");
       $thisrow = @mysql_fetch_array($result);

              if (($thisrow["0"]) >0 )
              {
                 // if they are in the database register the user id
              $valid_user2 = session_ID();
              $valid_user = $lmusername;
			  $email = ($thisrow["1"]);
			  $user_id = ($thisrow["2"]);
session_register("valid_user");
session_register( "lmusername" );
session_register("email");
session_register("user_id");
//	setcookie( "email", $email, time()+3600*24*365 );

 displayloginheader("Louisville Music News.net Member Login");
       echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>You are logged in as:<BR><BR> $lmusername at<br><BR> $email</td></tr>";
echo "<tr><TD width=\"160\" colspan=\"2\" align=\"center\" ><BR><a href=\"membersonly.php\">Members section</a></td></tr>";
    echo "<tr><TD colspan=\"2\" align=\"center\" width=\"160\" ><a href=\"lmlogout.php\"><BR>Log out</a><br><BR></td></tr>";
return;


	           }
			   ELSE
			   {
			   Echo "You are not registered.";
			   }
        }
        Else
        {
        displayloginheader("Louisville Music News.net Member Login");
           if (isset($lmusername) & ($newreg=="y"))
           {
              echo "  <form method=\"post\" action=\"lmauthmain.php\">";
           echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\"><BR>Thanks for registering. <BR>Type in your password again <BR>to log in.<BR><BR></td></tr>";
		echo "      <TR><td width=\"240\" height=\"25\" align=\"center\"><BR>Password</td></tr>\n";
		echo "      <TR><td width=\"240\" height=\"25\" colspan=\"2\" align=\"center\"><input type=\"password\" name=\"password\" size=\"20\" maxlength=\"12\"></td></tr>\n";
		echo "    </tr>\n";
		echo "     <TR> <td width=\"240\" height=\"25\" align=\"center\" colspan=\"2\"><BR><input type=\"submit\" value=\"  Log In  \"><BR></td></tr>\n";
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
           echo "  <form method=\"post\" action=\"lmauthmain.php\">";
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
		echo "      <td width=\"160\" height=\"25\" align=\"left\" ><input type=\"submit\" value=\"  Log In  \"></td>\n";
		echo "    </tr>\n";
		echo "  </form>\n";
		echo "  </table>\n"; 
		echo "  </center>\n";
		echo "</div>\n";
		echo "<p align=\"center\"><b>Not Signed Up Yet?&nbsp; <BR><a href=\"lmregister.php\">Click here to register</a>!</b></p>\n";
		echo "<p align=\"center\"><b><a href=\"recoverpass.php\">Forget your password?</a></b></p>\n";
		echo "<p align=\"center\"><a href=\"javascript:history.back()\"><b>Back</b></a></p>\n";
		
		}
   }
 }
 }
?>
<br>





