<? 

/*function forminputbutton($type, $name, $value,$OnClick)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10pt;";
echo "background-color: #336633;";
echo "color: white;";
echo "font-weight: normal;";
//echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
echo "font-align: center;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"lmnbutton\" >";
}
function lmnbutton($value,$name,$OnClick,$windowlocation)
{
$len=strlen($value);
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10 pt;";
echo "background-color: #336633;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
echo "}";
echo "</style>";

	If (!$windowlocation)
	{
	$windowlocation="parent.location";
	}
	ELSE
	{
	}

echo "<button OnClick=\"$windowlocation='$OnClick'\" class=\"lmnbutton\" name=\"$name\" >$value</button>";
}

function defaultbuttons()
{
		$OnClick="http://www.thsrock.org/lmlogout.php";
		$windowlocation="parent.location";
		lmnbutton("Log Out","Submit", $OnClick,$windowlocation);
		$redo="http://www.louisvillemusicnews.net/members/membersonly.php";
		?>&nbsp;&nbsp;<?
		$OnClick=$redo;
		$windowlocation="parent.location";
		lmnbutton("Members Page","", $OnClick,$windowlocation);
		// buttonrow ("Continue","");
}

function submitbutton($value)
{
echo "<style>";
echo ".lmnbutton";
echo "{";
echo "font-size: 10pt;";
echo "background-color: #336633;";
echo "color: white;";
echo "font-weight: normal;";
echo "font-variant: small-caps;";
echo "font-family: Arial;";
echo "border-bottom: medium ridge #bdd7c8;";
echo "border-right-width: medium;";
echo "border-left-width: thin;";
echo "border-top-width: thin;";
//echo "width: "";";
//echo "border-style: groove;";
echo "}";
echo "</style>";
echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbutton\" >";
} 

*/
function selectbox($fieldname, $fieldnamecolor,$options)
{
 while (list ($key, $value) = each ($options))
	{
		if ($key==$fieldname)
		{?>
		<option style=\"color:"<?echo $fieldnamecolor;?>"   value="<? echo $key;?>" SELECTED><?echo $value;?></option><?
		}
		ELSE
		{?>
		<option style=\"color:"<?echo $fieldnamecolor;?>"  value="<? echo $key;?>"><?echo $value;?></option><?
		}
	}
}
function daybox($fieldname, $fieldnamecolor,$options)
{
 while (list ($key, $value) = each ($options))
	{
		if ($value==$fieldname)
		{?>
		<option style=\"color:"<?echo $fieldnamecolor;?>"   value="<? echo $key;?>" SELECTED><?echo $value;?></option><?
		}
		ELSE
		{?>
		<option style=\"color:"<?echo $fieldnamecolor;?>"  value="<? echo $key;?>"><?echo $value;?></option><?
		}
	}
}

function documentheaders($company, $stylesheet,$url,$meta)
{

	if (!$company)
	{
	$company="Trinity High School";
	}
	if(!$stylesheet)
	{
	$stylesheet="trinitystylesheet.css";
	}
	if (!$url)
	{
	$url="www.thsrocks.net";
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "-//W3C//DTD HTML 4.01 Transitional//EN">
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> -->
<HEAD>
<LINK REL="stylesheet" HREF="<? echo $stylesheet;?> " TYPE="text/css">
<!-- Copyright 2004 By <? echo $company; ?>. All rights reserved. Portions of text may be used in accordance with the doctrine of "Fair Use," provided proper credits and referencing to <? echo $company; ?> at <? echo $url;?> . Reuse of photographs on this site is strictly prohibited. Any unauthorized use of this document and the content herein is strictly forbidden.-->
<?
if (!$meta)
{
$meta="<meta name=\"ROBOTS\" content=\"ALL\">

<meta name=\"distribution\" content=\"global\">

<META name=\"Keywords\" content=\"\">

<meta HTTP-EQUIV=\"resource-type\" content=\"document\">

<meta name=\"Classification\" content=\"\">

<meta HTTP-EQUIV=\"Content-type\" content=\"text/html; charset=iso-8859-1\">";
}
echo "</head><body>";

}// end of documentheaders function
function displayHeader( $title = "Louisville Music.com Main Menu and Header" )
	{

		echo "\n<html>\n";
		echo "<head>\n";
		echo "<title>$title</title>\n";
		echo "<link rel=\"stylesheet\" href=\"http://www.louisvillemusicnews.net/lmn/LMNStyles.css\" type=\"text/css\">\n";
		echo "</head>\n\n";

		echo "<body bgcolor=\"#0c4a7d\">\n\n";
		echo "<table valign=\"top\" width=\"583\" align=\"center\" border=\"1\"  bgcolor=\"#f5e3a1\">";
echo "<tr><td align=\"center\" bgcolor=\"#c0c0c0\" colspan=\"5\" valign=\"top\">"; 


   echo ("<img src=\"http://www.louisvillemusicnews.net/lmn/lmcomlogogrey.GIF\" width=\"583\" align=\"center\"></td></tr><tr><td bgcolor=\"#0c4a7d\" colspan=\"5\">");

      include ("http://www.louisvillemusicnews.net/lmn/menu.php");
	 
      ?>
       </td></tr><tr><td align="center" width="583" class="eventdate" colspan="5" valign="top" background=\"#0c4a7d\"> 
     <?PHP
      echo date("l, F j, Y");
      ?>
      </td></tr>
<tr><td valign="top">


    <?PHP
//		echo "<table bgcolor=\"#f5e3a1\" width=\"460\" align=\"center\"><tr><td class=\"IssueHdr\"></td></tr>\n";
// echo "<tr><td>\n";
	}




?>