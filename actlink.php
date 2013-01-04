<?PHP session_start(); 

include ("classes/newtablerecordclass.php");
$cnxn=new lm_netconnection;
$tablename="act_links";
//--------------FUNCTIONS----------------------------------------------
/// includes 
// Uncomment when ready for protected mode.
session_register("ActID");
if (!isset($user_id))
{

echo "<Table align=\"center\" width=\"500\" class=\"centertable\"><tr><td align=\"center\">";
 echo "You are not registered or are not authorized to be here. Please click the button below.";
 echo "</td></tr><tr><td align=\"center\">";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/lmlogin.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton("Log In","", $OnClick,$windowlocation);
echo "</td></tr></table>";
}
ELSE 
{
	//include ("/inks/LMhdrw.inc");
	$grabid="SELECT user_id FROM persons where user_id='$user_id'";
	$result=@mysql_query($grabid,$connection4) OR DIE ("Unable to complete $valid_user  confirmation query.");
	$thisid=@mysql_fetch_array($result);
	$thisuser_id=$thisid["user_id"];
	@mysql_close();
	//$connection="/inks/LMHeader.php";
	//Set variables here
	$url="";
	$today=date("Y-m-d");
//	$tablename="act_links";
	$primarykey="act_link_id";
	//$_SESSION['tablename']=$tablename;
//	$_SESSION['primarykey']=$;
	if (!isset($_POST["action"]))
	{
	echo "Table align=\"center\" width=\"500\" class=\"centertable\"><tr><td align=\"center\">";
	 echo "echo \"You've come in the wrong way. Please click the button below.";
	 echo "</td></tr><tr><td align=\"center\">";
	$OnClick="http://www.louisvillemusicnews.net/eventediting/lmlogin.php";
	$windowlocation="parent.location";
	$buttons->lmnbutton("Log In","", $OnClick,$windowlocation);
	echo "</td></tr></table>";
	}
	ELSE// There is a submit variable
	{
		IF ($_action=="Edit")
		{// selects the record for $thisuser_id to edit
		
			If ($ActName)
			{
			session_register("ActName");
			}
			$connection="/inks/LMhdrw.inc";
			include ($connection);
			$tableheader="Edit Current Act Link Information";
			$sqledit="SELECT * FROM $tablename WHERE act_link_id=$act_link_id";
			$result=@mysql_query($sqledit,$connection4) OR DIE ("Unable to $sqledit ");
			$thisrec=@mysql_fetch_array($result);
			$numfields=@mysql_num_fields($result);
				for ($i=0; $i<$numfields; $i++)
				{// creates and determines variables and values. Strips slashes from all string fields
				$thisfieldname=mysql_field_name($result, $i);
				$thisfieldtype=mysql_field_type($result,$i);
				
					if ($thisfieldtype=="string")
					{
					$thisfieldval=strip_tags(str_replace("\\", "", $thisrec[$thisfieldname]),'<a> <b> <i> </i> </b> </a>');
//					$thisfieldval=stripslashes($thisfieldval);
					}
					ELSE
					{
					$thisfieldval=$thisrec[$thisfieldname];
					}
				$$thisfieldname=$thisfieldval;
				$$thisfieldname=stripslashes($$thisfieldname);
				$thisfieldnamelen=$thisfieldname."len";
				$thisfieldnamecolor=$thisfieldname."blue";
				$$thisfieldnamecolor="blue";
				$$thisfieldnamelen=strlen($thisfieldval);
				$oldname .="<input type=\"hidden\" name=\"".$thisfieldname."\" value=\"".$thisfieldval."\">";
$ActID=$act_link_ActID;
				}
		}
		ELSEIF ($_action=="New")
		{
		$tableheader="Enter the act link information and click 'Add_'New";
		}
		ELSEIF ($_action=="Add_New")
		{
		$n=new newrecord;
		$n->newtablerecord($tablename,$connection);
		$newid=$n->newrecordid;
		
		
		$updatestring="UPDATE $tablename SET ";
			while (list ($key, $val) = each ($_REQUEST)) 
			{
				IF (($key=="ActName") || ($key="ActID"))
				{
				$key=$value;
				}
				ELSEIF($key=="act_link_id")
				{
				$tag=" WHERE act_link_id='".$newid."'";
				}
				ELSEIF ($key=="submit" )
				{//Ignore submit
				}
				ELSEif (substr($key,-1)=="1") // check to see if $key has a '1' on the end
				{
						$key1=$key; //Set $key1 to $key
						$newkeylen=strlen($key1)-1; // get the length of the key1 and subtract 1
						$oldkey=substr($key1,0,$newkeylen);// $oldkey is the value of $key1 with the trailing '1' removed
						$newval=$_REQUEST[$key1];
						$upnewval=addslashes($newval);
						$updatestring .="$oldkey='$upnewval',";//adds to the update string
				}
				ELSE // if key is old value, do nothing
				{
				}
			} //END OF WHILE
				$updatestring=trim($updatestring);
				$len=strlen($updatestring)-1;
				if (substr($updatestring,$len,1)==",")
				{
				$updatestring=substr($updatestring,0,($len));
				$updatestring=$updatestring.$tag;
				include("/inks/LMhdrw.inc");
				$updatesql=mysql_query($updatestring) OR DIE ("Unable to complete updatestring new query: {$updatestring}");
				}
				$newck="SELECT * FROM {$tablename} WHERE act_link_id='{$newid}'";
				$result=@mysql_query($newck) OR DIE ("Unable to complete query: {$newck}");
				$newrecord=@mysql_fetch_array($result);
				$numfields=@mysql_num_fields($result);
				Do 
				{
				for ($i=0; $i<$numfields; $i++) 
					{
					$fieldname= mysql_field_name($result, $i);
					$$fieldname=$newrecord[$fieldname];
					}
				}
				WHILE ($newrecord=@mysql_fetch_array($result));
		}
		ELSEIF ($_action=="Update") // This section looks for values in the query string.
		{
			$tableheader="Are you sure you have the correct information?";
			while (list ($key, $val) = each ($_REQUEST)) 
			{
				IF ($key==$primarykey)
				{
				$oldname .="<input type=\"hidden\" name=\"".$key."\" value=\"".$val."\">";
				}
				ELSEIF ($key=="submit" )
				{//Ignore submit
				}
				ELSEIF (substr($key,-1)=="1") // check to see if $key has a '1' on the end
				{
						$key1=$key; //Set $key1 to $key
						$newkeylen=strlen($key1)-1; // get the length of the key1 and subtract 1
						$oldkey=substr($key1,0,$newkeylen);// $oldkey is the value of $key1 with the trailing '1' removed
						$oldval=$_REQUEST[$oldkey];
						$newval=$_REQUEST[$key1];
							if ($oldval==$newval)// '$$' calls the value of the variables $oldkey and checks it against the new val. If unchanged, set the various items below
							{
							$thiskeycolor=$oldkey."color"; //Attach 'color' to end of $oldkey name	
							$thiskeylength=$oldkey."len";// Attach 'len' to the end of $oldkey name
							$$thiskeycolor="blue"; //Set the variable to blue
							$$thiskeylength=strlen($val); // set the variable $$thiskeylength to the length of the val.
							$$oldkey=$oldval;
							$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
							}
							ELSE // the $$oldkey is not equal to the $val, hence it has changed
							{
							$thiskeycolor=$oldkey."color";//See above
							$thiskeylength=$oldkey."len";//See above
							$$thiskeycolor="red";//see above
							$$thiskeylength=strlen($val); //see above
							$$oldkey=$newval; // sets the $$oldkey to the new value
							$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
							}
				}
				ELSE // if key is old value, do nothing
				{
				}
			} //END OF WHILE
		}
		ELSEIF ($_action=="Final_Update")
		{
		$tableheader="Updated Act Link information has been accepted.";
		$updatestring="UPDATE $tablename SET ";
			while (list ($key, $val) = each ($_GET)) 
			{
				IF ($key=="ActName")
				{
				}
				ELSEIF($key=="act_link_id")
				{
				$tag=" WHERE act_link_id='".$act_link_id."'";
				}
				ELSEIF ($key=="submit" )
				{//Ignore submit
				}
				ELSEif (substr($key,-1)=="1") // check to see if $key has a '1' on the end
				{
						$key1=$key; //Set $key1 to $key
						$newkeylen=strlen($key1)-1; // get the length of the key1 and subtract 1
						$oldkey=substr($key1,0,$newkeylen);// $oldkey is the value of $key1 with the trailing '1' removed
						$oldval=$_REQUEST[$oldkey];
						$newval=$_REQUEST[$key1];
						$upnewval=addslashes($newval);
						$updatestring .="$oldkey='$upnewval',";//adds to the update string
							if ($oldval==$newval)// '$$' calls the value of the variables $oldkey and checks it against the new val. If unchanged, set the various items below
							{
							$thiskeycolor=$oldkey."color"; //Attach 'color' to end of $oldkey name	
							$thiskeylength=$oldkey."len";// Attach 'len' to the end of $oldkey name
							$$thiskeycolor="blue"; //Set the variable to blue
							$$thiskeylength=strlen($val); // set the variable $$thiskeylength to the length of the val.
							$$oldkey=$oldval;
							//$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
							}
							ELSE // the $$oldkey is not equal to the $val, hence it has changed
							{
							$thiskeycolor=$oldkey."color";//See above
							$thiskeylength=$oldkey."len";//See above
							$$thiskeycolor="red";//see above
							$$thiskeylength=strlen($val); //see above
							$$oldkey=$newval; // sets the $$oldkey to the new value
						//	$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
							}
				}
				ELSE // if key is old value, do nothing
				{
				}
			} //END OF WHILE
	$updatestring=trim($updatestring);
	$len=strlen($updatestring)-1;
			if (substr($updatestring,$len,1)==",")
			{
			$updatestring=substr($updatestring,0,($len));
			$updatestring=$updatestring.$tag;
				include("/inks/LMhdrw.inc");
			$updatesql=mysql_query($updatestring) OR DIE ("Unable to complete updatestring query");
			}
	}
	ELSEIF ($_action=="Confirm New")
	{
	$tableheader="Are you sure this is the correct new Act information?";
		while (list ($key, $val) = each ($_GET)) 
			{
				IF ($key=="submit" )
				{//Ignore submit
				}
				ELSEIF (substr($key,-1)=="1") // check to see if $key has a '1' on the end
				{
						$key1=$key; //Set $key1 to $key
						$newkeylen=strlen($key1)-1; // get the length of the key1 and subtract 1
						$oldkey=substr($key1,0,$newkeylen);// $oldkey is the value of $key1 with the trailing '1' removed
						$oldval=$_REQUEST[$oldkey];
						$newval=$_REQUEST[$key1];
							if ($oldval==$newval)// '$$' calls the value of the variables $oldkey and checks it against the new val. If unchanged, set the various items below
							{
							$thiskeycolor=$oldkey."color"; //Attach 'color' to end of $oldkey name	
							$thiskeylength=$oldkey."len";// Attach 'len' to the end of $oldkey name
							$$thiskeycolor="blue"; //Set the variable to blue
							$$thiskeylength=strlen($val); // set the variable $$thiskeylength to the length of the val.
							$$oldkey=$oldval;
							$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
							}
							ELSE // the $$oldkey is not equal to the $val, hence it has changed
							{
							$thiskeycolor=$oldkey."color";//See above
							$thiskeylength=$oldkey."len";//See above
							$$thiskeycolor="red";//see above
							$$thiskeylength=strlen($val); //see above
							$$oldkey=$newval; // sets the $$oldkey to the new value
							$oldname .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
							}
				}
				ELSE // if key is old value, do nothing
				{
				}
			} //END OF WHILE
	}
//End Of first submit
	//PRIMARYKEY & TABLENAME CHECK END
	if ($_action=="New" || $_action=="Edit")
	{
	$required="<span style=\"color: red;\">*</span>";
	}

echo "";?>
<script language="Javascript" TYPE="TEXT/JAVASCRIPT">
pagename= "actlink.php.";
forSecondaryAddress="";
<?PHP
// include("lmnformvalidation.js");
?>
</script>
<style type="text/css">
.formbody
{
background-color: #2f5266;
}
.td1
{
text-align: right;
font-weight: bold;
font-family: arial;
font-size: .8em;
}
.td2
{
text-align: left;
font-weight: bold;
font-size: .8em
}
.td3
{
text-align: center;
font-size: .6em;
font-weight: semi-bold;
font-family: arial, sansserif;
}
.td4
{
text-align: center;
font-size: .6em;
font-weight: semi-bold;
font-family: arial, sansserif;
}
.th
{
background-color: #0F3925; 
color: #ffff66; 
text-align: center; 
font-size: .8em;
text-align:center;
}
</style>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/lmn/stylesheets/LMNStyles.css" TYPE="text/css"><?PHP
//displayLMHeader();
?>
<table align="center" width="580" valign="top">
<th colspan="3" class="th"><?PHP echo $tableheader; ?></th>
<tr><td style="align:center; width:580;" colspan="3">
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET" name="actlink">
<?PHP echo $oldname; ?></td></tr>
<TR><TD class="td1">Act Name: </td><TD class="td2"><input type="text" name="ActName" value="<?PHP echo $ActName;?>"  style="color:<?PHP echo $ActNamecolor;?>;" size="<?PHP echo $ActNamelen;?> " READONLY></td></TR>
<TR><TD class="td1">Act Link URL: </td><TD class="td2"><input type="text" name="act_link_url1" value="<?PHP echo $act_link_url;?>"  style="color:<?PHP echo $act_link_urlcolor;?>;" size="<?PHP echo $act_link_urllen;?> " onblur="isEmpty(act_link_url1);" <?PHP echo $act_link_urlread;?> ><?PHP echo $required;?></td><TR>

<TR><TD class="td1">Link Title: </td><TD class="td2"><input type="text" name="act_link_title1" value="<?PHP echo $act_link_title;?>"  style="color:<?PHP echo $act_link_titlecolor;?>;" size="<?PHP echo $act_link_titlelen;?> " <?PHP echo $act_link_titleread; ?></td><TR>
<TR><TD class="td1">Description: </td><TD class="td2"><input type="text" name="act_link_descrip1" value="<?PHP echo $act_link_descrip;?>"  style="color:<?PHP echo $act_link_descripcolor;?>;" size="<?PHP echo $act_link_descriplen;?>" <?PHP echo $act_link_descrip; ?> ></td><TR>

<TR><TD class="td1">Type of Link: </td><TD class="td2"><SELECT name="act_link_categories1" size="1" style="color:<?PHP echo $act_link_categoriescolor;?>" <?PHP echo $act_link_categoriesread; ?>>
<?PHP // set variables for the optionfield lookup
	$fieldname="act_link_cat";
	$keyfieldname="act_link_cat_id";
	$outtable="act_link_categories";
	$selvalue=$act_link_categories;
	$emptyvalue="";
optionfield_outtable($connection,$fieldname,$outtable,$selvalue,$emptyvalue,$keyfieldname);
@mysql_close();
?></td><TR>

<TR><TD class="td1">Genre:</td><TD class="td2"><SELECT name="act_link_lmngenre1" size="1" style="color:<?PHP echo $act_link_lmngenrecolor;?>" <?PHP echo $act_link_lmngenreread; ?>>
<?PHP // set variables for the optionfield lookup
$keyfieldname="lmn_genre_id";
$fieldname="lmn_genre";
$outtable="lmn_genres";
$selvalue=$act_link_lmngenre;
$emptyvalue="Variety";
optionfield_outtable($connection,$fieldname,$outtable,$selvalue,$emptyvalue,$keyfieldname);
@mysql_close();
echo $required;?></td><TR>
<?PHP 
if (!$act_link_submitb)
{
$act_link_submitb=$user_id;
}
?>
<input type="hidden" name="act_link_submittedb1" value="<?PHP echo $act_link_submittedb;?>"  style="color:<?PHP echo $act_link_submittedbcolor;?>;" size="<?PHP echo $act_link_submittedblen;?>" <?PHP echo $act_link_submittedbread;?> > 
<?PHP
//-----------BEGIN SECTION FOR BUTTONS-----------------------
	IF ($_action=="Edit")
	{
	echo "<TR><TD colspan=\"2\" align=\"Center\">";
		//echo "</table>";// End of weblinks table
		echo "<TR><TD colspan=\"2\" align=\"Center\">";
		echo "<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		echo "<input type=\"hidden\" name=\"act_link_id\" value=\"".$act_link_id."\">";
		$type="submit";
		$name="submit";
		$value="Update";
		$OnClick="http://www.louisvillemusicnews.net/eventediting/actlink.php";
		forminputbutton($type, $name, $value, $OnClick);
	?> </form><?PHP
		$redo="http://www.louisvillemusicnews.net/eventediting/Actinfo.php?ActID=".$act_link_ActID."&submit=Edit";
		?>&nbsp;&nbsp;<?PHP
		$OnClick=$redo;
		$windowlocation="parent.location";
		$buttons->lmnbutton("Return","", $OnClick,$windowlocation);
		?>
	</td></tr>
	<tr><td align="center" colspan="3">
		<?PHP		 echo "<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		$buttons->defaultmemberbuttons();
		$buttons->memberbuttons;
		?></td></tr>
		<BR></table><?PHP
		@mysql_close($connection);
	}
	ELSEIF ($_action=="Update")
	{
echo "</td></tr></table>";
		 echo "<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		?><TR><TD colspan="3" align="Center"><?PHP
		$type="submit";
		$name="submit";
		$value="Final_Update";
		$OnClick="http://www.louisvillemusicnews.net/eventediting/actlink.php";
		forminputbutton($type, $name, $value, $OnClick);?>
		</form>
		<?PHP
		$redo="http://www.louisvillemusicnews.net/eventediting/Actinfo.php?ActID=".$act_link_ActID."&submit=Edit";
		?>&nbsp;&nbsp;<?PHP
		$OnClick=$redo;
		$windowlocation="parent.location";
		$buttons->lmnbutton("Return","", $OnClick,$windowlocation);
		?>
		<tr><td align="center" colspan="3">
		<?PHP echo "<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		defaultmemberbuttons();
		?></td></tr></table></td></tr></table>
		<?PHP	@mysql_close($connection);
	}
	ELSEIF ($_action=="Final_Update")
	{
echo "</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
?> <tr><td align="center" colspan="3">
</form><?PHP
		$redo="http://www.louisvillemusicnews.net/eventediting/Actinfo.php?ActID=".$act_link_ActID."&submit=Edit";
		?>&nbsp;&nbsp;<?PHP
		$OnClick=$redo;
		$windowlocation="parent.location";
		$buttons->lmnbutton("Return","", $OnClick,$windowlocation);?>
 <tr><td align="center" colspan="3">
		<?PHP echo "<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		$buttons->defaultmemberbuttons();
		$buttons->memberbuttons;
		// buttonrow ("Continue",""); 
		?>
		</td></tr></table>
		<?PHP 
		unset($updatestring);
	} 
}
}//$validuser
?>


