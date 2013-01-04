<?PHP
// class LMPage's attributes
class lmpage
{
var $layout;
var $title = "Louisville Music News.net, Inc.";
var $keywords;
//var $menu = $thismenu;
var $buttons = array("Main" => "main.php",
                     "Contact" => "contact.php",
					 "Calendar" => "calendar.php");
var $classification = "Music and Entertainment News and Schedules";

     function SetContent($newcontent)
     {
     $this ->content="$newcontent";
     }
	 
	 function SetTitle($newtitle)
	 {
	 $this ->title = $newtitle;
	 }
	 function SetClassification($newclassification)
	 {
	 $this->classification=$newclassification;
	 }
	 function SetKeywords($newkeywords)
	 {
	 $this ->keywords = $newkeywords;
	 }
	 
	 function SetMenu($thismenu)
	 {
	 $this ->menu = $newmenu;
	 }
	 
	 function SetStylesheet($newStylesheet)
	 {
	 $this ->stylesheet = $newStylesheet;
	 }
	 
	 function Displaylmpage ()
	 {
	 echo "<meta name=\"distribution\" content=\"global\">";
	 echo "<meta HTTP-EQUIV=\"resource-type\" content=\"document\">";
	 echo "<meta HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">";
	 echo "\n\n";
	 echo "<!--Copyright 2002 by Louisville Music News.net. All rights reserved. Reproduction of material on this website is strictly forbidden without prior permission.-->";
	 $this ->DisplayTitle();
	 $this ->DisplayKeywords();
	 $this ->DisplayClassification();
	 $this ->DisplayStylesheet();
	 echo "</head>\n<body bgcolor=\"#0c4a7d\">";
	 $this -> //displayLMHeader();
	   echo $this ->content;
	   $this->DisplayFooter();
	 }
	 
	 
	 function DisplayTitle()
	 {
	 echo "<title>$this->title </title>";
	 }
	 
	 function DisplayKeywords()
	 {
	 echo "<META Name=\"keywords\" content=\"$this->keywords\">";
	 }
	 
	 function DisplayClassification()
	 {
	 echo "<meta name=\"Classification\" content=\"$this->classification\">";
	 }
	 
	 function DisplayStylesheet()
	 {
	 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
     echo "<LINK REL=\"stylesheet\" HREF=\"$this->stylesheet\" TYPE=\"text/css\">";
	 }
	 
	 function DisplayLMHeader()
	 {
	 echo "<table width=\"365\" border=\"0\" align=\"center\">";
	 echo "<TH class=\"searchhdr\">Welcome to Louisville Music News.net</th>";
	 echo "<TR><TD class=\"normal\">";
	 }
 	 function DisplayMenu()
	 {
	 echo "include (\"$this->menu\");";
	 }
		 function DisplayFooter()
	 {
	 echo "</td></tr></table>";
	 ?> <table width="365" align="center" border="0">
	 <TR><TD>
	 <P class=foot>&copy: Louisville Music News.net. Inc.</p>
	 </td></tr>
	 </table>
	 <?PHP
	 }
}//end of class definition


class rightcolumnad
{
}




?>
