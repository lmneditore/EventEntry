<?PHP  
class cleantext {
var $content;
var $allowTags;
var $stripAttrib;
function cleanthistext($content)
{
$content=stripslashes($content);
$allowedTags = "<P><B><i><A><ul><li><hr><blockquote><img><TR><TD><TABLE><TBODY><FONT><br /><div>";
$content = strip_tags($content,$allowedTags);
$content=str_replace("\n"," ",$content);
//$content=str_replace("&para;&para;","XXX",$content);
$content=str_replace("\r"," ",$content);
$content=str_replace("\0"," ",$content);
$content=str_replace("\t"," ",$content);
$content=str_replace("  "," ",$content);
$content=str_replace("<Div","<div",$content);
$content=str_replace("</Div","</div",$content);
$content2=strtoupper($content);
$divs=substr_count($content2, "<div");
$endivs=substr_count($content2, "</div");
$this->div=$divs;
$this->endiv=$endivs;
 	if ($divs==$endivs)
	{
		$this->content=$content;
	}
	ELSE
	{
		$this->error="The number of DIVs does not agree with the number of /DIVs. This will result in an error when displayed. Please locate and correct the mismatch before saving this page.";
		
	}

}// end of contructor

function splitatupper($text)
    {
        $uppers=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","Z","Y","&","-");

                    $numltrs=strlen($text);
                     for($i=1; $i<$numltrs; $i++)
                     {
                         $tletter=substr($text,$i,1);
                         if(in_array($tletter,$uppers)==TRUE)
                         {
                            $text=str_replace($tletter," ".$tletter,$text);  
                            $i++;
                         }
                     }
                     $this->newtext=$text;
    }


}//End of class definition
?>
