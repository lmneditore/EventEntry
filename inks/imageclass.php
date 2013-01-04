<?
class returnimage {
var $thisimage;
var $pathtoimage;
var $chosensize;
var $imagewidth;
var $imageheight;
var $okimages;
function getimage($pathtoimage,$chosensize,$align)
{
	$okimages=array("jpg","tif","gif","bmp");
	// trap various errors and typos
	if (ereg("Http",$pathtoimage))
	{
	$pathtoimage=ereg("Http", "http",$pathtoimage);
	}
	if (ereg("http;",$pathtoimage))
	{
	$pathtoimage=ereg("http;", "http:",$pathtoimage);
	}
	if (substr(trim($pathtoimage),0,3)=="www")
	{
	$prefix="http://";
	$prefix .=$pathtoimage;
	$pathtoimage=$prefix;
	}
	$imagetype=(substr($pathtoimage,-3));
	if (!(in_array($imagetype,$okimages))) //check for valid filetype
	{
	$this->thisimage="Not an valid filetype.";
	}
	ELSE
	{
	// end of error trapping
		if (!(@fclose(@fopen($pathtoimage,'r'))))// check to see if there is a file
		{
		}
		ELSE
		{
			$imagesize = getimagesize($pathtoimage);
			$this->imagewidth=$imagesize[0];
			$this->imageheight=$imagesize[1];
			if ($imagesize[0]>$imagesize[1])//If width is greater than height
			{ 
			$this->thisimage="<img src=\"".$pathtoimage."\" align=\"".$align."\" width=\"".$chosensize."\">";
			}
			Else
			{
			$this->thisimage="<img src=\"".$pathtoimage."\" align=\"".$align."\" height=\"".$chosensize."\">";
			}
		}
	}

}//end of getimage function
}//end of class definition
?>
