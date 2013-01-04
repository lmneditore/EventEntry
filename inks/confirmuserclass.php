<? session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
 session_start();
//confirmcontributorclass.php
//trinitywebmanager ver 1.0
//last update 2004/10/05

class userlogin 
{
var $user_name;
var $password;
	function confirmuser($user_name,$password)
	{
		    $connection="../inks/LMHeader.inc";
			include($connection);
			$sql="SELECT persons.email, persons.user_id from persons where (persons.user_name='$user_name')";
			$result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
			$numrows=@mysql_num_rows($result);
			if ($numrows<1)
			{
				$message="You are not registered under this username and password. Click the 'Retry' button to enter your correct username and password or click the 'Register' button to register.";
				$message .="<BR>\$value=\"Retry\";<BR>\$name=\"\";<BR>\$OnClick=\"\$PHP_SELF\";<BR>";
				$message .="\$buttons->lmnbutton(\$value,\$name,\$OnClick,\$windowlocation);";
				$message .="<BR>\$value=\"Register\";<BR>\$name=\"\";<BR>\$OnClick=\"lmregister.php\";<BR>";
				$message .="\$buttons->lmnbutton(\$value,\$name,\$OnClick,\$windowlocation);";
				return $message;
				
			}
			ELSE 
			{
				$this->checkpassword($password,$user_name);
			}
			
	}// end of confirmuser function
	
	function register($user_name,$password)
	{
		
		
	}
	function checkpassword($password, $user_name)
	{
		$sql="SELECT persons.email, persons.user_id from persons where (persons.user_name='$user_name')";
		$thisrow = @mysql_fetch_array($result);
				$this->email=$thisrow["email"];
			   $this->user_id=$thisrow["user_id"];
	}
}//End of confirmcontributor class
?>