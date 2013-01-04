<?php
SESSION_START();
	echo "included";
$cnxn=new lm_netconnection;
//$path="C:\apache\htdocs\phpmyadmin\htdocs\website";
$_action=$_GET["_action"];
if (!isset($_POST["action"]))
{
ECHO "\$_action not set";
}
//include ("../eventediting/functions.php");
//FUNCTIONS -----------------------------------------------------------------
		

// BEGIN SELECTING VARIABLE INFO

//if (!$valid_user)
//{
//echo "You are not allowed to be here.";
//}
//ELSE 
//{
	$primarykey="act_link_id";
	if ($_action=="New")
	{
	$_action="Edit";
	}
	ELSEIF ($_action=="Edit" || $_action=="this_act")
	{
	
//	$user_id=$_REQUEST["user_id"];
	//$setuser="SELECT individualid FROM persons WHERE userid=$user_id";
//	$lmusername=$_REQUEST["lmusername"];
	//$result=@mysql_query($setuser) OR DIE (" Unable to find userid for $lmusername");
//	$userqry=@mysql_fetch_array($result);
//	$thisuserid=$userqry["individualid"];
echo $dbname;
$dbname="louisvil_louisvillemusic2";
$cnxn-> lm_connection($dbname);
	$linkssql="SELECT *, act_link_cat, act_link_cat_description, lmn_genre FROM act_links LEFT JOIN act_link_categories ON act_links.act_link_categories=act_link_categories.act_link_cat_id LEFT JOIN lmn_genres ON act_links.act_link_lmngenre=lmn_genres.lmn_genre_id WHERE act_link_ActID='".$ActID."'";
	$result=@mysql_query($linkssql) OR DIE ("Unable to select this act link list.");
	$links=@mysql_fetch_array($result);
	$yeslinks=array();
	$p=0;
		Do
		{
			if (!$links)
			{
			}
			ELSE
			{
				$pre="l_".$p;
				$type1=($links["act_link_categories"]-1);
				$link.$p==$$type1;
				$yeslinks=array_merge($yeslinks,$link.$p);
				$type1=strtolower($type1);
				$thislinkid=$pre."act_link_id";
				$thislinkurl=$pre."act_link_url";
				$thislinkurlcolor=$pre."act_link_urlcolor";
				$thislinkurllen=$pre."act_link_urllen";
				$thislinktitle=$pre."act_link_title";
				$thislinktitlecolor=$pre."act_link_titlecolor";
				$thislinktitlelen=$pre."act_link_titlelen";
				$thislinktype=$pre."act_link_categories";
				$thislinktypecolor=$pre."act_link_categoriescolor";
				$thislinktypelen=$pre."act_link_categorieslen";
				$thisdescrip=$pre."act_link_descrip";
				$thisdescripcolor=$pre."act_link_descripcolor";
				$thisdescriplen=$pre."act_link_descriplen";
				
				$$thislinkid=$links["act_link_id"];
				$$thislinkurl=$links["act_link_url"];
				$linklen=strlen($$thislinkurl);
				$$thislinklen=$linklen;
				$$thislinktitle=$links["act_link_title"];
				$$thislinktitle=stripslashes($$thislinktitle);
				$thislinktitlelen=strlen($$thislinktitle);
				$$thislinktype=$links["act_link_categories"];
				$$thislinktypelen=strlen($$thislinketype);
				$$thisdescrip=$links["act_link_descrip"];
				$$thisdescrip=stripslashes($$thisdescrip);
				$$thisdescriplen=strlen($$thisdescrip);
				$$thisdescripcolor="blue";
				$$thislinktypecolor="blue";
				$$thislinktitlecolor="blue";
				$$thislinkurlcolor="blue";
				$p=$p+1;
			}
		}
		WHILE ($links=@mysql_fetch_array($result));
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
				$oldlink .="<input type=\"hidden\" name=\"".$key."\" value=\"".$val."\">";
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
					$oldlink .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">";
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
					$oldlink .="<input type=\"hidden\" name=\"".$oldkey."\" value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
					}
				}
			} //END OF WHILE
	}
	ELSEIF ($_action=="Final_Update")
	{
	
// Creates initial update strings for all records, including new ones
		$thesekeys=array();// setup an array
		while (list ($key, $val) = each ($_GET)) // run through the query string variables
		{
		$thesekeys=array_merge($thesekeys,$key);// stuff the variables into an array
		}
		ksort($thesekeys);// sort by keys 
		$linkval=array();//declare the linkvals array
		parse_str($_SERVER['QUERY_STRING'],$linkval);//parse the query string into the linkvals array
		ksort($linkval);// sort by keys
		$numvar=count($linkval);// count the array
		$numkeys=count($thesekeys);// count the number of keys in the query_string
		$prefix="";// set the prefix to empty
		$types=array();// create an array of types of prefixes /*
		while (list ($key, $val) = each ($linkval)) // loop through the linkval array
		{
			if (substr($key,0,2)=="l_")//selects link values only
			{
				if ($prefix==(substr($key,0,3)))// if the linkval has not changed
				{
				}
				ELSE
				{
				$types=array_merge($types, substr($key,0,3));// builds string of prefix types
				}
			$prefix=(substr($key,0,3));// set the prefix to the current value for checking above
			}
		}//end of for-next to build prefix array
//-------------------------------------------------------------------------------------------
/*		$numtypes=count($types);//count the array of kinds of prefixes
		for ($i=0; $i<$numtypes; $i++) //build a loop for prefixes
		{
		$updatestring="update".$types[$i];// create the updatestring variable name
		$$updatestring .="SET ";// create the individual updatestring openings with the appropriate prefix
		} */
		$whichprefix="";// set the variable for linkcheck to empty
		//Begin loop to check values of query string
		while (list ($key, $val) = each ($thesekeys))
		{
		$thislen=strlen($val)-3;
		$thisprefix=(substr($val,0,3));
		$val=strip_tags($val);
			if (substr($val,-1)=="1")// skip keys with a 1 at the end
			{
			}
			ELSEIF ($val=="submit")// skip submit 
			{
			}
			ELSEIF ($val=="ActID") // ignore the ActID
			{
			}
			ELSEIF ($thisprefix==$whichprefix)// test to see if the if prefix is unchanged
			{
			$thislen=strlen($val)-3; // find the current key length without the prefix
				if (substr($val,3,$thislen)=="act_link_id")// check to see if the current key is primary.
				{
					If (!$$val)// if the primary key is empty 
					{ // if primary key is empty, scheck to see if the act_link_url is empty
						$thislink=$whichprefix."act_link_url";// create url name for display of primary data
						if (!$$thislink) // Check to see if the url value is empty
						{
						$whereupdate=$whichprefix."whereupdate";
						$$whereupdate=" No Record";
						}
						ELSE // The primary key is empty but there is a URL so the record is new
						{
						$connection="/inks/LMhdrw.inc";
						$newrec="INSERT INTO act_links VALUES ('','$ActID','','','','','','','','','','','','')";
							$result=@mysql_query($newrec) OR DIE ("Could not add new record to act_links");
							$lastid=mysql_insert_id();
							$whereupdate=$whichprefix."whereupdate";
							$$whereupdate=" WHERE $primarykey='$lastid'";
						}
					}
					ELSE // The primary key is not empty; continue updatestring
					{
						$thislink=$whichprefix."act_link_url";
						if (!$$thislink) // Check to see if the url value is empty
						{
						$$updatestring="Delete FROM act_links WHERE act_link_id='".$$val."';\n";//
						}
						ELSE // primary key & url are not empty
						{
						$thislen=strlen($val)-3;
						$whereupdate=$whichprefix."whereupdate";
						$$whereupdate=" WHERE ".(substr($val,3,$thislen))."='".$$val."'";
						}
					}
				}
				ELSE // not the primary key
				{
					if (eregi("Delete",$$updatestring))
					{
					}
					ELSE
					{
					$thislen=strlen($val)-3;
					$$updatestring .=(substr($val,3,$thislen))."='".$$val."', ";
					}
				}
			}
			ELSE // whichprefix has changed 
			{
			if ($whichprefix=="")
			{
			$whichprefix="l_0";
			}
			ELSE
			{
			$whichprefix=substr($val,0,3);
			}
			$updatestring=$whichprefix."update";
			$$updatestring="";
			$thislen=strlen($val)-3; // find the current key length without the prefix
				if (substr($val,3,$thislen)=="act_link_id")// check to see if the current key is primary.
				{
					If (!$$val)// if the primary key is empty 
					{ // if primary key is empty, scheck to see if the act_link_url is empty
						$thislink=$whichprefix."act_link_url";// for display of primary data
						if (!$$thislink) // Check to see if the url value is empty
						{
						$whereupdate=$whichprefix."whereupdate";
						$$whereupdate=" No Record";// if both are empty, there is no record to update or add.	
						}
						ELSE // The primary key is empty but there is a URL so the record is new
						{
						$connection="/inks/LMhdrw.inc";
						$newrec="INSERT INTO act_links VALUES ('','$ActID','','','','','','','','','','','')";
							$result=@mysql_query($newrec) OR DIE ("Could not add new record to act_links");
							$lastid=mysql_insert_id();
							$whereupdate=$whichprefix."whereupdate";
							$$whereupdate=" WHERE act_link_id='$lastid'";
						}
					}
					ELSE // The primary key is not empty; continue updatestring
					{
					$thislink=$whichprefix."act_link_url";// for display of primary data
						if (!$$thislink) // Check to see if the url value is empty
						{// primary key is not empty; url is empty; delete the record
						$$updatestring="Delete FROM act_links WHERE act_link_id='".$$val."';\n";//
						}
						ELSE
						{
						$thislen=strlen($val)-3;
						$whereupdate=$whichprefix."whereupdate";
						$$whereupdate=" WHERE ".(substr($val,3,$thislen))."='".$$val."'";
						}
					}
				}
				ELSE // not the primary key
				{
				if (eregi("Delete",$$updatestring))
					{
					}
					ELSE
					{
					$thislen=strlen($val)-3;
					$$updatestring .=(substr($val,3,$thislen))."='".$$val."', ";
					}
				}
			$thisprefix=substr($val,0,3);
			}// which link end
		}// end of For-next 

//-----------------------------

		foreach($types as $key => $value) 
		{
		$updatestring=$value."update";// create the updatestring variable name
		
		$thisstringlen=strlen(trim($$updatestring))-1;
			IF (substr(trim($$updatestring),$thisstringlen,1)==",")
			{
			$$updatestring=substr(trim($$updatestring),0,-1);
			}
			$whereupdate=$value."whereupdate";
				if (eregi("No Record",$$whereupdate))
				{
				}
				ELSEIF(eregi("Delete",$$updatestring))
				{
				$thisstring .=$$updatestring;
				}
				ELSE
				{
				$thisupdatestring="Update act_links SET ".$$updatestring." ".$$whereupdate."";

				$result=@mysql_query($thisupdatestring) OR DIE ("Unable to  run this query".$thisupdatestring."");
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

<SCRIPT language="JavaScript">
function isURL(field.value) {
  var urlPattern = /^(?:(?:ftp|https?):\/\/)\S+\/$/i;
  return urlPattern.test(url.toLowerCase());
}

function checkURL (field) {
  if (!isURL(field.value)) {
    alert('Please enter correct url!');
    field.focus();
    field.select();
  }
}
</SCRIPT>


</head>
<?
$tableheader="Act Websites";
?>

<!-- links --><?
$nolinks=array(4,7,9);
foreach($nolinks as $key => $value) 
{
$pre="l_".$key;
$thisprimarykey=$pre.$primarykey;
$thislinkurl=$pre."act_link_url";
$thislinkurl1=$pre."act_link_url1";
$thislinkurlcolor=$pre."act_link_urlcolor";
$thislinkulrlen=$pre."act_link_urllen";
$thislinktype=$pre."act_link_categories";
$thislinktype1=$pre."act_link_categories1";
$thislinktypecolor=$pre."act_link_categoriescolor";
$thislinktypelen=$pre."act_link_categorieslen";
$thislinktitle=$pre."act_link_title";
$thislinktitle1=$pre."act_link_title1";
$thislinktitlecolor=$pre."act_link_titlecolor";
$thislinktitleread=$pre."act_link_titleread";
$thislinktitlelen=$pre."act_link_titlelen";
$thisdescrip=$pre."act_link_descrip";
$thisdescrip1=$pre."act_link_descrip1";
$thisdescripcolor=$pre."act_link_descripcolor";
$thisdescriplen=$pre."act_link_descriplen";
?><input type="hidden" name="<?php echo $thislinkurl;?>" value="<?php echo $$thislinkurl;?>">
<input type="hidden" name="<?php echo $thisprimarykey; ?>" value="<?PHP echo $$thisprimarykey; ?>">
<input type="hidden" name="<?php echo $thisprimarykey; ?>1" value="<?PHP echo $$thisprimarykey; ?>">
<tr><Td class="td1" >
<input type="text" name="<?php echo $thislinkurl1;?>" value="<?php echo $$thislinkurl;?>" size="<?PHP echo $$thislinklen;?>" style="color:<?PHP echo $$thislinkurlcolor;?>;" onBlur="IsURL(this);"></td><td class="td2">
			<input type="hidden" name="<?php echo $thislinktype;?>" value="<?PHP echo $$thislinktype;?>">
			<SELECT name="<?php echo $thislinktype1;?>" style="size: 1; color:<?PHP echo $$thislinktypecolor;?>; width: "8";" >
<?
			$connection="/inks/LMhdrw.inc";
			$fieldname="act_link_cat";
			$keyfieldname="act_link_cat_id";
			$outtable="act_link_categories";
			if ($$thislinktype=="")
			{
			$selvalue=$value;
			}
			ELSE
			{
			$selvalue=$$thislinktype;
			}
			$emptyvalue="";
			optionfield_outtable($connection, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname);?>
			</td><TD class="td2">
			<?if ($$thisprimarykey>0)
			{
			$value="More";
			$name="";
			$OnClick="";
//			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			echo "<a href=\"http://www.louisvillemusicnews.net/eventediting/actlink.php?act_link_id=".$$thisprimarykey."&submit=Edit\">";
			$buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
			echo "</a>";
			
			
			}
			ELSE
			{
			}

			?></td></tr>
<?	}?>
<!-- </table> -->
<?			
//}


