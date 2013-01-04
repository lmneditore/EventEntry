<?PHP
session_start();
//require ("/inks/functions.php");
//displayLMHeader();
//$method="GET";
if (class_exists("buttons")=="TRUE")
	{
$buttons=new buttons;
	}
	else
	{
		echo "No buttons";
	}
IF($_action=="Search_Again" || $_action=="Select An Act" )
{
	$tableheader="Look Up An Act";
	?>
	<table class="centertable" align="center"><TH class="IssueHdr" colspan="2" align="center"><?PHP echo $tableheader; ?></th>
	<TR><TD class=\"td1\" colspan ="2">
	<form action="index.php" method="post"></td></TR>
	<tr><td class="tdl" align="right">Enter Act Name: </td><td class="td2">
	<input type="text" name="thisactname" value="" size="25"></td></tr>
	<tr><td colspan="2" align="center">
	<hr width="120" size="1 px">
	<?PHP
	$type="submit";
	$name="_action";
	$value="Find Act";
	$buttons->forminputbutton($type, $name, $value,$onClick);
	echo $buttons->button;
	?>
	</td></tr>	</form>
	<tr><td align="center" colspan="2">
	<hr width="320" size="1 px" align="center">
	<?
	$value="Add New Act";
	$name="_action";
	$OnClick="index.php";
	$windowlocation="parent.location";
	$formname="newact";
	$buttons->wactionbutton($value, $name,$formname,$OnClick);
	echo $buttons->button;
	echo "&nbsp;";
	$buttons->defaultadminbuttons();
	echo $buttons->adminbuttons;?>
	<hr width="320" size="1 px" align="center">
	</td></tr></table>
	<?php
}
ELSEIF($_action=="Find Act") 
{
?><div class="centertable" style="text-align:center;" > Currently Listed Acts With Names Matching * <?php echo $thisactname;?> *<br /><br /></div>
			<FORM action="index.php" method="post"><?
	$newstring=explode(" ",$thisactname);
	$numchunks=count($newstring);
	while (list ($key, $val) = each ($newstring))
	{
		if($val==("The"))
		{
		}
		ELSEIF ($val=="Band")
		{
		}
		ELSEIF (strlen($val)<5)
		{
		$lval=strtolower($val);
		$lval="%".$lval."%";
		$sql="SELECT LCASE(Acts.ActName), Acts.ActID, Acts.ActName
		FROM Acts WHERE (LCASE(Acts.ActName) LIKE '$lval')";
		$result=@mysql_query($sql) OR DIE ("Unable to complete this act search". $sql."");
		$numrows=@mysql_num_rows($result);
		$list=@mysql_fetch_array($result);
		DO
			{
				echo "<DIV class=\"tdc\" style=\"text-decoration:none;\">";
				echo "<a href=\"index.php?_action=this_act&ActID=".$list["ActID"]."\">";
				 echo $list["ActName"]."</a></div>";			}
			WHILE ($list=@mysql_fetch_array($result));
		}
		ELSE
		{
		$pval=substr($val,1,-1);
		$pval="%".$pval."%";
		$sql="SELECT LCASE(Acts.ActName), Acts.ActID, Acts.ActName
		FROM Acts
		WHERE (LCASE(Acts.ActName) LIKE '$pval')";
		$result=@mysql_query($sql) OR DIE ("Unable to complete this act search". $sql."");
		$numrows=@mysql_num_rows($result);
		$list=@mysql_fetch_array($result);
			if (!$numrows)
			{
			}
			ELSE
			{
				DO
				{
					echo "<DIV class=\"tdc\" style=\"text-decoration:none;\">";
				echo "<a href=\"index.php?_action=this_act&ActID=".$list["ActID"]."\">";
				echo $list["ActName"]."</a></div>";
				}
				WHILE ($list=@mysql_fetch_array($result));
			}
		}
	}
			mysql_close($connection);
}
echo "</form><div class=\"tdc\">";
IF($_action=="Find Act") 
{
$buttons=new buttons;
$type="input";
$name="_action";
$value="Search_Again";
$OnClick="index.php?_action=Select An Act";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo $buttons->button;
}
?></div>
<hr width="120" size="1 px">
<div><?PHP
$value="Add New Act";
$name="_action";
$OnClick="Index.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
//echo "<hr width=\"260\" size=\"1 pt\">";
$buttons->defaultadminbuttons();
//echo $buttons->adminbuttons;
echo "</div>";
//} end of if action 
session_unregister("_action");
?>



