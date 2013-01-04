<? session_save_path("/home/users/web/b39/ipw.louisvillemusicnews/phpsessions");
session_start();
class articlead {
//DECLARE variables
var $thisstory;
var $StoryID;
var $Author;
var $ActID;
var $VenueID;
var $BusinessID;
var $lmngenre;
var $adid;


function articlead()
{
$vararray=array("thisstory"=>"thisstory","StoryID"=>"StoryID","Author"=>"Author","ActID"=>"ActID","VenueID"=>"VenueID","BusinessID"=>"BusinessID","lmngenre"=>"lmngenre");
	
	foreach ($vararray as $key => $value)
	//read http variables and sets variable values 
	{

	if (!($_REQUEST[$key]))// The selected variable has no value passed through REQUEST 
		{
		}
		ELSEIF($value=="thisstory")
		{
			if (!$_REQUEST["thisstory"])
			{
			}
			ELSE
			{
			include ("LMHeader.inc");
			$articledata="SELECT * FROM Articles WHERE Articles.StoryID=".$_REQUEST[$key]."";
			$data=@mysql_query($articledata) OR DIE ("Cannot complete $articledata query.");
			$numfields=@mysql_num_fields($data);
			$numrows=@mysql_num_rows($data);
			$articleresult=@mysql_fetch_array($data);
				if ($numrows<0)
				{
				}
				ELSEIF ($numrows==1)
				{
					for ($i=0; $i<$numfields; $i++) 
					{
					$fieldname= @mysql_field_name($data,$i);
					$$fieldname=$articleresult[$fieldname];
					$_REQUEST[$fieldname]=$articleresult[$fieldname];
					}
				}
				@mysql_close();
			}
		}
		ELSE
		{
		include ("LMhdrw.inc");
		$today=date("Y-m-d");
		$sql="SELECT *, lm_olads.adid, lm_olads.redirurl, lm_olads.filename AS ad2use FROM lm_adselector 
		LEFT JOIN lm_apporders ON
		lm_adselector.apporid=lm_apporders.apporid
		LEFT JOIN lm_olads ON
		lm_apporders.adid=lm_olads.adid
		WHERE ((selectorname='".$key."' AND selectorvalue='".$$key."') AND lm_apporders.enddate>$today) ";
		$adsql=@mysql_query($sql) or DIE ("Unable to complete $sql query.");
		$ads=@mysql_fetch_array($adsql);
		$numads=@mysql_num_rows($adsql);
			if ($numads<1)
			{
			}
			ELSE
			{

			DO 
			{
			echo "<BR>";
			echo "<table align=\"left\"><tr><td align=\"left\">";
			$thisad="http://www.louisvillemusic.com/ads/".$ads["ad2use"]."?adid=".$ads["adid"]."&url=".$ads["redirurl"];
			include($thisad);
			echo "</td></tr></table>";
			}
			WHILE ($ads=@mysql_fetch_array($adsql));
			
			}
		}
	}// END OF ARRAY LOOP
	@mysql_close();
} // end of class function
}// end of class definition
?>