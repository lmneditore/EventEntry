<?php
SESSION_START();
$connection="/inks/LMhdrw.inc";
//$path="C:\apache\htdocs\phpmyadmin\htdocs\website";
include ($connection);
if (!isset($_POST["action"]))
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
	$primarykey="contactinfoid";
	if ($_action=="New")
	{
	$_action="Edit";
	}
	ELSEIF ($_action=="Edit")
	{
//	$user_id=$_REQUEST["user_id"];
	//$setuser="SELECT individualid FROM persons WHERE userid=$user_id";
//	$lmusername=$_REQUEST["lmusername"];
	//$result=@mysql_query($setuser,$connection4) OR DIE (" Unable to find userid for $lmusername");
//	$userqry=@mysql_fetch_array($result);
//	$thisuserid=$userqry["individualid"];

	$phonessql="SELECT contactinfoid, phonenumber,location, public,PhoneTypeID as typeid, PhoneTypes.Type AS phonetype FROM person_phones 
LEFT JOIN PhoneTypes 
ON person_phones.phonetype=PhoneTypes.PhoneTypeID
WHERE person_id='$thisuserid'";
	$result=@mysql_query($phonessql,$connection4) OR DIE ("Unable to select this persons telephone list.");
	$phones=@mysql_fetch_array($result);
	$yesphones=array();
	$p=0;
		Do
		{
			if (!$phones)
			{
			}
			ELSE
			{
				$pre="t_".$p;
				$type1=($phones["typeid"]-1);
				$phone.$p==$$type1;
				$yesphones=array_merge($yesphones,$phone.$p);
				$type1=strtolower($type1);
				$thisnumber=$pre."phonenumber";
				$thislocation=$pre."location";
				$thisphonetype=$pre."phonetype";
				$thisphoneid=$pre."contactinfoid";
				$thispublic=$pre."public";
				$$thisphoneid=$phones["contactinfoid"];
				$$thisnumber=$phones["phonenumber"];
				$$thislocation=$phones["location"];
				$$thisphonetype=$phones["typeid"];
				$$thispublic=$phones["public"];
				$p=$p+1;
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
					$oldkeysuf=$oldkey."suf";
					$$oldkeysuf="1";
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
					$oldkeysuf=$oldkey."suf";
					$$oldkeysuf="1";
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
		$whichphone="";
		$numtypes=count($types);//count the array
		for ($i=0; $i<$numtypes; $i++) 
		{
		$updatestring="update".$types[$i];// create the updatestring variable name
		$$updatestring="SET ";// create the individual updatestring openings
		}
		while (list ($key, $val) = each ($thesekeys))
		{
		$thislen=strlen($val)-3;
			if (substr($val,-1)=="1")// skip keys with a 1 at the end
			{
			}
			ELSEIF ($val=="submit" || $val=="thisuserid")// skip submit and thisuserid
			{
			}
			ELSEIF (substr($val,0,3)==$whichphone)// if key is unchanged
			{
				$thislen=strlen($val)-3;
				if (substr($val,3,$thislen)=="contactinofid")// if key is primary key
				{
					If ($$val=="")// if the primary key is empty
					{
					$thisphone=$val."phonenumber";
						if (!$$thisphone)
						{
						$$thisphone=="NONE";
						}
					}
					ELSE
					{
					$thislen=strlen($val)-3;
					$whereupdate="whereupdate".$whichphone;
					$$whereupdate=" WHERE   ".(substr($val,3,$thislen))."='".$phoneval[$val]."'";
					}
				}
				ELSE
				{
				$thislen=strlen($val)-3;
				$$updatestring .=(substr($val,3,$thislen))."='".$phoneval[$val]."', ";
				}
				$whichphone=substr($val,0,3);
			}
			ELSE// key prefix has changed - new phone type
			{	
				$thislen=strlen($val)-3;// set the length of the key reduced by 3
				$whichphone=substr($val,0,3);//set the phone prefix value
				$updatestring="update".$whichphone;// set the updatestring variable name
				if (substr($val,3,$thislen)==$primarykey)// if current key is primary key
				{
					If ($$val=="")// if primarykey is null
					{
					$thisphone=$whichphone."phonenumber";
						if (!$$thisphone)// this type of phone has no number entered
						{
						$whereupdate="whereupdate".$whichphone;
						$$whereupdate=" No Record";
						}
						ELSE// the primarykey field is empty but there is a number
						{
						$connection="/inks/LMhdrw.inc";
						$newrec="INSERT INTO person_phones VALUES ('','$thisuserid','','','','')";
						$result=@mysql_query($newrec) OR DIE ("Could not add new record to person_phones");
						$lastid=mysql_insert_id();
						$whereupdate="whereupdate".$whichphone;
						$$whereupdate=" WHERE $primarykey='$lastid'";
						}
					}
					ELSE
					{
					$thislen=strlen($val)-3;
					$whereupdate="whereupdate".$whichphone;
				$$whereupdate=" WHERE   ".(substr($val,3,$thislen))."='".$phoneval[$val]."'";
					}
				}
				ELSE// key is not primarykey
				{
				$updatestring="update".$whichphone;
				$thislen=strlen($val)-3;
				$$updatestring .=(substr($val,3,$thislen))."='".$phoneval[$val]."', ";
				}
				$whichphone=substr($val,0,3);
			}
		}
		foreach($types as $key => $value) 
		{
		$updatestring="update".$value;// create the updatestring variable name
		$$updatestring=substr(trim($$updatestring),0,-1);
		$whereupdate="whereupdate".$value;
			if (eregi("No Record",$$whereupdate))
			{
			}
			ELSE
			{
			$fullupdate="Update person_phones ";
			$thisupdatestring=$fullupdate.$$updatestring." ".$$whereupdate;
			$result=@mysql_query($thisupdatestring,$connection4) OR DIE ("Too much trouble to run this query");

			}
		}
		//$fullupdate .=$thisupdatestring;
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
$thisphonenumber=$pre."phonenumber";
$thisphonenumber1=$pre."phonenumber1";
$thisphonenumbercolor=$pre."phonenumbercolor";
$thisphonetype=$pre."phonetype";
$thisphonetype1=$pre."phonetype1";
$thisphonetypecolor=$pre."phonetypecolor";
$thislocation=$pre."location";
$thislocation1=$pre."location1";
$thislocationcolor=$pre."locationcolor";
$thislocationread=$pre."locationread";
$thispublic=$pre."public";
$thispublic1=$pre."public1";
$thispublic_cked=$pre."public_cked";
$thispublic_cked1=$pre."public_cked1";
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
<?	}?>
</table>
<?			
//}


