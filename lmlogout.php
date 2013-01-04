<?PHP
session_start();
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

if (class_exists("buttons")==TRUE) {
   }
ELSE
{
	include("classes/buttonsclass.php");
}
$buttons=new buttons;
  $old_user = $valid_user;  // store  to test if they *were* logged in
  $result = session_unregister("valid_user");
  session_destroy();
$loginheader="Click the 'Log In' button to login again.";
$library->displayloginheader($loginheader);
echo "<DIV align=\"center\">\n";
  if (!empty($old_user))
  {
    if ($result)
    { 
      // if they were logged in and are not logged out 
	  echo "<DIV class=\"thdr\" align=\"center\" width=\"160\"><BR>You are logged out. </DIV>";
    }
    else
    {
     // they were logged in and could not be logged out
	 echo "<DIV class=\"thdr\"  align=\"center\" width=\"160\"><BR>Could not log you out.<br><br><BR></DIV>";
    } 
  }
  else
  {
    // if they weren't logged in but came to this page somehow
echo "<DIV class=\"menu\"  align=\"center\" width=\"160\"><BR>You were not logged in, and so have not been logged out.<br><BR></DIV>";
  }
  echo "<DIV class=\"menu\" align=\"center\" width=\"160\"><BR>";
$value="Log In";
$name="_action";
$OnClick="index.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->btndisplay;

  echo "<TR><TD class=\"menu\" colspan=\"2\" align=\"center\" width=\"160\"><BR>";
 $value="Home";
$name="_action";
$OnClick="index.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->btndisplay;
   ?> 
</DIV>



