<?php Session_start();
require ("admincommon.php");
$buttons=new buttons();
foreach($_POST as $key=>$value)
		{$$key=$value;}
displayadminHeader();
?>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/stylesheets/LMStyleswhite.css" TYPE="text/css">	
<html>
<body>
<?php

  if (isset($valid_adminuser) and $valid_adminuser=="lmnguy")
  {
  displayadminheader();
  
		$_SESSION["valid_adminuser"]=$valid_adminuser;
		$_SESSION["email"]=$email;
		$_SESSION["lmusername"]=$lmusername;
		$_SESSION["lmncontributorid"]=$lmcontributorid;
	//	setcookie( "email", $email, time()+3600*24*365 );

  
       echo "<DIV class=\"menu\" colspan=\"2\" align=\"center\" width=\"460\"><BR>You are logged in as:<BR><BR> $lmusername <br><BR>at $email</DIV>";
echo "<DIV width=\"460\" colspan=\"2\" align=\"center\" ><BR>";
//$dothis="http://www.louisvillemusicnews.net/lmn/test/scratch/adminpage1.php";
$value="Continue";
$OnClick="http://www.louisvillemusicnews.net/lmn/test/scratch/adminpage1.php";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->button;
echo "</DIV>";
    echo "<DIV colspan=\"2\" align=\"center\" width=\"460\" >";
$dothis="http://www.louisvillemusicnews.net/lmn/test/scratch/lmlogout.php";
$value="Log Out";
$OnClick=$dothis;
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
 echo $buttons->button;
	//<a href=\"lmlogout.php\"><BR>Log out</a>"
	echo "<br><BR></DIV>";
return;
  }
ELSE
  {
     if (isset($lmusername) AND isset($password))
     {
  // if the user has just tried to log in
       $connection4 = @mysql_connect("louisvillemusicnews.ipowermysql.com", "louisvil", "ar4080!!") or die("couldn't connect");
       $db4 = @mysql_select_db("louisvil_louisvillemusic2") or die("couldn't select user database.");
       $sql5 = "select count(*), email, user_name, status.status_type, status.lmncontributorid  from lmuser 
LEFT JOIN status 
ON lmuser.user_id = status.user_id
where (user_name='$lmusername'  and status_type='1')
group by user_name";
       $result = @mysql_query($sql5) or die("couldn't execute admin login query.");
       $thisrow = @mysql_fetch_array($result);
              if (($thisrow["0"]) >0 )
              {
                 // if they are in the database register the user id
              $valid_adminuser =$lmusername;
              $email = ($thisrow["email"]);
			  $lmncontributorid=($thisrow["lmncontributorid"]);
$_SESSION["valid_adminuser"]=$valid_adminuser;
$_SESSION["username"]=$username;
$_SESSION["email"]=$email;
$_SESSION["lmncontributorid"]=$lmncontributorid;
// displayadminheader();

echo "<DIV class=\"menu\" colspan=\"2\" align=\"center\" ><BR>You are logged in as:<BR><BR> $lmusername <br><BR>at $email</DIV>";
echo "<DIV w colspan=\"2\" align=\"center\" ><BR>";
echo "<DIV  colspan=\"2\" align=\"center\" ><BR>";
$dothis="http://www.louisvillemusicnews.net/lmn/test/scratch/adminpage1.php";
$value="Continue";
$OnClick=$dothis;
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->button;
echo "</DIV>";
    echo "<DIV colspan=\"2\" align=\"center\" >";
$dothis="http://www.louisvillemusicnews.net/lmn/test/scratch/lmadminlogout.php";
$value="Log Out";
$OnClick=$dothis;
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->button;


return;


	           }
			   ELSE
			   {
			   Echo "You are not registered.";
			   }
        }
        Else
        {
       displayadminheader();
           if (isset($lmusername) & ($newreg=="y"))
           {
              echo "  <form method=\"POST\" action=\"lmadminlogin.php\">";
           echo "<DIV class=\"menu\" colspan=\"2\" align=\"center\"><BR>Thanks for registering. <BR>Type in your password again <BR>to log in.<BR><BR></DIV>";
		echo "      <DIV width=\"240\" height=\"25\" align=\"center\"><BR>Password</DIV>\n";
		echo "      <DIV width=\"240\" height=\"25\" colspan=\"2\" align=\"center\"><input type=\"password\" name=\"password\" size=\"20\" maxlength=\"12\"></DIV>\n";
		echo "    </DIV>\n";
		echo "     <DIV> <DIV width=\"240\" height=\"25\" align=\"center\" colspan=\"2\"><BR><input type=\"submit\" value=\"  Log In  \"><BR></DIV>\n";
        unset($newreg);
        echo "</Form>";

           }
           Else
           {
		   If (isset($lmusername) and !isset($password))
		   {
           // if they've tried and failed to log in
           echo "<DIV class=\"menu\" colspan=\"2\" align=\"center\"><BR>You didn't enter a password.<BR><BR></DIV>";
           }
           else 
           {
            // they have not tried to log in yet or have logged out
           echo "<DIV class=\"menu\" style=\"width: 50%; text-align: center;\"align=\"center\"><BR>You are not logged in.<BR><BR></DIV>";
              // provide form to log in 
           echo "  <form method=\"get\" action=\"lmadminlogin.php\">";
		echo "      <DIV  height=\"25\" style=\"text-align: center;\"><b>User Name:</b> </DIV>\n";
		echo "      <DIV  height=\"25\" ><BR><input type=\"text\" name=\"lmusername\" value=\"$lmusername\" size=\"20\" maxlength=\"50\"></DIV>\n";
		echo "    </DIV>\n";
		echo "    <DIV>\n";
		echo "    <DIV>\n";
		echo "      <DIV  height=\"25\" style=\"text-align: center;\"><b>Password: </b></DIV>\n";
		echo "      <DIV height=\"25\"><input type=\"password\" name=\"password\" value =\"$password\" size=\"20\" maxlength=\"12\"></DIV>\n";
		echo "    </DIV>\n";
		echo "    <DIV>\n";
		echo "<DIV height=\"25\" align=\"center\" colspan=\"2\">";
		$value="Log In";
		$buttons->submitbutton($value);
		
        echo "</DIV>\n";
		echo "    </DIV>\n";
		echo "  </form>\n";
			echo "  </center>\n";
		echo "</div>\n";
		//echo "<p align=\"center\"><b><a href=\"recoverpass.php\">Forget your password?</a></b></p>\n";
		echo "<div align=\"center\">";
		echo "<DIV align=\"center\" colspan=\"2\">";
		$dothis="javascript:history.back()";
		$value="Back One";
		$OnClick=$dothis;
		$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
        echo $buttons->button;
		//<a href=\"javascript:history.back()\"><b>Back</b></a>
		echo "</p>\n";
		echo "</DIV>\n";
		echo "    </DIV>\n";
		echo "  </DIV>\n"; 
		}
   }
 }
 }
?>
<br>

</body>
</html>


