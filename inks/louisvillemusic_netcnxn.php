<?PHP
class lm_netconnection 
{
    var $mainconnect;
    function lm_connection($dbname)
    {
        
        $user=((date("j")%2)>0 ? "louisvil_tech" : "louisvil_tech2");
        $pw=((date("j")%2)>0 ? "jrg0830" : "m00seipy");
        
        $mainconnect =@mysql_connect("louisvillemusicnews.ipowermysql.com", $user, $pw) or die('Could not connect to the database because: '. mysql_error());
        $this->db = @mysql_select_db($dbname, $mainconnect) oR DIE ("Unable to select the database ".$dbname." because: ". mysql_error());
//echo "got connected";
    }
}
?>