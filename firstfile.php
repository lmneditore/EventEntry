<?PHP 
 session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
session_start();
Echo "This is the first file";
include("secondfile.php");
$thisvalue .=" is a jerk";
echo "<BR>";
echo $thisvalue;
?>

