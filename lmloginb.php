<?PHP Session_start();
//setcookie( "", "","" );

$filename="functions_part.php";
if(file_exists($filename))
{

include("functions_part.php");

 $fun = new functionsclass(); 

if(class_exists('functionsclass')) 
{
   $loginheader = "Louisville Music News";

$fun->displayLMHeader($loginheader);
echo $fun->header;
//echo $fun->title;
$fun->verifycalendaruser($user_id);

$fun->displayloginheader($loginheader);
}
ELSE
{
	echo "NO CLASS";
}
}
ELSE
{
	echo "no file";
}
?>
