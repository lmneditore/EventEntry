<?PHP 
 session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
session_start();
$thisvalue="George";
session_register("thisvalue");
?>