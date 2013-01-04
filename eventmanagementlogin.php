<?PHP Session_start();
//setcookie( "", "","");
$class="library";
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
$buttons=new buttons();
?>
<?PHP
if (isset($valid_user))
 {
 
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
	echo "<div class=\"menu\"><BR>You are logged in as:<BR>".$valid_user." at ".$email."<BR></div>";
	echo "<div class=\"menu\"><BR>";
	$formname="membersform";
	$name="_action";
	$value="Members";
	$onclick="index.php";
	$windowlocation="parent.location";
	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	echo $buttons->button;
	echo "</div>";
	echo "<div class=\"menu\"><BR>";
	$formname="Log Out";
	$name="_action";
	$value="Log Out";
	$onclick="index.php";
	$formnmae="parent.location";
	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	echo $buttons->button;
	echo "<BR>";
	return;
 }
ELSE
 {
   if (isset($lmusername) AND (isset($password) || $password<>""))
   {

 // if the user has just tried to log in and lmuser.password=MD5('$password')
   //include ("/inks/LMhdrw.inc");
   	$hashpw=(!isset($password) ? "": md5(".$password."));
	    $sql = "select count(*), lmuser.email, lmuser.user_id, status from lmuser where (lmuser.user_name='".$lmusername."' and lmuser.password='".$hashpw."') group by user_name";
	    $result = @mysql_query($sql) or die("couldn't execute login query.".$sql."");
	    $thisrow = @mysql_fetch_array($result);
	    if (($thisrow["0"]) >0 )
	    {
         // if they are in the database register the user id
	 	$status=$thisrow["status"];
		$valid_user=$lmusername;
		$valid_adminuser=$lmusername;
		$email = $thisrow["email"];
		$user_id = $thisrow["user_id"];
			 if($status==1)
		      {
		     session_register("valid_adminuser");
		      }
		session_register("valid_user");
		session_register("email");
		session_register("user_id");
		$library->displayloginheader("Louisville Music News.net Member Login");
		echo "<div class=\"title\">Welcome! <BR>You are logged in as:<BR> $lmusername <BR> at $email</DIV>";
		echo "<div class=\"menu\"><BR>";
		$value="Classified Ads";
		$name="";
		$onclick="../Classified/account.php";
		$windowlocation="parent.location";
		//$buttons->inputbutton($type, $name, $value, $onclick);
	echo "</div><div class=\"menu\"><BR>";
	$formname="membersform";
	$name="_action";
	$value="Members";
	$onclick="index.php";
	$windowlocation="parent.location";
	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	echo $buttons->button;
	echo "</div>";
	echo "<div class=\"menu\"><BR>";
	$formname="Log Out";
	$name="_action";
	$value="Log Out";
	$onclick="index.php";
	$formnmae="parent.location";
	$buttons->containedmenubutton($value, $name,$formname,$onclick);
	echo $buttons->button;
	echo "</div><div  ><BR></div>";
	return;
		  }
		  ELSE
		  {
		echo "<div class=\"menu\"><BR>You are not signed up yet.&nbsp; <BR>";
		$value="Click here to register";
		$name="";
		$onclick="index.php";
		$windowlocation="parent.location";
		$buttons->lmnbutton($value, $name,$onclick,$windowlocation);
		echo $buttons->button;
		echo "<BR>";
		$value="Back";
		$buttons->lmbackup($value);
		echo $buttons->button;
		Echo "<BR></div>\n";
	  }
    }
    Else
    {
    $library->displayloginheader("Louisville Music News.net Member Login");
	if (isset($lmusername) & ($newreg=="y"))
      {
		echo "<form method=\"post\"action=\"index.php\">";
		echo "<div class=\"title\"  ><BR>Thanks for registering. <BR>Type in your password again <BR>to log in.<BR></div>";
		echo "<div height=\"25\"  ><BR>Password</div>\n";
		echo "<div height=\"25\"  ><input type=\"password\"name=\"password\"size=\"20\"maxlength=\"12\"></div>\n";
		echo " <div height=\"25\"a lign=\"center\"><BR>";
		$type="submit";
		$name="_action";
		$value="Log In";
		$onclick="";
		$buttons->inputbutton($type, $name, $value,$onclick);
		echo $buttons->button;
		echo "<BR></div>\n";
		unset($newreg);
		echo "</Form>";
      }
      Else
      {
		  If (isset($lmusername) and !isset($password))
		  {
	// if they've tried and failed to log in
		  echo "<div class=\"menu\"  ><BR>You didn't enter a password.<BR></div>";
		  }
		  else 
		  {
 // they have not tried to log in yet or have logged out
 		echo "<div class=\"title\"  ><BR>You are not logged in yet.<BR></div>";
		 // provide form to log in 
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"tablebody\"><div style=\"position: relative; float: left; text-align:right; width: 40%; height: 25px;\">User Name: </DIV>\n";
		echo "<div style=\"position: relative; float: left; text-align:left; width: 60%; height: 25px;\"><input type=\"text\" name=\"lmusername\"value=\"".$lmusername."\"size=\"20\"maxlength=\"50\" onchange=\"validate_required(username,You didn\'t enter a username.)\"></DIV>\n";
		echo "<div class=\"tablebody\"><div style=\"position: relative; float: left; text-align:right; width: 40%; height: 25px;\">Password: </DIV>\n";
		echo "<div style=\"position: relative; float: left; text-align:left; width: 60%; height: 25px;\"><input type=\"password\" name=\"password\"value =\"".$password."\"size=\"20\"maxlength=\"12\"></DIV>\n";
		echo "<div width=\"200px\" \" height=\"25\"align=\"center\">";
		$formname="loginform";
		$name="_action";
		$value="Log In";
		$onclick="index.php";
		$buttons->containedmenubutton($value, $name,$formname,$onclick);
		echo $buttons->button;
		echo "</DIV></form></center></div>\n";
		echo "<DIV class=\"menu\"><b>Not Signed Up Yet?&nbsp; <BR>";
		$formname="registerform";
		$value="Register";
		$name="_action";
		$onclick="index.php";
		$windowlocation="parent.location";
		$buttons->containedmenubutton($value, $name,$formname,$onclick);
		echo $buttons->button;
		echo "</b></DIV>\n";
		echo "<DIV class=\"menu\"><b><a href=\"recoverpass.php\">Forget your password?</a></b></DIV>\n";
		echo "<DIV class=\"menu\">";
		$value="Back One";
		$buttons->lmbackup($value);
		//echo $buttons->button;
		echo "</DIV>\n";
	  }
  }
 }
 }
?>

