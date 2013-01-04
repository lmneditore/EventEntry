<?PHP session_start(); 
 include ("classes/actinfomgrclass.php");
 $act=new actinfo();
 $act->manageactinfo($ActID, $_action);
 echo $act->adisplay;
 $act->actbuttons($_action,$ActID);
 echo $act->bdisplay;

    
//$validuser
//unset($_SESSION['ActID']);
?>


