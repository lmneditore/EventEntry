<?PHP
session_start();
require ("functions.php");
?>

<?PHP
  $old_user = $valid_user;  // store  to test if they *were* logged in
  $result = session_unregister("valid_user");
  session_destroy();
?>


<?PHP displayloginheader("Louisville Music News.net Member Logout");?>

<?PHP 
  if (!empty($old_user))
  {
    if ($result)
    { 
      // if they were logged in and are not logged out 
	  echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>You are logged out. <br><BR></td></tr>";

    }
    else
    {
     // they were logged in and could not be logged out
	 echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>Could not log you out.<br><br><BR></td></tr>";

    } 
  }
  else
  {
    // if they weren't logged in but came to this page somehow
echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>You were not logged in, and so have not been logged out.<br><BR></td></tr>";

  }
  echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR><a href=\"lmauthmain.php\">Back to main page</a><br><BR></td></tr>";
?> 

</table>
</table>


