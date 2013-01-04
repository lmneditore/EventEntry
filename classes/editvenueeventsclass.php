<?php
class venueevents extends lm_netconnection
{
	 
var $venueid; 
var $to, $StageName, $SeriesTitle, $EventTitle, $Prices, $ActName;
var $StageName1, $series1, $prices1, $title1,$act1;
   function displayvenueevents($venueid, $from, $to)
    {
            $cnxn=new lm_netconnection();
            $cnxn->lm_connection("louisvil_louisvillemusiccom");
            $Date1="1999-01-01";
            $sql = "SELECT MainEvents.EventDate as EventDate, MainEvents.MainEVID, MainEvents.KindOfEvent, MainEvents.SeriesID, MainEvents.VenueID, Acts.ActName, Acts.ActID, MainEvents.EventTitle, Series.SeriesTitle, Stages.StageName, Prices, EventStart, DATE_FORMAT(MainEvents.EventDate, '%W, %M %e, %Y') AS FDate
            FROM MainEvents LEFT JOIN Series ON MainEvents.SeriesID=Series.SeriesID LEFT JOIN ScheduleOfEvents ON MainEvents.MainEVID=ScheduleOfEvents.MainEVID LEFT JOIN Acts ON ScheduleOfEvents.ActID=Acts.ActID LEFT JOIN Stages ON ScheduleOfEvents.StageID=Stages.StageID WHERE (MainEvents.VenueID='$venueid'  
            AND MainEvents.EventDate>=CurDate() AND MainEvents.status='OK')ORDER BY EventDate ASC, StageName,  EventTitle, ProgramOrder DESC"; 
            $result = @mysql_query($sql) or die("couldn't execute query: $sql");
            $thisrow = @mysql_fetch_array($result);
            $fields = @mysql_num_fields($result);
            $this->displayvenueinfo($venueid);
            $display .=$this->vdisplay;
            Do
            {
                    for ($i=0; $i < $fields; $i++) 
                    {
                    $fieldname= mysql_field_name($result, $i);
                    $fieldtype=mysql_field_type($result,$i);
                    $fieldnametype=$fieldname."type";
                    $$fieldnametype=$fieldtype;
                        if ($fieldtype=="string")
                        {
                        $$fieldname=strip_tags(stripslashes($thisrow[$fieldname]));
                        }
                        ELSE
                        {
                        $$fieldname=$thisrow[$fieldname];
                        }
		               }
               $thisdate=($MainEVID==$MainEVID1 ? "" : "<div class=\"venueeventdate\">$FDate<a href=\"http://www.louisvillemusicnews.net/lmn/evententry/index.php?_action=EditThisEvent&MainEVID=".$MainEVID."\" OnMouseOver=\"window.status='".$Fdate."'\"; return true\"><span style=\"font-size: 8pt; font-variant: italic; color: white; \">&nbsp;&nbsp;...<I>EDIT</I></span></a></div>"); 
               $display .= $thisdate;
                $series=($SeriesTitle=="" ? "" : ($SeriesTitle==$series1 ? "" : "<div class=\"venuetitle\"><a href=\"http://www.louisvillemusicnews.net/lmn/evententry/index.php?_action=EditThisSeries&seriesid=".$SeriesID."\">".$SeriesTitle."</a></div>"));
               $display .= $series;
                $title=(($EventTitle==$title1 && $EventDate=$Date1) ? "" : "<div class=\"venuetitle\">".$EventTitle."</div>");
               $display .= $title;
                $admission=($Prices=="" ? "" : ($Prices==$prices1 ? "" :"<div class=\"act\">".$Prices."</div>"));
	       $display .= $admission;
		$stage=($StageName1==$StageName ? "" :"<div class=\"stagename\">".$StageName."</div>");
	       $display .=$stage;
                $thisact=($ActName=="" ? "" : "<div class=\"act\"><a href=\"http://www.louisvillemusicnews.net/lmn/evententry/index.php?_action=EditThisAct&actid=".$ActID."\">".$ActName."</a></div>");
               $display .= $thisact;
             $Date1=$EventDate; /*Change the Date Variable*/
             $series1=$SeriesTitle;
             $prices1=$Prices;
             $StageName1=$StageName;
             $act1=$ActName;
             $title1=$EventTitle;
             $MainEVID1=$MainEVID;
            }
            While ($thisrow = @mysql_fetch_array($result));
            $this->edisplay=$display;
    }// end of function displayvenueevents
    function displayvenueinfo($VenueID)
    {
	
	  //  $this=new venuewebsite();
     $this->lm_connection("louisvil_louisvillemusiccom");
     $sql="SELECT * FROM Venues LEFT JOIN VenueType ON Venues.VenueType=VenueTypeID LEFT JOIN KyanaRegion ON Venues.KyanaRegion=KyanaRegion.KyanaRegionID LEFT JOIN AgeRestrictions ON Venues.VAgeLimits=AgeRestrictions.AgeCodeID WHERE VenueID='".$VenueID."'";
     $result=mysql_query($sql) OR DIE ("Unable to complete query $sql");
     $numfields=@mysql_num_fields($result);
     $venuedata=@mysql_fetch_array($result);
     Do
     {
         for($i=0; $i<$numfields; $i++)
         {
             $fieldname=@mysql_field_name($result,$i);
             $allfields[$fieldname]=$venuedata[$fieldname];
             $this->$fieldname=$venuedata[$fieldname];
        }
     }
     WHILE($venuedata=@mysql_fetch_array($result));
      //  $this->getbusinessphoto($this->VenueOwner);
        $fields=array("Name"=>$this->VenueName, "Address"=>$this->Location, "City"=>$this->City, "State"=>$this->State, "Phone"=>$this->ContactPh, "Region"=>$this->KyanaRegion, "Website"=>$this->VenueURL);
        $vdisplay .="<div class=\"containerrow\" >";
        $pix=(!isset($this->venuethumb) ? ( !isset($this->venueimage) ? "" : $this->venuethumb) : $this->venueimage);
        $vdisplay .=(!isset($pix) || $pix=="" ? "" :"<img src=\"".$pix."\" width=\"250px\" alt=\"".$this->VenueName."\" OnMouseOver=\"window.status='".$this->VenueName."'\"  OnMouseOut=\"window.status=''; return true\">");
         foreach($fields AS $key=>$val)
        {
            if($key=="Website")
            {
                $link=($val=="" ? "&nbsp;" : "<a href=\"".$val."\" target=\"_blank\">".$val."</a>"); 
                $vdisplay .="<div class=\"containerrow\"><div class=\"SingleListLeft\">".$key.":</div><div class=\"SingleListRight\">".$link."</div></div>";
            }
            ELSE
            {
                 $vdisplay .="<div class=\"containerrow\"><div class=\"SingleListLeft\">".$key.":&nbsp; </div><div class=\"SingleListRight\"> ".$val."&nbsp; </div></div>";
            }
        }   
            $vdisplay .="</div>";
            
            $this->vdisplay=$vdisplay;
    }
      function getbusinessphoto($BizID)
        {
          
            $this->lm_connection("louisvil_louisvillemusic2");
            $sql="SELECT PathToThumbs, PathToPhoto FROM photosonline LEFT Join businessxphotos ON businessxphotos.PhotoID=photosonline.PhotoID WHERE businessxphotos.PhotoType='9' AND businessxphotos.BizID='".$BizID."'";
          
            $result=@mysql_query($sql) OR DIE ("Unable to complete query $sql");
            Do
            {
                $this->venuethumb=$pix["PathToThumbs"];
                $this->venueimage=$pix["PathToPhoto"];
            }
            WHILE ($pix=@mysql_fetch_array($result));
        }
    }// end of class
?>
