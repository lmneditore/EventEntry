<?PHP 
class venuewebsite  extends lm_netconnection
{ 

    function getvenuewebsite($BizID)
        {
		       
        $cnxn=new lm_netconnection();
        $cnxn->lm_connection("louisvil_louisvillemusic2");
         $sql="SELECT Link_URL FROM lmn_links LEFT JOIN linkxbusiness ON lmn_links.LinkID=linkxbusiness.linkid WHERE linkxbusiness.businessid=".$BizID."";

	 $result=@mysql_query($sql) or DIE ("Unable to complete query $sql");
         $numrows=@mysql_num_rows($result);
             if(!(isset($result)) || $numrows<1)
             {
                 $this->vlink="N/A";
             }
             ELSE
             {
                 Do
                 {
                     $this->vlink=$links["Link_URL"];
                 }
                 WHILE($links=@mysql_fetch_array($result));
             } 
        }
	
        function getbusinessphoto($BizID)
        {
            $cnxn=new lm_netconnection();
            $cnxn->lm_connection("louisvil_louisvillemusic2");
            $sql="SELECT PathToThumbs, PathToPhoto FROM photosonline LEFT Join businessxphotos ON businessxphotos.PhotoID=photosonline.PhotoID WHERE businessxphotos.PhotoType='9' AND businessxphotos.BizID='".$BizID."'";
          
            $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
            Do
            {
                $this->venuethumb=$pix["PathToThumbs"];
                $this->venueimage=$pix["PathToPhoto"];
            }
            WHILE ($pix=@mysql_fetch_array($result));
        }
        
}//END OF CLASS    
 ?>
