<?PHP
class lm_netconnection 
{
    var $mainconnect;
    function lm_connection($dbname)
    {
        
        $user=((date("j")%2)>0 ? "louisvil_tech" : "louisvil_updater");
        $pw=((date("j")%2)>0 ? "jrg0830" : "ar4080!!up");
        
        $mainconnect =@mysql_connect("louisvillemusicnews.ipowermysql.com", $user, $pw) or die('Could not connect to the database because: '. mysql_error());
        $this->db = @mysql_select_db($dbname, $mainconnect) oR DIE ("Unable to select the database ".$dbname." because: ". mysql_error());
//echo "got connected";
    }
    function webmanagerconnection($dbname)
    {
	       $user=((date("j")%2)>0 ? "louisvil_photos" : "louisvil_photos2");
        $pw=((date("j")%2)>0 ? "jrg0830!!pix" : "ar4080!!pix");
        
        $mainconnect =@mysql_connect("louisvillemusicnews.ipowermysql.com", $user, $pw) or die('Could not connect to the database because: '. mysql_error());
        $this->db = @mysql_select_db($dbname, $mainconnect) oR DIE ("Unable to select the database ".$dbname." because: ". mysql_error());
    }
    function pixconnection($dbname)
    {
	      $user=((date("j")%2)>0 ? "louisvil_photos" : "louisvil_photos2");
        $pw=((date("j")%2)>0 ? "jrg0830!!pix" : "ar4080!!pix");
        
        $mainconnect =@mysql_connect("louisvillemusicnews.ipowermysql.com", $user, $pw) or die('Could not connect to the database because: '. mysql_error());
        $this->db = @mysql_select_db($dbname, $mainconnect) oR DIE ("Unable to select the database ".$dbname." because: ". mysql_error());
    }
    
}
?>