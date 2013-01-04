<?PHP
	$class="libraryclass";
function __autoload($class)
{
    include($class . '.php');
    // Check to see whether the include declared the class
    if (!class_exists($class, false)) {
        trigger_error("Unable to load class: $class", E_USER_WARNING);
    }
}
if (class_exists($class)) {
    $library=new library();
}
$library=new library();
	//if( isset( $HTTP_COOKIE_VARS['lmusername'] ) ) setcookie( "lmusername", "", time()-3600 );

	if( isset( $_action ) )
	{
	
		if( $_action == "Register" )
		{
			$lmusername = trim( $lmusername );
			$email = trim( $email );
			$password = trim( $password );
			$repassword = trim( $repassword );
			$tel = trim( $tel );
			$fax = trim( $fax );
			$city = trim( $city );
			$state = trim( $state );

			if( $lmusername == "" ) error( "User name required" );
			if( $email == "" ) error( "E-mail required" );
			elseif ( !eregi( "^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $email ) ) error( "Invalid e-mail, please check your spelling" );
					
			if( $password == "" ) error( "Password required" );
			if( $repassword == "" ) error( "Please re-enter your password again" );
			if( $password != $repassword ) error( "Two passwords don't match" );
			if( $tel =="") error("Please enter a contact phone number");
				$library->displayLMHeader( "Confirm Your Registration" );
				
			echo "<p align=\"center\"><font size=\"4\">Confirm Your Information</font></p>\n";
			echo "<div align=\"center\">\n";
			
			
					echo "<table align=\"center\">\n";
		echo "  <tr><td align=\"center\" colspan=\"2\">\n";

		echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"400\" align=\"left\">\n";
		echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"> <b>UserName:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"lmusername\" size=\"20\" maxlength=\"20\" value=\"$lmusername\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>E-mail:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"email\" size=\"20\" maxlength=\"40\"  value=\"$email\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>Password: &nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"password\" name=\"password\" size=\"20\" maxlength=\"40\" value=\"$password\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>Telephone:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"tel\" size=\"20\" maxlength=\"40\" value=\"$tel\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>City:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"city\" size=\"20\" maxlength=\"40\" value=\"";
      if ($city == "")
	  {
	  echo "Not entered\"></td></tr>\n";
	  }
	  else
	  {
	  echo $city;
	  	    echo "\"></td></tr>\n";
	  }

		echo "<tr><td width=\"250\" height=\"30\" align=\"right\"><b>State:&nbsp;</b></td>\n";
		echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"state\" size=\"20\" maxlength=\"40\" value=\"";
		if ($state == "")
		{
		  echo "Not entered\"></td></tr>\n";
		  }
		   else
	  {
	  echo $state;
	  	    echo "\"></td></tr>\n";
	  }
      echo "    <tr>\n";
	    echo "      <td width=\"250\" height=\"30\" align=\"right\"><b>Fax:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"fax\" size=\"20\" maxlength=\"40\" value=\"";


if ( $fax == "" )
{
  echo "Not entered\"></td></tr>\n";
}
Else
{
 echo $fax;
 	  	    echo "></td></tr>\n";
}
	    echo " <tr><TD colspan=\"2\" align=\"center\">";
			
			        echo "      <form method=\"post\" action=\"$PHP_SELF?action=confirm\">\n";
	        echo "      <input type=\"hidden\" name=\"lmusername\" value=\"$lmusername\">\n";
	        echo "      <input type=\"hidden\" name=\"email\" value=\"$email\">\n";
	        echo "      <input type=\"hidden\" name=\"password\" value=\"$password\">\n";
	        echo "      <input type=\"hidden\" name=\"city\" value=\"$city\">\n";
	        echo "      <input type=\"hidden\" name=\"state\" value=\"$state\">\n";
	        echo "      <input type=\"hidden\" name=\"tel\" value=\"$tel\">\n";
	        echo "      <input type=\"hidden\" name=\"fax\" value=\"$fax\">\n";
	        echo "      <input type=\"hidden\" name=\"url\" value=\"$url\">\n";
	        echo "      <input type=\"submit\" value=\"    Register Now    \"><input type=\"button\" value=\"    Back    \" onClick=\"history.back()\">\n";
echo "</td></tr></table>";
	        echo "      </form></td>\n";
			


			echo "  </center>\n";
			echo "</div>\n";

			

		}
		else if( $_action == "confirm" )
		{
			include("/inks/LMhdrw.inc");
			$result = mysql_query( "SELECT user_name FROM lmuser WHERE user_name='$lmusername'" ) or error( mysql_error() );
				if( mysql_num_rows( $result ) >= 1 ) 
				{echo "Sorry, you have already registered with us" ;
				}
				ELSE
				{
			$time = time();
			$ip = $REMOTE_ADDR;
$result3 = mysql_query("INSERT INTO lmuser ( user_name, email, password, tel, fax, city, state, ip, member_date, lastup_date )
			VALUES ( '$lmusername', '$email', PASSWORD('$password'), '$tel', '$fax', '$city', '$state', '$ip', $time, $time)" ) or error( mysql_error() );
$lmid=(mysql_insert_id());
$result4=mysql_query("INSERT INTO pbk ( pidmain, pwd) VALUES ('$lmid','$password')")  or error( mysql_error() ); 


			$message = "<pre>Hello $lmusername, thank you for registering with us.\n\n";
			$message .= "Your login e-mail is: $email\n";
			$message = "Your login username is: $lmusername\n";
			$message .= "Your password is: $password\n\n";
			$message .= "Yours,\n\n";
			$message .= "Editor, Louisville Music News\n";
			$message .= "Please visit us <a href=\"http://www.louisvillemusicnews.com\">www.louisvillemusicnews.com</a></pre>";

			sentMail( "Louisville Music News <admin@louisvillemusicnews.net>", $email, "Thank you for registering with us", $message );

			displayLMHeader( "Registration Successful" );
			echo "<p align=\"center\"><font size=\"4\">Thank you, $lmusername</font></p>\n";
			echo "<p align=\"center\">You will receive an e-mail confirming your membership shortly.</p>\n";
			echo "<p align=\"center\"><a href=\"lmauthmain.php?lmusername=$lmusername&newreg=y\"><b>Click here to login</b></a></p>\n";
			}
		}
	}
	else
	{
		
		session_start();
		if( session_is_registered( "username" ) ) session_unregister( "lmusername" );
	if( session_is_registered( "password" ) ) session_unregister( "password" );
//	if(session_is_registered("email")) session_unregister("email");
		displayLMHeader( "Basic Member Registration" );
	
		echo "<div align=\"center\">\n";
		echo "  <center>\n";

		echo "  </center>\n";
		echo "</div>\n";
		echo "<p align=\"center\"><font size=\"4\">Enter Your Information</font></p>\n";
		

		echo "<table align=\"center\">\n";
		echo "  <tr><td align=\"center\" colspan=\"2\">\n";

		echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"400\" align=\"left\">\n";
		echo "  <form method=\"post\" action=\"$PHP_SELF?action=register\">\n";
		echo "    <tr><td  colspan=\"2\" align=\"center\"><small><b>(* indicates an optional field)</b></small></td></tr>\n";
		echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>UserName:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"lmusername\" size=\"20\" maxlength=\"20\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>E-mail:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"email\" size=\"20\" maxlength=\"40\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>Password: &nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"password\" name=\"password\" size=\"20\" maxlength=\"40\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>Password again:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"password\" name=\"repassword\" size=\"20\" maxlength=\"40\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>Telephone:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"tel\" size=\"20\" maxlength=\"40\"></td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>City:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"city\" size=\"20\" maxlength=\"40\">*</td></tr>\n";
	    echo "    <tr><td width=\"250\" height=\"30\" align=\"right\"><b>State:&nbsp;</b></td>\n";
		echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"state\" size=\"20\" maxlength=\"40\">*</td>\n";
	 	echo "    </tr>\n";
	    echo "    <tr>\n";
	    echo "      <td width=\"250\" height=\"30\" align=\"right\"><b>Fax:&nbsp;</b></td>\n";
	    echo "      <td width=\"250\" height=\"30\"><input type=\"text\" name=\"fax\" size=\"20\" maxlength=\"40\">*</td>\n";
	    echo "    </tr></table>\n";
	    echo "<tr><TD>";
	    echo "<td width=\"100%\" height=\"30\" colspan=\"1\" align=\"center\"><input type=\"submit\" value=\"  Register  \"><input type=\"reset\" value=\"  Clear  \"></td>\n";
	    echo "    </tr>\n";
		echo "  </form>\n";
		echo "  </table></td></tr>\n";
		echo "      <td width=\"90%\" align=\"left\"><b>Notes:</b>\n";
		echo "      <ul><li>Enter your username and password carefully, <BR>as they will be required for you to log in.</li>\n";
		echo "      <li>Your password must be between <b>6 </b> and <b>12</b> characters in length. The password is <b>case sensitive.</b></li>\n";
		echo "      <li>Record your password in a secure place.</li></ul>\n";
				echo "<td></td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"400\" align=\"center\"><tr>\n";
		echo "      </td>\n";
		
		echo "    </tr></table>\n";
		echo "  </center>\n";
		echo "</div>\n";
		echo "<tr><td><p align=\"center\"><a href=\"javascript:history.back();\"><b>Back</b></a> | <a href=\"index.php\"><b>Home</b></a></p>\n";
		echo " </td></tr> </table>\n";
	}
?>