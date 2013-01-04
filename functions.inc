<?
require( "../inks/lmvars.inc" );
function opendb2()
{
include("../inks/LMhdrw.inc");
}

function displayloginheader($loginheader)
	{
		echo "<table bgcolor=\"#f5e3a1\" width=\"460\" align=\"center\" border=\"1\" bordercolor=\"#f5e3a1\" cellpadding=\"4\">\n";
echo "<tr><td class=\"mainsubhdr\">$loginheader</font></td></tr>\n";
		echo "<div align=\"center\">\n";
		echo "  <center>\n";
		echo "  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor= \"#f5e3a7\">\n";
	}
	
	
	function displayHeader( $title = "LouisvilleMusicNews.net Main Menu and Header" )
	{

		echo "\n<html>\n";
		echo "<head>\n";
		echo "<title>$title</title>\n";
		echo "<link rel=\"stylesheet\" href=\"http://www.louisvillemusic.com/lmn/LMNStyles.css\" type=\"text/css\">\n";
		echo "</head>\n\n";

		echo "<body bgcolor=\"#0c4a7d\">\n\n";
		echo "<table valign=\"top\" width=\"583\" align=\"center\" border=\"1\"  bgcolor=\"#f5e3a1\">";
echo "<tr><td align=\"center\" bgcolor=\"#c0c0c0\" colspan=\"5\" valign=\"top\">"; 


   echo ("<img src=\"http://www.louisvillemusic.com/lmn/lmcomlogogrey.GIF\" width=\"583\" align=\"center\"></td></tr><tr><td bgcolor=\"#0c4a7d\" colspan=\"5\">");

      include ("http://www.louisvillemusic.com/lmn/menu.php");
	 
      ?>
       </td></tr><tr><td align="center" width="583" class="eventdate" colspan="5" valign="top" background=\"#0c4a7d\"> 
     <?PHP 
      echo date("l, F j, Y");
      ?>
      </td></tr>
<tr><td valign="top">


    <?PHP 
//		echo "<table bgcolor=\"#f5e3a1\" width=\"460\" align=\"center\"><tr><td class=\"IssueHdr\"></td></tr>\n";
// echo "<tr><td>\n";
	}
	
	function sentMail( $from, $to, $subject, $body )
	{
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ios-8859-1\r\n";
		$headers .= "From: {$from}\r\n";
		$result = @mail( $to, $subject, $body, $headers );
		if( $result ) return true;
		else return false;
	}
	
	function verifyUser()
	{
		global $ADMIN_EMAIL;
 session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
		session_start();
		global $lmusername, $password;
		if( session_is_registered( "lmusername" ) && session_is_registered( "password" ) )
		{
			$result = mysql_query( "SELECT user_name, password FROM lmuser WHERE user_name='$username' AND BINARY password='$password'" ) or error( "Login failed, please contact <a href=\"$ADMIN_EMAIL\">adminstrator</a>" );
			if( mysql_num_rows( $result ) == 1 ) return true;
		}
		return false;
	}
	
	
	
	function WriteDateSelect($BeginYear = 0, 
                         $EndYear = 0, 
                         $IsPosted = true,
                         $Prefix = '')
{
  if (! $BeginYear)
  {
    $BeginYear = date('Y');
  }
		
  if (! $EndYear)
  {
    $EndYear = $BeginYear;
  }
	
  $Year = $IsPosted 
          ? (int) $_POST[$Prefix . 'Year']
          : (int) $_GET[$Prefix . 'Year'];
  $Month = $IsPosted 
          ? (int) $_POST[$Prefix . 'Month']
          : (int) $_GET[$Prefix . 'Month'];
  $Day = $IsPosted 
          ? (int) $_POST[$Prefix . 'Day']
          : (int) $_GET[$Prefix . 'Day'];
	
  echo '<select name="', $Prefix, 'Year">
         ';
	
  for ($i = $BeginYear; $i <= $EndYear; $i++)
  {
    echo '<option ';
		
    if ($i == $Year)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }
	
  echo '</select>-
        <select name="', $Prefix, 'Month">
          ';	

  for ($i = 1; $i <= 12; $i++)
  {
    echo '<option ';
		
    if ($i == $Month)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }

  echo '</select>-
        <select name="', $Prefix, 'Day">
          ';	

  for ($i = 1; $i <= 31; $i++)
  {
    echo '<option ';
		
    if ($i == $Day)
      echo 'selected="yes"';
			
    echo '>', $i, '</option>
         ';
  }

  echo '</select>
       ';
  return;
}

function GetDateSelectString($IsPosted = true,
                             $Prefix = '')
{
  if ($IsPosted)
  {
    return (int) $_POST[$Prefix . 'Year']
           . '-' . (int) $_POST[$Prefix . 'Month']
           . '-' . (int) $_POST[$Prefix . 'Day'];
  }

  return (int) $_GET[$Prefix . 'Year']
         . '-' . (int) $_GET[$Prefix . 'Month']
         . '-' . (int) $_GET[$Prefix . 'Day'];
}
	
	
	function statusoption($status)
{
if ($status=="DE")
{?>
<select name="status"><option value="OK">Display</option>
      <option value="PE">Pending</option>
      <option value="DE" SELECTED>Deleted</option>
      </select>
	  <?}
	  ELSEIF ($status=="PE")
	  
	  { ?>
	  <select name="status"><option value="OK">Display</option>
      <option value="PE" SELECTED>Pending</option>
      <option value="DE">Deleted</option>
      </select>
<?}
ELSE 
{?>
<select name="status"><option value="OK"  SELECTED>Display</option>
      <option value="PE">Pending</option>
      <option value="DE"> Deleted</option>
      </select>
<?
}
}


Function displaynoauthorization($colspan)
{
echo "<TR><TD align=\"center\" colspan=\"".$colspan."\">You are not authorized to access this page. Please contact the site adminstrator for assistance.</td></tr>";
echo "<TR><TD Align=\"center\" colspan=\"".$colspan."\"><button OnClick=\"parent.location='http://www.louisvillemusic.com'\" style=\"background-color: \"grey\"><font color=\"blue\">Click Here</button></td></tr>";

}
	
	
	
	?>
