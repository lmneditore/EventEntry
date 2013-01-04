<?PHP
session_start();
//require ("/inks/functions.php");
//displayLMHeader();
//$method="GET";
$buttons=new buttons;
IF($_action=="Search_Again" || $_action=="Select An Act")
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
	<?
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
	//echo $buttons->button;
	echo "&nbsp;";
	$buttons->defaultmemberbuttons();
	echo $buttons->memberbuttons;?>
	<hr width="320" size="1 px" align="center">
	</td></tr></table>
	<?
}
ELSEIF($_action=="Find Act") 
{
?><table class="centertable" align="central"><TH class="IssueHdr" colspan="2"> Currently Listed Acts With Names Matching * <?php echo $thisactname;?> *</TH><tr><TD>
			<FORM action="index.php" method="post"><?
	//include("/inks/LMHeader.inc");
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
				echo "<tr><TD class=\"tdc\" colspan=\"2\" align=\"center\">";
				echo "<a href=\"index.php?_action=this_act&ActID=".$list["ActID"]."\">";
				 echo $list["ActName"];?></a></td></tr><?
			}
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
				echo "<tr><TD class=\"tdc\" align=\"center\" colspan=\"2\">";
				echo "<a href=\"index.php?_action=this_act&ActID=".$list["ActID"]."\">";
				echo $list["ActName"];?></a></td></tr><?
				}
				WHILE ($list=@mysql_fetch_array($result));
			}
		}
	}
			mysql_close($connection4);
}
?></td></tr></form><TR><TD class=\"td1\" colspan="2" align="Center">
<hr width="120" size="1 px">
<?PHP
$type="input";
$name="_action";
$value="Search_Again";
$OnClick="searchact.php?_action=Find_Act";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);?>
<hr width="120" size="1 px">
<tr><td colspan="2" align="center"><?
$value="Add New Act";
$name="_action";
$OnClick="Index.php";
$windowlocation="parent.location";
$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
echo "<hr width=\"260\" size=\"1 pt\">";
$buttons->defaultmemberbuttons();
echo $buttons->memberbuttons;
?>
<hr width="120" size="1 px">
</td></tr>
<? 
//} end of if action 
session_unregister("_action");
?>
</table>


