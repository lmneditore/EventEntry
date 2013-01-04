<?PHP
class links 
{
    var $connection;
  
    function displayalllinks($limit) 
    {
        if(!isset($limit))
        {
            $limit=" LIMIT 0, 30";
        }
         include("../inks/LMhdrw.inc");
         $sql="SELECT * FROM lmn_links WHERE 1 LIMIT 1, 0";
         $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
         $fieldtitles=@mysql_fetch_array($result);
         $numfields=@mysql_num_fields($result);
          echo "<TABLE border=1><TR>"; 
         DO
         {
            
             for ($i=0;$i<$numfields; $i++)
                 {
                    $fieldname=@mysql_field_name($result,$i);
                    echo "<TD  border=1>".$fieldname."</TD>";
                 }
         }
         WHILE ($fieldtitles=@mysql_fetch_array($result));
         echo "</TR>";
         
         $sql2="select * from `louisvillemusic2`.`lmn_links` $limit";
         $result2=@mysql_query($sql2) OR DIE ("Unable to complete query $sql2");
         $alllinks=@mysql_fetch_array($result2);
         $numrecs=@mysql_num_rows($result2);
           $j=0;     
         DO
         {
            
              if($j % 2==0)
                    {
                        $color="WHITE";
                    }
                    ELSE
                    {
                        $color="#f2f2f2";
                    }
             
             
             
             echo "<TR  border=1>"; 
             for ($i=0;$i<$numfields; $i++)
                 {
                    $fieldname=@mysql_field_name($result2,$i);
                    $fieldvalue=$alllinks[$fieldname];
                   
                   echo "<TD  border=1 >".$fieldvalue."</TD>";
                 }
                  echo "</TR>";
                  $j++;
         }
         WHILE ($alllinks=@mysql_fetch_array($result2));
         echo "</TABLE>";
        
    }
    function displaylinksbyfilter($filter, $order, $limit)
    {
        include("../inks/LMhdrw.inc");
            if(!isset($filter))
            {
                $filter="WHERE LinkID>0"; 
            }
            if(!isset($limit))
            {
                $limit= " LIMIT 0,30";
            }
            if(!isset($order))
               {
                   $order=" ORDER BY LinkTitle ASC";
               }
            $sql="SELECT * FROM lmn_links $filter $order $limit";
            $result=@mysql_query($sql) OR DIE ("Unable to complete $sql");
        
        
        DO
        {
            $thislink=$linkinfo["Link_URL"];
            $LinkTitle=$linkinfo["LinkTitle"];
            $thislink=str_replace(" ","", $thislink); // remove any spaces 
            
            if(substr($thislink,0,4)=="http")
            {
            }
            ELSEIF (substr($thislink,0,4)=="www.")
            {
                $thislink="http://".$thislink;
            }
            echo "<DIV class=\"\"><A href=\"$thislink\" target=\"_new\" onMouseOver=\"window.status='{$LinkTitle}'; return true\"  onMouseOut=\"window.status=''; return true\">";
            echo $LinkTitle."</a></DIV>";
        }
        WHILE ($linkinfo=@mysql_fetch_array($result));
        //primary data filter function
    }
    
    function addnewlink($URL,$LinkTitle,$Description,$SubmittedBy,$RatedBy,$RatersComment)
    {
        include("newtablerecordclass.php");
        $newrec= new newrecord;
        $tablename="lmn_Links";
        $connection="../inks/LMhdrw.inc";
        include($connection);
        $newrec->newtablerecord($tablename,$connection);
        $linkid=$newrec->newrecordid;
        $today=date("Y-m-d");
        $URL=addslashes($URL);
        $LinkTitle=addslashes($LinkTitle);
        $Description=addslashes($Description);
        $SubmittedBy=addslashes($SubmittedBy);
        $RatedBy=addslashes($RatedBy);
        $RatersComment=addslashes($RatersComment);        
        $sql="UPDATE lmn_links SET LMN_URL='$URL', DateAdded='$today', LinkTitle='$LinkTitle', SubmittedBy='$SubmittedBy', RatedBy='$RatedBy', RatersComment='$RatersComment' WHERE LinkID='$linkid' LIMIT 1,0";
        $result=@mysql_query($sql)OR DIE("Unable to complete $sql");
         $sql="Select * from lmn_links WHERE LinkID='$linkid'";
         $result=@mysql_query($sql) OR DIE ("Unable to complete query: $sql");
         $links=@mysql_fetch_array($result);
         DO
         {
         $this->LinkTitle=stripslashes($links["LinkTitle"]);
         $this->Link_url=stripslashes($links["Link_URL"]);
         $this->Description=stripslashes($links["Description"]);
         $this->SubmittedBy=stripslashes($links["SubmittedBy"]);
         $this->RatedBy=stripslashes($links["RatedBy"]);
         $this->RatersComment=stripslashes($links["RatersComment"]);
         $this->Rating=$links["Rating"];
         }
          WHILE($links=@mysql_fetch_array($result));
    }
    
    function updatelink($URL, $LinkTitle,$Description,$SubmittedBy,$RatedBy,$Rating, $RatersComment,$LinkID)
    {
         //takes the form data and processes it   
        $today=date("Y-m-d");
             $connection="../inks/LMhdrw.inc";
        include($connection);     
        $link=addslashes($link);
        $LinkTitle=addslashes($LinkTitle);
        $Description=addslashes($Description);
        $SubmittedBy=addslashes($SubmittedBy);
        $RatedBy=addslashes($RatedBy);
        $RatersComment=addslashes($RatersComment); 
        if(!isset($LinkID))
        {
                $sql="UPDATE lmn_links SET Link_URL='$URL', DateAdded='$today', LinkTitle='$LinkTitle', Description='$Description', SubmittedBy='$SubmittedBy', RatedBy='$RatedBy', RatersComment='$RatersComment' WHERE Link_URL='$URL'";
        }
        ELSEIF(!isset($URL))
        {
            echo "Unable to update record - no LinkID and no URL is specified";
        }
        ELSE
        {
            $sql="UPDATE lmn_links SET Link_URL='$URL', DateAdded='$today', LinkTitle='$LinkTitle', SubmittedBy='$SubmittedBy', Description='$Description', RatedBy='$RatedBy', RatersComment='$RatersComment' WHERE LinkID='$LinkID' LIMIT 1";
        }
        if(!isset($sql))
        {
        }
        ELSE
        {
             $result=@mysql_query($sql) OR DIE ("Unable to complete $sql");
             $sql="Select * from lmn_links WHERE Link_URL='$URL'";
             $result=@mysql_query($sql) OR DIE ("Unable to complete query: $sql");
             $links=@mysql_fetch_array($result);
             $numfields=@mysql_num_fields($result);
             
             DO
             {
                 for ($i=0;$i<$numfields; $i++)
                 {
                    $fieldname=@mysql_field_name($result,$i);
                    $this->$fieldname=stripslashes($links[$fieldname]);
                 }
             }
             WHILE( $links=@mysql_fetch_array($result));
         }
    }
    function deleteoldlink($linkid)
    {
        //deletes the indicated link
         include("../inks/LMhdrw.inc");
         $sql="DELETE FROM lmn_links WHERE LinkID = '$linkid'";
         $linkdelete=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
         return "Link $link has been deleted.";
     }
    function showdata($data_array)
    {
       
        //build the form to display one link's data here
        print_r($data_array);
    }
    function showonelink($link,$linkid)
    {
         //Reads the data for specified link and passes it to showdata() function
          include("../inks/LMhdrw.inc");
          if(!isset($linkid))
          {
       
            $sql="SELECT * from lmn_links WHERE Link_URL LIKE '%$link%'";
          }
          ELSE
          {
               $sql="SELECT * from lmn_links WHERE LinkID='$linkid'";
          }
        $result=@mysql_query($sql); 
        $numfields=@mysql_num_fields($result);
        echo "numfields=".$numfields;
        DO
        {
            for ($i=0; $i<$numfields; $i++)
            {
                $thisfieldname=mysql_field_name($result, $i);
				$fieldname=$thisfieldname;
				$one_array=array($fieldname=>$info[$thisfieldname]);
				$data_array=array_merge($data_array,$one_array);
            }
        }
        WHILE ($info=@mysql_fetch_array($result));
        
        $this->showdata($data_array);
    }
    function displayactlinks($actid)
    {
         include("../inks/LMhdrw.inc");
         $sql="SELECT * FROM lmn_links 
         LEFT JOIN linkxacts ON lmn_links.LinkID=linkxacts.linkid WHERE linkxacts.actid='$actid'";
         $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
         $links=@mysql_fetch_array($result);
         $numlinks=@mysql_num_rows($result);
         $this->numlinks=$numlinks;
         $i=0;
         DO
         {
            $actlink="actlink_".$i;
            $actlinkid="actlinkid_".$i;
            $actlinktitle="actlinktitle_".$i;
             $this->$actlink=$links["Link_URL"];
             $this->$actlinkid=$links["LinkID"];
             $this->$actlinktitle=$links["LinkTitle"];
             $i++;
         }
         WHILE ($links=@mysql_fetch_array($result));
    }
     function displaybusinesslinks($businessid)
    {
         include("../inks/LMhdrw.inc");
         $sql="SELECT * FROM lmn_links 
         LEFT JOIN linkxbusiness ON lmn_links.LinkID=linkxbusiness.linkid WHERE linkxbusiness.businessid='$businessid'";
         $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
         $links=@mysql_fetch_array($result);
         $numlinks=@mysql_num_rows($result);
         $this->numlinks=$numlinks;
         $i=0;
         DO
         {
            $businesslink="businesslink_".$i;
            $businesslinkid="businesslinkid_".$i;
            $businesslinktitle="businesslinktitle_".$i;
             $this->$businesslink=$links["Link_URL"];
             $this->$businesslinkid=$links["LinkID"];
             $this->$businesslinktitle=$links["LinkTitle"];
             $i++;
         }
         WHILE ($links=@mysql_fetch_array($result));
    }
     function displaygenrelinks($lmngenreid)
    {
        include("../inks/LMHeader.php");
        $sql="SELECT * FROM lmngenres LEFT JOIN amgmaingenre on lmngenres.amggenre=amgmaingenre.AMGMGID WHERE lmngenreid='$lmngenreid'";
        $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
        $lmngenre=@mysql_fetch_array($result);
        Do
        {
            $maingenre=$lmngenre["genre"];
            $amgmaingenre=$lmngenre["amggenre"];
            $amgcat1=$lmngenre["amgcat1"];
            $amgcat2=$lmngenre["amgcat2"];
            $this->lmngenre=$lmngenre["genre"];
            $this->amgmaingenre=$lmngenre["amggenre"];
            $this->amgcat1=$lmngenre["amgcat1"];
            $this->amgcat2=$lmngenre["amgcat2"];
        }
        WHILE ($lmngenre=@mysql_fetch_array($result));
        mysql_close();
        
        include("../inks/LMhdrw.inc");
               $sql="SELECT * FROM lmn_links  
         LEFT JOIN linkxstyles ON lmn_links.LinkID=linkxstyles.linkid WHERE linkxstyles.AMGGenre='$amgmaingenre'";
         $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
         $links=@mysql_fetch_array($result);
         $numlinks=@mysql_num_rows($result);
         $this->numlinks=$numlinks;
         $i=0;
         DO
         {
            $stylelink="stylelink_".$i;
            $stylelinkid="stylelinkid_".$i;
            $stylelinktitle="stylelinktitle_".$i;
             $this->$stylelink=$links["Link_URL"];
             $this->$stylelinkid=$links["LinkID"];
             $this->$stylelinktitle=$links["LinkTitle"];
             $i++;
         }
         WHILE ($links=@mysql_fetch_array($result));
    }
}
?>
