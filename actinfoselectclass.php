<?PHP
class act_info
{
    function get_act_info($ActID)
    {
    include("../inks/louisvillemusic_netcnxn.php");
    $cnxn=new lm_netconnection ;
    $dbname="louisvil_louisvillemusiccom";
    $cnxn->lm_connection($dbname);
			$sqledit="SELECT * FROM Acts WHERE ActID='".$ActID."'";
			$result=@mysql_query($sqledit) OR DIE ("Unable to $sqledit ");
			$thisrec=@mysql_fetch_array($result);
			$numfields=@mysql_num_fields($result);
				for ($i=0; $i<$numfields; $i++)
				{// creates and determines variables and values. Strips slashes from all string fields
				$fieldname=mysql_field_name($result, $i);
				$fieldtype=mysql_field_type($result,$i);
					if ($fieldtype=="string")
					{
					$fieldval=strip_tags(str_replace("\\", "", $thisrec[$fieldname]),'<a> <b> <i> </i> </b> </a>');
//					$fieldval=stripslashes($fieldval);
//					$fieldval=stripslashes($fieldval);
					}
					ELSE
					{
					$fieldval=$thisrec[$fieldname];
					}
				$fieldname=$fieldval;
				$this->$fieldname=stripslashes($$fieldname);
                echo $this->$fieldname;
				$fieldnamelen=$fieldname."len";
				$fieldnamecolor=$fieldname."blue";
				$this->$$fieldnamecolor="blue";
				$this->$$fieldnamelen=strlen($thisfieldval);
				$this->oldname .="<input type=\"hidden\" name=\"".$thisfieldname."\" value=\"".$thisfieldval."\">";
				}
    }
}//end of class
                ?>
