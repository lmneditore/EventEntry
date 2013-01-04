<?PHP
 session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
session_start();
if (!$validvenue)
{
header("Location: http://www.louisvillemusic.com"); 
}
ELSE
{
?>
