<?php
$cnxn->lm_connection("louisvil_louisvillemusic2");
If ($thismenuvalueid)
{
}
ELSE
{
$thismenuvalueid=6;
}



$title = "";

$sql4="SELECT menuvalues.bgimage, menuvalues.imagewidth, menuvalues.imageheight, menuvalues.bgcolor, menuvalues.fontfamily, menuvalues.fontsize, menuvalues.fontweight, menuvalues.fontcolor, menuvalues.texttransform, menuvalues.lineheight, menuvalues.fontstretch, menuvalues.menuvalueid
FROM menuvalues
WHERE menuvalues.menuvalueid='$thismenuvalueid'";
$result1 = @mysql_query($sql4) or die("couldn't execute first menu query.");
$count=count($result1);


$thismenu = @mysql_fetch_array($result1);

$imagewidth= $thismenu["imagewidth"];
$imageheight=$thismenu["imageheight"];
$fontcolor=$thismenu["fontcolor"];
$fontsize=$thismenu["fontsize"];
$lineheight=$thismenu["lineheight"];
$bgcolor=$thismenu["bgcolor"];
$texttransform=$thismenu["texttransform"];
$fontstretch=$thismenu["fontstretch"];
$fontweight=$thismenu["fontweight"];
$fontfamily=$thismenu["fontfamily"];


if ($count>7)
{
$imagewidth=round(480 / $count);
}
ELSE
{
}


?>






<style TYPE="text/css">
#menu a:link {
	color: black;
	background-color: #15B9B2;
	text-decoration: none;
	}
#menu a:active {
	color: #EFB900;
	background-color: #15B9B2;
	text-decoration: none;
	}
#menu a:visited {
	color: #0C5A57;
	background-color:#15B9B2;
	text-decoration: none;
	}
#menu a:hover {
	color: #0B4B49;
	background-color: #15B9B2;
	text-decoration: none;
	}

.menubg {
<?php

printf ("background-image: url(%s); ", $thismenu["bgimage"]);
echo "width:".$imagewidth."; ";
echo "height:".$imageheight."; ";
echo "color:".$fontcolor."; ";
echo "font-size:".$fontsize."; ";
echo "line-height:".$lineheight."; ";
echo "bgcolor:".$bgcolor."; ";
echo "text-transform:".$texttransform."; ";
echo "font-stretch:".$fontstretch."; ";
echo "text-align: center; ";
echo "font-weight:".$fontweight."; ";
echo "font-family:".$fontfamily."; ";
echo "padding-bottom: 2px; ";
echo "border-style: none;";
?>
}



</style>

</head>
<body BGCOLOR="#0F3925">
<table BGCOLOR="#0F3925" BORDER="0"><tr>
<?PHP 


$sql4="SELECT webmenus.menuid,
webmenus.itemanchor, webmenus.text2display, webmenus.sectionid
FROM webmenus
WHERE (webmenus.menuvalueid='$thismenuvalueid' and webmenus.menuid <> '$thismenuid')
ORDER BY webmenus.menuid";

$menuresult1 = @mysql_query($sql4) or die("couldn't execute last query.");


while ($thismenu = @mysql_fetch_array($menuresult1))


if ($thismenu["itemanchor"])
{
 if ($thismenu["text2display"]=="Main")
   {
   $thismenuid="";
   }
   ELSE
   {
   $thismenuid=$thismenu["menuid"];
   }
   $thisitem=$thismenu["itemanchor"];
   $thissectionid=$thismenu["sectionid"];
   $thistext=$thismenu["text2display"];
echo "<span id=\"menu\">";
echo "<td class=\"menubg\"><a href=\"".$thisitem."?thisid=".$thissectionid."&thismenuid=".$thismenuid."\">".$thistext."</a></td>";
  

echo "</span>";
}
Else
{
}
?>
</td></tr></table>


