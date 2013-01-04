<?php
SESSION_START();
$connection="/inks/LMhdrw.inc";
//$path="C:\apache\htdocs\phpmyadmin\htdocs\website";
include ($connection);
if (!isset($_action))
{
ECHO "\$_action not set";
}
include ("../eventediting/functions.php");
//FUNCTIONS -----------------------------------------------------------------
function optionfield_outtable($connection, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname)
{
	include ($connection);
	global $keyfieldname;
	global $$keyfieldname;
		if (!$selvalue)
		{ 
		$sqlouttable="SELECT * FROM $outtable WHERE 1 ORDER BY $keyfieldname";
		$outtableresult=@mysql_query($sqlouttable,$connection4) OR DIE ("Can't open the $outtable table");
		}
		ELSE
		{
		$sqlouttable="SELECT * FROM $outtable WHERE 1  ORDER BY $keyfieldname";
		$outtableresult=@mysql_query($sqlouttable,$connection4) OR DIE ("Can't open the $outtable."); 
		} 
		$outtablelist=@mysql_fetch_array($outtableresult);
		
		DO
		{$thisfieldname=$outtablelist[$keyfieldname];
			if ($outtablelist[$fieldname]=="")
			{
			printf ("<OPTION value=\"%s\">%s</OPTION>\n",$emptyvalue,$outtablelist[$fieldname]);
			}
			ELSEIF ($outtablelist[$keyfieldname]==$selvalue)
			{
			printf ("<OPTION value=\"%s\" SELECTED>%s</OPTION>\n",$outtablelist[$keyfieldname],$outtablelist[$fieldname]);
			}
			ELSE 
			{
			printf ("<OPTION value=\"%s\">%s</option>\n",$outtablelist[$keyfieldname], $outtablelist[$fieldname]);
			}
		}
		WHILE ($outtablelist=@mysql_fetch_array($outtableresult));
		@mysql_close();
		echo "</SELECT>";
}// End of OptionField Outtable lookup
//END FUNCTIONS -----------------------------------------------------------------
		
include("/inks/LMhdrw.inc");?>
<?// BEGIN SELECTING VARIABLE INFO

//if (!$valid_user)
//{
//echo "You are not allowed to be here.";
//}
//ELSE 
//{
	$tablename="actphones";
	$primarykey="act_phoneid";
	if ($_action=="New")
	{
	$_action="Edit";
	}
	ELSEIF ($_action=="Edit")
	{
	$phonessql="SELECT *, PhoneTypes.Type AS phonetype FROM actphones 
LEFT JOIN PhoneTypes 
ON actphones.act_phonetype=PhoneTypes.PhoneTypeID
WHERE ActID='$ActID'";
	$result=@mysql_query($phonessql,$connection4) OR DIE ("Unable to select this telephone list.");
	$phones=@mysql_fetch_array($result);
	$numfields=@mysql_num_fields($result);
	$yesphones=array();
	$p=0;
		Do
		{
			if (!$phones)
			{
			}
			ELSE
			{	$pre="t_".$p;
				$type1=($phones["typeid"]-1);
				$phone.$p==$$type1;
				$yesphones=array_merge($yesphones,$phone.$p);
				$type1=strtolower($type1);
					for ($i=0; $i<$numfields; $i++) 
					{
					$fieldname= @mysql_field_name($result, $i);
					$thisfieldname=$pre.$fieldname;
					$$thisfieldname=$phones[$fieldname];
					$thisfieldnamelen=$thisfieldname."len";
					$$thisfieldnamelen=strlen($$thisfieldname);
					$$thisfieldnamecolor="blue";
					}
				$p++;
			}
		}
		WHILE ($phones=@mysql_fetch_array($result));
					$_SESSION['$p']=$p;
	}
	ELSEIF ($_action=="Update")
	{ 
			while (list ($key, $val) = each ($_REQUEST)) 
			{
			$thiskeylen=strlen($key)-4;
			$t=substr($key,3,$thiskeylen);
				if ($t==$primarykey)// find the primarykey
				{
				$oldphone .="<input type=\"hidden\" name=\"".$key."\" value=\"".$val."\">";
				}
				ELSEIF (substr($key,-1)=="1") // check to see if $key has a '1' on the end
				{
				$key1=$key; //Set $key1 to $key
				$newkeylen=strlen($key1)-1; // get the length of the key1 and subtract 1
				$oldkey=substr($key1,0,$newkeylen);// $oldkey is the value of $key1 with the trailing '1' removed
				$oldval=$_REQUEST[$oldkey];// get old values
				$newval=$_REQUEST[$key1];//get new values
				$newupdatestring_p .="$oldkey='$newval',";//adds to the update string
					if ($oldval==$newval)// '$$' calls the value of the variables $oldkey and checks it against the new val. If unchanged, set the various items below
					{
					$thiskeycolor=$oldkey."color"; //Attach 'color' to end of $oldkey name	
					$thiskeylength=$oldkey."len";// Attach 'len' to the end of $oldkey name
					$$thiskeycolor="blue"; //Set the variable to blue
					$$thiskeylength=strlen($val); // set the variable $$thiskeylength to the length of the val.
					$$oldkey=$oldval;
					$oldphone .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
					}
					ELSE // the $$oldkey is not equal to the $val, hence it has changed
					{
					$thiskeycolor=$oldkey."color";//See above
					$thiskeylength=$oldkey."len";//See above
					$$thiskeycolor="red";//see above
					$$thiskeylength=strlen($val); //see above
					$$oldkey=$newval; // sets the $$oldkey to the new value
					$oldphone .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
					}
				}
			} //END OF WHILE
	}
	ELSEIF ($_action=="Final_Update")
	{
// Creates initial update strings for all
		$thesekeys=array();
		while (list ($key, $val) = each ($_REQUEST)) // run through the query string variables
		{
		$thesekeys=array_merge($thesekeys,$key);// stuff the variables into an array
		}
		ksort($thesekeys);// sort by keys 
		$phoneval=array();//declare the phonevals array
		parse_str($_SERVER['QUERY_STRING'],$phoneval);//parse the query string into the phonevals array
		ksort($phoneval);// sort by keys
		$numvar=count($phoneval);// count the array
		$numkeys=count($thesekeys);
		$prefix="";
		$types=array();
		while (list ($key, $val) = each ($phoneval))
		{
			if (substr($key,0,2)=="t_")//selects phone values only
			{
				if ($prefix==(substr($key,0,3)))// if the phoneval has not changed
				{
				}
				ELSE
				{
				$types=array_merge($types, substr($key,0,3));// builds string of prefixes
				}
			$prefix=(substr($key,0,3));
			}
		}//end of for-next to build prefix array
//---------------------------------------------------------
		$oldprefix="";
		$numtypes=count($types);//count the array
		for ($i=0; $i<$numtypes; $i++) 
		{
		$updatestring="update".$types[$i];// create the updatestring variable name
		$$updatestring="SET ";// create the individual updatestring openings
		}
		while (list ($key, $val) = each ($thesekeys))
		{
		$thislen=strlen($val)-3;
		$newprefix=substr($val,0,3);
			if (substr($val,-1)=="1")// skip keys with a 1 at the end
			{
			}
			ELSEIF ($val=="submit" || $val=="ActID")// skip submit and thisuserid
			{
			}
			elseif (substr($val,3,4)=="phon")
			{
			}
			ELSEIF ($newprefix==$oldprefix)// if key is unchanged
			{
				$thislen=strlen($val)-3;
				if (substr($val,3,$thislen)=="act_phoneid")// if key is primary key
				{
					If (!$$val)// if the primary key is empty
					{
					$thisphone=$newprefix."act_phonenumber";
						if (!$$thisphone)// if both values are empty, set to none for processing
						{
						$$thisphone=="NONE";
						}
						ELSE
						{
						$connection="/inks/LMhdrw.inc";
						$newrec="INSERT INTO actphones VALUES ('','$ActID','','','','')";
						$result=@mysql_query($newrec) OR DIE ("Could not add new record to actphones");
						$lastid=mysql_insert_id();
						$whereupdate=$newprefix."whereupdate";
						$$whereupdate=" WHERE $primarykey='$lastid'";
						}
					}
					ELSE// primary key is not empty
					{
					$thisphoneid=$newprefix."act_phoneid";
					$thislen=strlen($val)-3;
					$whereupdate=$newprefix."whereupdate";
					$$whereupdate=" WHERE act_phoneid=".$$thisphoneid."'";
					}
				}
				ELSE // is not the primary key
				{
					if (eregi("DELETE", $$updatestring))
					{
					}
					ELSE
					{
					$thislen=strlen($val)-3;
					$$updatestring .=(substr($val,3,$thislen))."='".$phoneval[$val]."', ";
					}
				}
				$oldprefix=$newprefix;
			}
			ELSE// key prefix has changed - new phone type
			{	
				$thislen=strlen($val)-3;// set the length of the key reduced by 3
				$updatestring="update".$newprefix;// set the updatestring variable name
				if (substr($val,3,$thislen)==$primarykey)// if current key is primary key
				{
					If (!$$val)// if primarykey is null
					{
					$thisphone=$newprefix."act_phonenumber";
						if (!$$thisphone)// this type of phone has no number entered
						{
						$whereupdate=$newprefix."whereupdate";
						$$whereupdate=" No Record";// set value for later processing
						}
						ELSE// the primarykey field is empty but there is a number
						{
						$connection="/inks/LMhdrw.inc";
						$newrec="INSERT INTO actphones VALUES ('','$ActID','','','','')";
						$result=@mysql_query($newrec) OR DIE ("Could not add new record to actphones");
						$lastid=mysql_insert_id();
						$whereupdate=$newprefix."whereupdate";
						$$whereupdate=" WHERE $primarykey='$lastid'";
						}
					}
					ELSE// primary key is not null
					{
					$thisphone=$newprefix."act_phonenumber";
						if (!$$thisphone)// if the phonenumber is empty, delete the record
						{
						$updatestring="update".$newprefix;
						$thisphoneid=$newprefix."act_phoneid";
						$$updatestring="DELETE FROM actphones WHERE act_phoneid='".$$thisphoneid."'\"";
						}
						ELSE // there is a phone number
						{
						$thisphoneid=$newprefix."act_phoneid";
						$whereupdate=$newprefix."whereupdate";
						$$whereupdate=" WHERE act_phoneid ='".$$thisphoneid."'";
						}
					}
				}
				ELSE// key is not primarykey
				{
				$updatestring="update".$newprefix;
				$thislen=strlen($val)-3;
				$$updatestring .=(substr($val,3,$thislen))."='".$phoneval[$val]."', ";
				}
				$oldprefix=$newprefix;
			}
		}// end of while
		foreach($types as $key => $value) 
		{
		$updatestring="update".$value;// create the updatestring variable name
		$$updatestring=substr(trim($$updatestring),0,-1);
		$whereupdate=$value."whereupdate";
			if (eregi("No Record",$$whereupdate))
			{
			}
			ELSEIF (eregi("DELETE",$$updatestring))
			{
			$thisupdatestring=$$updatestring;
			$result=@mysql_query($thisupdatestring,$connection4) OR DIE ("Too damned much trouble to run this query: ".$thisupdatestring."");
			
			}
			ELSE
			{
			$thisupdatestring="Update actphones ".$$updatestring." ".$$whereupdate."";
			$result=@mysql_query($thisupdatestring,$connection4) OR DIE ("Too damned much trouble to run this query: ".$thisupdatestring."");

			}
		}
	}//end of Final Update
	ELSEIF ($_action=="Add New")
	{
	}
// Begin form --------------------------------------------------------
//$QUERY_STRING1 = getenv("QUERY_STRING");
//$QUERY_STRING = ereg_replace(" ", _, $QUERY_STRING1);
//echo $QUERY_STRING;
?>
</head>
<?
$tableheader="Phone Numbers";
?><table width="140" align="center" border="1"><TH colspan="5" class="th"><?php echo $tableheader; ?></th>
<tr><Td class="td3" width="12" align="right">Number</td><td class="td3" width="8">Type</td><TD class="td3" width="10">Location</td><TD class="td4" width="12">Public</td></tr>
<!-- Phones --><?
$nophones=array(1,1,2,3,7);
foreach($nophones as $key => $value) 
{
$pre="t_".$key;
$thisprimarykey=$pre.$primarykey;
$thisphonenumber=$pre."act_phonenumber";
$thisphonenumber1=$pre."act_phonenumber1";
$thisphonenumbercolor=$pre."act_phonenumbercolor";
$thisphonetype=$pre."act_phonetype";
$thisphonetype1=$pre."act_phonetype1";
$thisphonetypecolor=$pre."act_phonetypecolor";
$thislocation=$pre."act_location";
$thislocation1=$pre."act_location1";
$thislocationcolor=$pre."act_locationcolor";
$thislocationread=$pre."act_locationread";
$thispublic=$pre."act_public";
$thispublic1=$pre."act_public1";
$thispublic_cked=$pre."act_public_cked";
$thispublic_cked1=$pre."act_public_cked1";

?>
			<input type="hidden" name="<?php echo $thisprimarykey; ?>" value="<?PHP echo  $$thisprimarykey; ?>">
			<input type="hidden" name="<?php echo $thisphonenumber;?>" value="<?php echo $$thisphonenumber;?>">
			<tr><Td class="td1" >
			<input type="text" name="<?php echo $thisphonenumber1;?>" value="<?php echo $$thisphonenumber;?>" size="14" style="color:<?PHP echo $$thisphonenumbercolor;?>;" onBlur=return validatePHONE(this)></td><td class="td2">
			<input type="hidden" name="<?php echo $thisphonetype;?>" value="<?PHP echo $$thisphonetype;?>">
			<SELECT name="<?php echo $thisphonetype1;?>" style="size: 1; width: 5 em; color:<?PHP echo $$thisphonetypecolor;?>;" >
<?
			$connection="/inks/LMhdrw.inc";
			$fieldname="Type";
			$keyfieldname="PhoneTypeID";
			$outtable="PhoneTypes";
			if ($$thisphonetype=="")
			{
			$selvalue=$value;
			}
			ELSE
			{
			$selvalue=$$thisphonetype;
			}
			$emptyvalue="";
			optionfield_outtable($connection, $fieldname, $outtable,$selvalue, $emptyvalue,$keyfieldname);?>
			</td><td class="td2" align="left">
		<input type="hidden" name="<?PHP echo $thislocation;?>" value="<?PHP echo $$thislocation;?>">
			<select name="<?php echo $thislocation1;?>" size="1" style="color: <?PHP echo $$thislocationcolor;?>;" <?PHP echo $$thislocationread; ?>>
			<?PHP //$$thesechoices=$pre."locchoices";
				$thesechoices=array("Home","Office","Individual","Other");
				while (list ($key, $val) = each ($thesechoices))
				{
				$thislocation=$pre."location";
					if ($val==$$thislocation)
					{
					echo "<option value=\"".$$thislocation."\" SELECTED>$val</option>";
					}
					ELSE
					{
					echo "<option value=\"".$val."\" >$val</option>";
					}
				}
				?></select></td>
				<TD class="td4">
				<?PHP if ($$thispublic=="on")
				{ 
				$$thispublic_cked= "checked";
				}
				ELSE
				{
				$$thispublic_cked="";
				}
?><input type="hidden" name="<?PHP echo $thispublic;?>" value="<?PHP echo $$thispublic; ?>">
<input type="checkbox" name="<?PHP echo $thispublic1;?>" <?PHP echo $$thispublic_cked; ?>></td></tr>
<?	
@mysql_close();
}?>
</table>
<?			
//}


