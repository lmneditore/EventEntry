<?PHP  
//buttonclass.php
//lmnwebmanager ver 1.0
//last update 2004/10/05

class buttons {
var $value;
var $name;
var $onclick;
var $type;
var $windowlocation;
var $lmnbutton;
function lmnbutton($value,$name,$onclick,$windowlocation)
{
    If ($windowlocation)
    {
    }
    ELSE
    {
    $windowlocation="parent.location";
    }

    $this->button="<button onclick=\"".$onclick."\" class=\"lmnbutton\" name=\"".$name."\" >".$value."</button>";
}
function wactionbutton($value, $name,$formname,$onclick)
{
$len=strlen($value)*8;
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
$wbutton .="<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
$wbutton .=" <button class=\"lmnbutton\" name=\"_action\" type=\"submit\" value=\"".$value."\">".$value."</button></FORM>";
$this->button=$wbutton;
}
function lmnnavbutton($value,$name,$onclick,$windowlocation,$bgimage)
{
If (isset($windowlocation))
{
}
ELSE
{
$windowlocation="parent.location";
}
$width=strlen($value)*8+4;
echo "<button onclick=\"{$windowlocation}='{$onclick}'\" class=\"lmnbutton\" style=\"width:".$width."; background-image: {$bgimage};\" name=\"{$name}\"  >{$value}</button>";
}
function webadminnavbutton($value,$name,$onclick,$windowlocation,$bgimage)
{
If (isset($windowlocation))
{
}
ELSE
{
$windowlocation="parent.location";
}
$width="100px";
echo "<button onclick=\"{$windowlocation}='{$onclick}'\" class=\"lmnbutton\" style=\"width:100px; background-image: {$bgimage};\" name=\"{$name}\"  >{$value}</button>";
}
function lmnlowermenu($value,$name,$onclick,$windowlocation,$bgimage)
{


If (isset($windowlocation))
{
}
ELSE
{
$windowlocation="parent.location";
}
$bgimage="http://www.louisvillemusicnews.net/webmanager/images/graytabdown.gif";
$width=strlen($value)*9+4;
echo "<button onclick=\"{$windowlocation}='{$onclick}'\" class=\"lowermenubutton\" style=\"width:".$width."px; background-image: {$bgimage};\" name=\"{$name}\"  >{$value}</button>";
}
function leftnavlinker($value, $name, $formname,$onclick, $type)
{
	If ($windowlocation)
	{
	}
	ELSE
	{
		$windowlocation="parent.location";
	}
	//echo "<form name=\"{$formname}\" action=\"{$onclick}\" method=\"POST\">";
	echo "<div class=\"lmnbuttonlmnlink\"><a href=\"{$onclick}\"  class=\"lmnbuttonlmnplain\" >{$value}</a></div>";
//echo "<form name=\"{$formname}\" method=\"POST\">";
//echo " <input type=\"button\" class=\"lmnbuttonlmn\" name=\"_action\" type=\"submit\" value=\"{$value}\" onclick=\"leftnavlinker('{$onclick}')\"></button></form>";
}
function topmenubuttonnew($type,$name,$value,$onclick, $buttonwidth)
{
	$len=(($value=="Louisville Music News, Inc.") ? strlen($value)*8+4 : strlen($value)*9+4);
echo "<form name=\"{$formname}\" action=\"{$onclick}\" method=\"POST\" class=\"disappear\">";
}
function hiddenbutton($type,$name,$value,$onclick,$buttonwidth,$buttonheight)
{
	$len=strlen($value)*9+4;
echo "<form name=\"{$formname}\" action=\"{$onclick}\" method=\"POST\" class=\"hiddenbutton\" >";
echo "<a href=\"$onclick\" class=\"hiddenbutton\">$value</form>";
}
function topmenubutton($type,$name,$value,$onclick, $buttonwidth)
{
echo "<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"lmnmenubuttontop\" style=\"width:".$buttonwidth."px;\">";
}
function forminputbutton($type,$name,$value,$onclick)
{
	$len=strlen($value)*9+4;

$this->button="<input type=\"".$type."\" name=\"".$name."\" value=\"".$value."\" class=\"lmnbutton\" style=\"width: ".$len.";\">";
}
function submitbuttonhidden($value, $hidden)
{
	$len=strlen($value)*8;

echo $hidden;
echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbutton fib\" >";
}

function inputbutton($type, $name, $value, $onclick)
{
	$len=strlen($value)*8;
echo "<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"lmnbutton\" style=\"width:".$len.";\" onClick=\"$onclick\"></button>";
}
function resetbutton( $name, $value, $onclick)
{
$len=strlen($value)*9;
echo "<input type=\"reset\" name=\"$name\" value=\"$value\" class=\"lmnbutton\" style=\"width:".$len.";\"></button>";
}
function submitbutton($value)
{
	$len=strlen($value)*9;

echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbutton\" style=\"width:".$len.";\">";
}
function actionbutton($value)
{
	$len=strlen($value)*8;
    $this->len=$len;
$this->button="<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbutton\" style=\"width:".$this->len.";\">";
}
function menubutton($value)
{
echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbutton\" >";
}
function containedmenubutton($value, $name,$formname,$onclick)
{
	$len=strlen($value)*9;
	If ($windowlocation)
	{
	}
	ELSE
	{
	$windowlocation="parent.location";
	}
	$btn .="<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
	$btn .="<button class=\"lmnbutton\" name=\"".$name."\" type=\"submit\" value=\"".$value."\" style=\"width:".$len."\">".$value."</button></FORM>";
	$this->button=$btn;
}
function bottomcontainedmenubutton($value, $name,$formname,$onclick)
{
$len=strlen($value)*8+4;

If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
echo " <button class=\"lmnbuttonbottom\" style=\"width:".$len.";style=\"width:".$len.";\" name=\"".$name."\" type=\"submit\" value=\"".$value."\">$value</button></FORM>";
}
function rightcolbutton($value,$fontsize)
{
$len=strlen($value)*9;
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"rightlmnbutton\" style=\"width:".$len.";\" >";
}
function newwindowbutton($value, $name,$formname,$onclick, $winw, $winh)
{
$this->button="";
    $len=strlen($value);
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
$window_width=(!isset($winw) ? "" : "width=".$winw.",");
$window_height=(!isset($winh) ? "" : "height=".$winh.",");
$onclickaction=(!isset($formname) ? $onclick : $formname."?_action=".$onclick);
$this->button .= "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
$this->button .= " <button class=\"lmnbutton\" name=\"{$name}\" type=\"submit\" value=\"".$value."\" style=\"height:".$winh."; width:".$winw.";\"><a href=\"".$onclickaction."\"
onClick=\"window.open(this.href, 'admincatsform', '".$window_width." ".$window_height." menubar=yes, toolbar=yes, scrollbars=no, resizeable=0');  return false\" class=\"popup\" target=\"_blank\"> $value</a></button></FORM>";
//$this->button .= " <button class=\"lmnbutton\" name=\"{$name}\" type=\"submit\" value=\"".$value."\"><a href=\"".$onclickaction."\"
// onClick=\"window.open(this.href, 'admincatsform', '".$window_width." ".$window_height." menubar=yes, toolbar=yes, scrollbars=no, resizeable=0');  return false\" class=\"popup\" target=\"_blank\"> $value</a></button></FORM>";
}
function newblogbutton($value, $name,$formname,$onclick, $winw, $winh,$class)
{
$this->button="";
    $len=strlen($value);
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
$window_width=(!isset($winw) ? "" : "width=".$winw.",");
$window_height=(!isset($winh) ? "" : "height=".$winh.",");
$onclickaction=(!isset($formname) ? $onclick : $formname."?_action=".$onclick);
$this->button .= "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
$this->button .= " <button class=\"".$class."\" name=\"{$name}\" type=\"submit\" value=\"".$value."\" style=\"height:".$winh."; width:".$winw.";\"><a href=\"".$onclickaction."\"
onClick=\"window.open(this.href, 'admincatsform', '".$window_width." ".$window_height." menubar=yes, toolbar=yes, scrollbars=no, resizeable=0');  return false\" class=\"popup\" target=\"_blank\"> $value</a></button></FORM>";
//$this->button .= " <button class=\"lmnbutton\" name=\"{$name}\" type=\"submit\" value=\"".$value."\"><a href=\"".$onclickaction."\"
// onClick=
}


function bottomsubmitbutton($value)
{
	$len=strlen($value)*9;

echo "<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"lmnbuttonbsb\" style=\"width:".$len.";\" >";
}
function bottomactionbutton($value)
{
	$len=strlen($value)*9;

echo "<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbuttonbab\" style=\"width:".$len.";\">";
}
function lmnalertbutton($value, $name,$onclick)
{
echo "<button onclick=\"$onclick\" class=\"lmnbuttontab\" name=\"".$name."\" onmouseover=\"font-weight: 'bold';\" >$value</button>";
}

function lmnbackup($value)
{
	$len=strlen($value)*9+6;

$this->button="<button name=\"BackUp\" value=\"".$value."\" class=\"lmnbutton\" onClick='history.go(-1)'>".$value."</button>";
} // end of constructor

function containedbutton2($value, $name,$formname,$onclick)
{
$len=strlen($value)*8;

If ($windowlocation)
{
}
ELSE
{
}$windowlocation="parent.location";
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
echo " <button class=\"lmnbuttoncb\" style=\"width:".$len.";\" name=\"".$name."\" type=\"submit\" value=\"".$value."\"> $value</button></FORM>";
}
function containedbutton($value, $name,$formname,$onclick)
{
$len=strlen($value)*9;

If ($windowlocation)
{
}
ELSE
{
}$windowlocation="parent.location";
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
echo " <button class=\"lmnbutton\" name=\"_action\" type=\"submit\" value=\"".$value."\"> $value</button></FORM>";
}
function containedlistbutton($value, $name,$formname,$onclick,$hidden)
{
$len=strlen($value)*9;
If (isset($windowlocation))
{
}
ELSE
{
$windowlocation="parent.location";
}
$button .="<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
$button .=" <button class=\"lmnbutton\" name=\"".$name."\" type=\"submit\" value=\"".$value."\" style=\"width:".$len.";\"> $value</button>";
$button .= $hidden;
$button .="</FORM>";
$this->button=$button;
}
function admincontainedlistbutton($value, $name,$formname,$onclick,$hidden)
{
$len="120px";
If (isset($windowlocation))
{
}
ELSE
{
$windowlocation="parent.location";
}
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";

echo " <button class=\"lmnbuttonclb\" name=\"".$name."\" type=\"submit\" value=\"".$value."\" style=\"width:".$len.";\"> $value</button>";
echo $hidden;
echo "</FORM>";
}
function defaultadminbuttons()
{
	
	$logout="http://www.louisvillemusicnews.net/test/scratch/lmadminlogout.php";
	$onclick="http://www.louisvillemusicnews.net/lmn/evententry/index.php";
	$value="Main Admin ";
	$name="Admin";
	//$admbuttons .=$this->lmnbutton($value, $name,$onclick,$windowlocation);
	$value="Back One";
	$this->lmbackup($value);
	$admbuttons .= $this->button;
	$admbuttons .="&nbsp;";
	$value="Logout";
	$name="Logout";
	$onclick="Log Out";
	$this->lmnbutton($value, $name,$onclick,$windowlocation);
	$admbuttons .=$this->button;
	$this->adminbuttons=$admbuttons;  
}
function defaultmemberbuttons()
{
		$OnClick="index.php";
		$windowlocation="parent.location";
		$this->lmnbutton("Log Out","_action", $OnClick,$windowlocation);
		$memberbuttons .=$this->button;
		$windowlocation="parent.location";
		$this->lmnbutton("Members","_action", $OnClick,$windowlocation);
		$memberbuttons .=$this->button;
		$this->memberbuttons=$memberbuttons;
}
function _actionbutton($value)
{
	$len=strlen($value)*9;

echo "<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbutton\" style=\"width:".$len.";\" >";
}
function backup($value)
{
echo "<button name=\"submit\" value=\"$value\" class=\"lmnbuttonbu\" onClick='history.go(-1)'>$value</button>";
}
function actionbuttonhidden($value, $hidden)
{
	$len=strlen($value)*8;
echo "</style>";
echo $hidden;
echo "<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbuttonabh\" style=\"width:".$len.";\" >";
}
function clearsubmitbutton($value)
{
echo "<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"clearbutton\" >";
}
function containedactionbutton($value, $name,$formname,$onclick)
{
$len=strlen($value)*8;
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\">";
echo " <button class=\"lmnbuttoncab\" name=\"_action\" type=\"submit\" value=\"".$value."\"><a class=\"lmnbuttoncab\" style=\"width:".$len.";\" href=\"#\" onclick=\"document.".$formname.".submit(".$value.");return false\"> $value</a></button></FORM>";
}
function hiddenactionbutton($value,$hidden)
{
	$len=(strlen($value)*9)+4;

echo "<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbuttonhab\" style=\"width:".$len.";\">";
echo $hidden;
}
function containedactionbuttonhidden($value, $name,$formname,$onclick,$hidden)
{
$len=(strlen($value)*7)+4;
echo "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\" class=\"disappearcenter\" style=\"width:".$len.";\">";
echo $hidden;
echo "<input type=\"submit\" name=\"".$name."\" value=\"".$value."\" class=\"lmnbuttone\" style=\"width: ".$len.";\" ></FORM>";
}
function pcontainedactionbuttonhidden($value, $name,$formname,$onclick,$hidden,$thisdirect)
{
$len=(strlen($value)*7.5)+2;
$btn .="<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\" class=\"disappear\">";
$class=($thisdirect=="ASC" ? "clmnbuttonup" : "lmnbuttondown");
$btn .="<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"".$class."\" style=\"width:".$len.";\" text-align=\"right;\" Alt=\"".$value."\">";
$btn .= $hidden;
$btn .="</FORM>";
$this->button=$btn;
}
function widecontainedactionbuttonhidden($value, $name,$formname,$onclick,$hidden)
{
$btn .="<div class=\"containerrow\"><form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\" class=\"disappearcenter\">";
$btn .= $hidden;
$btn .="<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"lmnbuttonwide\" style=\"width: 100%;\ text-align:center; \"></FORM></div>";
$this->widebutton=$btn;
}
function sorrybutton($value)
{
$len=strlen($value);
If ($windowlocation)
{
}
ELSE
{
$windowlocation="parent.location";
}
echo "<a href=\"sorrybox.html\" onClick=\"window.open(this.href, 'sorrybox', 'width=150, height=100, menubar=yes, toolbar=yes, scrollbars=no, resizeable=0');  return false\" class=\"popup\"  name=\"{$name}\" ><button class=\"lmnbuttons\">".$value."</button></a>";
}

function leftnavmenubutton($value, $name,$formname)
{
   // echo " <button class=\"lmnbuttonlnm\" name=\"".$name."\" type=\"submit\" value=\"".$value."\" > $value</button>";
echo " <input type=\"submit\" class=\"lmnbuttonlmn\" name=\"".$name."\"  value=\"".$value."\" >";
"width:".$len.";\" >";
}
function cbuttonhidden($value, $name,$formname,$onclick, $hidden)
{
$len=(strlen($value)*9);
$this->len=$len;
 $blen=$len+4;
$cbutton .=$hidden;
$cbutton .= "<form name=\"".$formname."\" action=\"".$onclick."\" method=\"POST\"><input type=\"submit\" name=\"".$name."\" value=\"".$value."\" class=\"centerlmnbutton\" style=\"width: ".$blen."px; text-align:center;\" ></form>";
$this->cbutton=$cbutton;
}
function actionbtn($value)
{
	$len=strlen($value)*9;
    $this->len=$len;
    $blen=$len+6;
    $this->actionbutton="<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"centerlmnbutton\" style=\"width:".$blen."px; text-align:center;\">";
}
function cactionbtn($value)
{
	$len=strlen($value)*9;
    $this->len=$len;
    $blen=$len+6;
    $this->actionbutton="<input type=\"submit\" name=\"_action\" value=\"".$value."\" class=\"centerlmnbutton\" style=\"width:".$blen."px; text-align:center;\">";
}
function clmnbutton($value,$name,$onclick,$windowlocation)
{
    If ($windowlocation)
    {
    }
    ELSE
    {
    $windowlocation="parent.location";
    }

    $this->button="<button onclick=\"".$windowlocation."='".$onclick."'\" class=\"clmnbutton\" name=\"".$name."\" >".$value."</button>";
}
    function cinputbutton($type, $name, $value, $onclick)
    {
	$len=strlen($value)*8;
    $this->button="<input type=\"$type\" name=\"$name\" value=\"$value\" class=\"centerlmnbutton\" style=\"width:".$len.";\" onClick=\"$onclick\"></button>";
    
    }
function submitbuttonwhidden($value, $hidden)
{
	$len=strlen($value)*8;
    $sbutton .=$hidden;
    $sbutton .="<input type=\"submit\" name=\"submit\" value=\"".$value."\" class=\"centerlmnbutton\">";
    $this->button=$sbutton;
}
function lmbackup($value)
{
	$len=strlen($value)*9+6;

$this->button="<button name=\"BackUp\" value=\"".$value."\" class=\"lmnbutton\" onClick='history.go(-1)'>".$value."</button>";
} //
}// end of class definition
?>