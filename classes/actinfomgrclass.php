<?PHP 
class actinfo extends lm_netconnection 
{
    var $actid;
    var $_action;
      function manageactinfo($ActID,$_action)
    {
	  
	 	    $cnxn=new lm_netconnection ;
	    $buttons=new buttons;
	$library=new library;
	            if ($_action=="New" || $_action== "Add New Act")
                {// Creates necessary variables and sets values.
               $cnxn=new lm_netconnection();
               $cnxn->lm_connection("louisvil_louisvillemusiccom");
                $tableheader="Enter New Artist";
                $sqledit="SELECT * from Acts WHERE 1";
                $result=mysql_query($sqledit) OR DIE ("Unable to select the table Acts");
                $fieldnames=@mysql_fetch_array($result);
                $numfields=@mysql_num_fields($result);
                    for ($i=0; $i<$numfields; $i++) 
                    {
                    $thisfieldname  = mysql_field_name($result, $i);
		   $$thisfieldname="";
                    $thisfieldnamesuf=$thisfieldname."suf";
                    $$thisfieldnamesuf="1";
                    }
                }
                ELSEIF ($_action=="Edit" || $_action=="this_act" || $_action=="This_Act")
                {// selects the record for $thisuser_id to edit
		$cnxn=new lm_netconnection();
               $cnxn->lm_connection("louisvil_louisvillemusiccom");
                $tableheader="Edit Artist Information";
                    $sqledit="SELECT * FROM Acts WHERE ActID='".$ActID."'";
                    $result=@mysql_query($sqledit) OR DIE ("Unable to $sqledit ");
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
                        $oldname .="<input type=\"hidden\"name=\"".$thisfieldname."\"value=\"".$thisfieldval."\">";
                        }
			if ($inActive=="on")
				{$inActive1_cked="checked";}
                }
                ELSEIF ($_action=="Update_Act") // This section looks for values in the query string.
                {
                    $tableheader="Are you sure you have the correct information?";
               //     $phoneup="";//Begin processing query string
                 //   $linksup="";
                  while (list ($key, $val) = each ($_GET)) 
                    {
                        IF ($key=="ActID")
                        {
                        $oldname .="<input type=\"hidden\"name=\"".$key."\"value=\"".$val."\">";
                        $linksup .="&".$key."=".$val;
                        $phoneup .="&".$key."=".$val;
                        }
                        ELSEIF (substr($key,0,2)=="t_")// if variable belongs to a telephone, add it to the phoneup list
                        {
                        $phoneup .="&".$key."=".$val;
                        }
                        ELSEIF (substr($key,0,2)=="l_")
                        {
                        $linksup .="&".$key."=".$val;
                        }
                        ELSEIF ($key=="submit")
                        {//Ignore submit
                        }
			ELSEIF ($key=="InActive")
			{
				If($val=="checked")
				{
					$InActive1_cked="checked";
				}
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
                                    $oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">";
                                    }
                                    ELSE // the $$oldkey is not equal to the $val, hence it has changed
                                    {
                                    $thiskeycolor=$oldkey."color";//See above
                                    $thiskeylength=$oldkey."len";//See above
                                    $$thiskeycolor="red";//see above
                                    $$thiskeylength=strlen($val); //see above
                                    $$oldkey=$newval; // sets the $$oldkey to the new value
                                    $oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
                                    }
                        }
                        ELSE // if key is old value, do nothing
                        {
                        }
                    } //END OF WHILE
		    
                    //$_Session['phoneup']=$phoneup;
                }
                ELSEIF ($_action=="Final_Act_Update")
                {
                $tableheader="Updated Act information has been accepted.";
                $updatestring="UPDATE Acts SET ";
                    while (list ($key, $val) = each ($_GET)) 
                    {
                        IF ($key=="ActID")
                        {
                   //     $linksup .="&".$key."=".$val;
                    ///    $phoneup .="&".$key."=".$val;
                        $tag="WHERE ActID='".$ActID."' LIMIT 1";
                        }
                        ELSEif (substr($key,0,2)=="t_")
                        {
                     //   $phoneup .="&".$key."=".$val;
                        }
                        ELSEIF (substr($key,0,2)=="l_")
                        {
                    //    $linksup .="&".$key."=".$val;
                        }
                        ELSEIF ($key=="submit")
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
                                //$upnewval=strip_tags($upnewval);
                                $updatestring .="$oldkey='$upnewval',";//adds to the update string
                                    if ($oldval==$newval)// '$$' calls the value of the variables $oldkey and checks it against the new val. If unchanged, set the various items below
                                    {
                                    $thiskeycolor=$oldkey."color"; //Attach 'color' to end of $oldkey name	
                                    $thiskeylength=$oldkey."len";// Attach 'len' to the end of $oldkey name
                                    $$thiskeycolor="blue"; //Set the variable to blue
                                    $$thiskeylength=strlen($val); // set the variable $$thiskeylength to the length of the val.
                                    $$oldkey=$oldval;
                                    //$oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">";
                                    }
                                    ELSE // the $$oldkey is not equal to the $val, hence it has changed
                                    {
                                    $thiskeycolor=$oldkey."color";//See above
                                    $thiskeylength=$oldkey."len";//See above
                                    $$thiskeycolor="red";//see above
                                    $$thiskeylength=strlen($val); //see above
                                    $$oldkey=$newval; // sets the $$oldkey to the new value
                                //	$oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">";
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
		    $updatestring=str_replace ("InActive=\"checked\"", "InActive=\"on\"" , $updatestring );
		       If(stristr($updatestring,"InActive")==FALSE)
		    {
			    $updatestring .=",InActive=\"\"";
		    }
		    $updatestring=$updatestring.$tag;
		     $cnxn->lm_connection("louisvil_louisvillemusiccom");
                   $updatesql=mysql_query($updatestring) OR DIE ("Unable to complete". $updatestring." query");
                    }
            }
            ELSEIF ($_action=="Confirm_New_Act")
            {
            $tableheader="Are you sure this is the correct new Act information?";
                while (list ($key, $val) = each ($_GET)) 
                    {
                        if (substr($key,0,2)=="t_")// if variable belongs to a telephone, add it to the phoneup list
                        {
                        $phoneup .="&".$key."=".$val;
                        }
                        ELSEIF (substr($key,0,2)=="l_")
                        {
                        $linksup .="&".$key."=".$val;
                        }
                        ELSEIF ($key=="submit")
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
                                    $oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">";
                                    }
                                    ELSE // the $$oldkey is not equal to the $val, hence it has changed
                                    {
                                    $thiskeycolor=$oldkey."color";//See above
                                    $thiskeylength=$oldkey."len";//See above
                                    $$thiskeycolor="red";//see above
                                    $$thiskeylength=strlen($val); //see above
                                    $$oldkey=$newval; // sets the $$oldkey to the new value
                                    $oldname .="<input type=\"hidden\"name=\"".$oldkey."\"value=\"".$val."\">"; //creates the hidden input using the $oldkey name and the current val
                                    }
                        }
                        ELSE // if key is old value, do nothing
                        {
                        }
                    } //END OF WHILE
            }
            ELSEIF ($_action=="Accept")
            {
                //This section reads the tablename and sets the field names as values in Update Statement
               $cnxn=new lm_netconnection();
               $cnxn->lm_connection("louisvil_louisvillemusiccom");
                $run="Select * FROM Act WHERE 1 LIMIT 0,1";
                $result = @mysql_query($run) OR DIE ("Unable to make this connection to find primary keyfield.");
                $fields = @mysql_num_fields($result);
                $lastfield=$fields-1;
                $addrecinsert="INSERT into Act VALUES (";
            //Do {
                for ($i=0; $i < $fields; $i++) 
                    {
                    $type  = mysql_field_type($result, $i);
                    $name  = mysql_field_name($result, $i);
             // 	  $len   = mysql_field_len($result, $i);
                 //   $flags = mysql_field_flags($result, $i);
                    //$findme1="primary_key";
                        if ($i==($lastfield))
                        {
                        $values .="'' )";
                        }
                        ELSE
                        {
                        $values .="'', ";
                        }
                    }
                //}//end of find primary for-next subroutine
                //WHILE ($fields = @mysql_num_fields($result));
                $addrecinsert .=$values;
                $addrecinsert=strip_tags($addrecinsert);
                $newrec=@mysql_query($addrecinsert) or die ("Couldn't do the Act $addrecinsert.");
                // Get the id for the new empty record
                $lastid=mysql_insert_id();
        //**************** Process the query string
                If ($_GET)
                {
                reset($_GET);
                $getcount=count($_GET); 
            //	$getcount=$getcount/2;
                $top=($getcount-1);
                $i=0;
                    while (list ($key, $val) = each ($_GET))
                        {
                            if (substr($key,0,2)=="t_")
                            {
                            $phoneup .=$key."=".$val.",";
                            }
                            ELSEIF (substr($key,0,2)=="l_")
                            {
                            $linksup .=$key."=".$val.",";
                            }
                            ELSEIF ($key=="ActID")
                            {
                            $phoneup .=$key."=".$val.",";
                            $linksup .="ActID=".$val.",";
                            }
                            ELSE
                            {
                            $keysuf=substr($key,-1,1);
                                IF ($keysuf=="1")
                                {
                                    if ($key=="submit")
                                    { 
                                    $i=$i+1;
                                    }
                                    ELSE
                                    {
                                        if ($i==($top))
                                        {
                                        $key=substr($key,0,-1);
                                        $updates[$i]="".$key."="."'".$val."'";
                                        $updatearray=array_merge($updatearray,$updates[$i]);
                                        $i=$i+1;
                                            break;
                                        }
                                        ELSE
                                        {
                                        $key=substr($key,0,-1);
                                        $updates[$i]="".$key."="."'".$val."'";
                                        $updatearray=array_merge($updatearray,$updates[$i]);
                                        $i=$i+1;
                                        }
                                    }//END OF Submit key check
                                }//end of check key for 1
                            }//END OF SUF CHOICE
                        }//END OF WHILE
                }//END OF IF GET
            $updatestring=implode(",",$updatearray);
            $update1="Update Act SET ";
            $updatetag="WHERE ActID='$lastid'";
            $wholestring=$update1.$updatestring.$updatetag;
            $wholestring=strip_tags($wholestring);
            $result=@mysql_query($wholestring) or die("couldn't run update Act query.");
            $tableheader="This Act Has Been Added.";
            $sqlconf="SELECT * FROM Act WHERE ".ActID."=$lastid";
            $newrec=@mysql_query($sqlconf) OR DIE ("Unable to select the new record - $lastid");
                    If (!$newrec)
                    {
                                ECHO "The record was not successfully added.";
                }
                ELSE
                {
                $ActID=$lastid;
                $tableheader="The Act record was successfully added.";
                   }
            }      
	    
	    //End Of accept
            //PRIMARYKEY & TABLENAME CHECK END
            if ($_action=="New"|| $_action=="Edit" || $_action=="Add New Act")
            {
            $required="<span style=\"color: red;\">*</span>";
            }
        
   //    $adisplay .="";
             ?> 
    <!--    <script language="Javascript"TYPE="TEXT/JAVASCRIPT">
        pagename= "Actinfo.php.";
        forSecondaryAddress="";
        function isEmpty(textinput)
        {
        if((textinput.value == null) || (textinput.value.length == 0))
            {
            message="This is a required field and cannot be left blank";
            alert(message)
            textinput.focus();
            return false;  
            }
            else
            {
            return true;
            }
        }
         </script> -->
        
        <?PHP
	
	        //displayLMHeader();
        Session_register("ActName");
        $adisplay="<table align=\"center\"width=\"580\"valign=\"top\" id=\"mainactinfotable\">";
        $adisplay .="<th colspan=\"3\"class=\"th\">". $tableheader."</th>";
        $adisplay .="<tr><td style=\"align:center; width:580;\"colspan=\"3\">";
        $adisplay .="<FORM action=\"index.php\" method=\"GET\" name=\"actinfo\">";
        $adisplay .=$oldname; 
	$adisplay .="</td></tr>";
        $adisplay .="<TR><TD class=\"tdl\"align=\"right\">Act Name :</td><TD class=\"td2\"><input type=\"text\"name=\"ActName1\"value=\"".$ActName."\"style=\"color:".$ActNamecolor."\"size=\"".$ActNamelen."\"onblur=\"isEmpty(this);\"".$ActNameread.">".$required."</td></TR>";
        $adisplay .="<TR><TD class=\"td1\"align=\"right\">Mailing Address :</td><TD class=\"td2\"><input type=\"text\"name=\"MailAddress1\"value=\"".$MailAddress."\"style=\"color:".$MailAddresscolor.";\"size=\"".$MailAddresslen."\"".$MailAddressread."></td><TR>";
        $adisplay .="<TR><TD class=\"td1\"align=\"right\">Secondary Address:</td><TD class=\"td2\"><input type=\"text\"name=\"SecondaryAddress1\"value=\"".$SecondaryAddress."\"style=\"color:".$SecondaryAddresscolor.";\"size=\"".$SecondaryAddresslen."\"".$SecondaryAddressread."></td><TR>";
	$adisplay .="<TR><TD class=\"td1\"align=\"right\">City :</td><TD class=\"td2\"><input type=\"text\"name=\"City1\"value=\"".$City."\"style=\"color:".$Citycolor.";\"size=\"".$Citylen."\"".$City."onblur=\"isEmpty(this);\">".$required."</td><TR>";
	$adisplay .="<TR><TD class=\"td1\"align=\"right\">State :</td><TD class=\"td2\">\n";
	$adisplay .="<SELECT name=\"State1\" size=\"1\" style=\"color:".$Statecolor."\"".$Stateread.">\n";
        $fieldname="State";
        $outtable="states";
        $selvalue=$State;
        $emptyvalue="AA";
	  $dbname="louisvil_louisvillemusiccom";
	  $keyfieldname="State";
	      $library->optionfield_outtable($dbname, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname);
	$adisplay .=$library->option;
	$adisplay .="</select>";
         $adisplay .=$required."</td></TR>";
	 $adisplay .="<TR><TD class=\"td1\"align=\"right\">Zip Code :</td><TD class=\"td2\"><input type=\"text\"name=\"PostalCode1\"value=\"".$PostalCode."\"style=\"color:".$PostalCodecolor."\"size=\"".$PostalCodelen."\"".$PostalCoderead."\"> </td></TR>";
	 $adisplay .="<TR><TD class=\"td1\"align=\"right\">Country :</td><TD class=\"td2\"><input type=\"text\"name=\"Country1\"value=\"".$Country."\"style=\"color:".$Countryolor.";\"size=\"".$Countrylen."\"".$Country."onblur=\"isEmpty(this);\"></td><TR>";
	 $adisplay .="<TR><TD class=\"td1\"align=\"right\">EMail Address: </td><td Class=\"td2\"><input type=\"text\" name=\"EMailAddress1\"value=\"".$EMailAddress."\"></td></tr>";
	$adisplay .="<TR><TD class=\"td1\"align=\"right\">Primary Genre :</td><TD class=\"td2\">\n";
	$library2=new library;
		  $outtable="lmngenres";
		  $selvalue=$lmngenre;
		  $emptyvalue="";
		  $dbname="louisvil_louisvillemusiccom";
		  $keyfieldname="lmngenreid";
		  $fieldname="genre";
		    $library2->optionfield_outtable($dbname, $fieldname, $outtable,$selvalue, $emptyvalue, $keyfieldname);
	$adisplay .="<SELECT name=\"lmngenre1\" size=\"1\" style=\"color:".$lmngenrecolor."\"".$lmngenreread.">\n";
	$adisplay .=$library2->option;
	$adisplay .="</select>";
	$adisplay .=$required."</td></TR>";
        if ($InActive=="on" || $inActive1=="on")
                        { 
                        $InActive_cked= "checked";
                        }
                       	ELSEIF (!$InActive1==TRUE)
			{
				$InActive_cked="";
			}
         $adisplay .="<tr><td class=\"td1\"align=\"right\">Currently Working? </td><td class=\"td2\">";
       $adisplay .="<input type=\"hidden\"name=\"InActive\" value=\"".$InActive_cked."\">";
       $adisplay .="<input type=\"checkbox\" name=\"InActive1\"  value=\"on\"  ".$InActive_cked." > (Check for 'Yes')</td></tr>";
       $adisplay .="<tr><TD colspan=\"3\"align=\"center\">";
       if ($_action=="New"|| $_action=="Edit")
            { 
            $adisplay .="<span style=\"color:red;\">* Required </span>&nbsp;&nbsp;";
            }
            $value="Help";
            $name="Help";
            $OnClick="http://www.louisvillemusic.com/classes/help.php";
            $windowlocation="parent.location";
	   $buttons->lmnbutton($value, $name,$OnClick,$windowlocation);
	   $adisplay .=$buttons->button;
           //$adisplay .="</td></tr></table>";
		$this->adisplay=$adisplay;    
		
    }
  function actbuttons($_action,$ActID)
	{
		$buttons=new buttons;
		$bdisplay="<TR><TD colspan=\"2\" align=\"Center\"><DIV style=\"postiion:relative;float:left;margin:auto;\">";
		IF ($_action=="New" || $_action=="Add New Act")
            {
                $buttons=new buttons;
                //$bdisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
                $type="submit";
                $name="_action";
                $value="Confirm_New_Act";
                $OnClick="";
                $buttons->forminputbutton($type, $name, $value, $OnClick);
		$bdisplay .="</div></form>";
		$bdisplay .=$buttons->button;
               // $buttons->defaultadminbuttons();
	//	$bdisplay .=$buttons->button;
               $bdisplay .="</td></tr></table></form>";
                unset($_SESSION['submit']);
            } 
            ELSEIF ($_action=="Confirm_New_Act")
            {
		    $bdisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
		    include ("http://www.louisvillemusic.com/test/phonelist.php?submit=".$_action."&thisuser_id=".$thisuser_id.":.$phoneup.");
        //		$OnClick="actphonelist.php?submit=Edit";
                $type="submit";
                $name="_action";
                $value="Accept";
                $OnClick="index.php";
               $buttons->forminputbutton($type, $name, $value, $OnClick);
		$actbuttons .=$buttons->button;
                $bdisplay .="</td></tr></form>";
              //  $bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
		//$buttons->defaultmemberbuttons(); 
		//$bdisplay .=$buttons->button;
		$bdisplay .=" </td></tr>";
		$this->bdisplay=$bdisplay;
            }
          ELSEIF($_action=="Edit" || $_action=="this_act")
            {
		    
		  //  $bdisplay .="<table id=\"edittable\"><TR><TD colspan=\"2\" align=\"Center\">";
		 //  $bdisplay .="<table align=\"center\" border=\"1\">";
           //     $bdisplay .="<th align=\"center\" colspan=\"3\" class=\"th\">Weblinks</th>";
           //    $bdisplay .=" <tr><td class=\"td3\" width=\"12\" align=\"right\">URL</td><td class=\"td3\" width=\"12\">Type</td></tr>";
	//	$linksup=stripslashes($linksup);
	//	$links ="actlinklist.php?_action=".$_action."&ActID=".$ActID."";
	//	echo $links;
	//	include ("actlinklist.php");
        
       //        $bdisplay .="</table>";// End of weblinks table
		
                $bdisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
             //   $bdisplay .="<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
                $bdisplay .="<input type=\"hidden\" name=\"ActID\" value=\"".$ActID."\">";
                $type="submit";
                $name="_action";
                $value="Update_Act";
                $OnClick="http://www.louisvillemusicnews.net/lmn/eventediting/actinfo.php";
               $buttons->forminputbutton($type, $name, $value, $OnClick);
		$bdisplay .=$buttons->button;
               $bdisplay .="</td></tr></form>";
	  //     $bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
       //      $bdisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
          //    $buttons->defaultmemberbuttons();
	//	$bdisplay .=$buttons->memberbuttons;
		$bdisplay .="</td></tr><br />";
		//echo "got here";
                //@mysql_close($connection);
            }
            ELSEIF ($_action=="Update_Act")
            {
         //       $bdisplay .="</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
          //      include("http://www.louisvillemusicnews.net/lmn/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup);		
	//	$bdisplay .="</td></tr></table><table align=\"center\" border=\"1\">";
             //    $bdisplay .="<th align=\"center\" colspan=\"3\" class=\"th\">Weblinks</th>";
	//	 $bdisplay .="<tr><td class=\"td3\" width=\"12\" align=\"right\">URL</td><td class=\"td3\" width=\"12\">Type</td></tr>";
   //     $linksup=stripslashes($linksup);
    //    $links=("http://www.louisvillemusicnews.net/lmn/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
   //     include ($links);
    $bdisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
    		$type="submit";
                $name="_action";
                $value="Final_Act_Update";
                $OnClick="http://www.louisvillemusicnews.net/lmn/eventediting/actinfo.php";
               $buttons->forminputbutton($type, $name, $value, $OnClick);
                 $bdisplay .="<hr width=\"120\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
		 $bdisplay .=$buttons->button;
                $bdisplay .="</td></tr></form>";
		//$bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
              //  $bdisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
              //  $buttons->defaultmemberbuttons();
		//$bdisplay .=$buttons->button;
                $bdisplay .="</table>";
               @mysql_close($connection);
	       
            }
            ELSEIF ($_action=="Final_Act_Update")
            {

		   $bdisplay .="<TR><TD colspan=\"2\" align=\"Center\">";
		//    $phones="http://www.louisvillemusicnews.net/lmn/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup;
		//    include ($phones);
                //        $bdisplay .="</td></tr></table>";
                 //       $bdisplay .="<table align=\"center\" border=\"1\">";
                 //       $bdisplay .="<th align=\"center\" colspan=\"3\" class=\"th\">Weblinks</th>":
		//	$bdisplay .="<tr><td class=\"td3\" width=\"12\" align=\"right\">URL</td><td class=\"td3\" width=\"12\">Type</td></tr>";
		//	$linksup=stripslashes($linksup);
		//	$links=("http://www.louisvillemusicnews.net/lmn/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
		//	include ($links);
			//$bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
			//$bdisplay .="</form>
			//$bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
			$bdisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
			//$buttons->defaultmemberbuttons();
			$bdisplay .=$buttons->button;  
                // buttonrow ("Continue",""); 
		$bdisplay .="</td></tr></table>";
		unset($updatestring);
	
            } 
            ELSEIF ($_action=="Accept")
            {
        
		    $bdisplay .="</td></tr><TR><TD colspan=\"2\" align=\"Center\">";
           // $phones="http://www.louisvillemusicnews.net/lmn/eventediting/actphonelist.php?submit=".$_action."&amp;ActID=$ActID".$phoneup;
           //     include ($phones);
                        $bdisplay .="</td></tr></table>";
                        $bdisplay .="<table align=\"center\" border=\"1\">";
                        $bdisplay .="<th align=\"center\" colspan=\"3\" class=\"th\">Weblinks</th>";
			$bdisplay .="<tr><td class=\"td3\" width=\"12\" align=\"right\">URL</td><td class=\"td3\" width=\"12\">Type</td></tr>";
		//	$linksup=stripslashes($linksup);
			//$links=("http://www.louisvillemusicnews.net/lmn/eventediting/actlinklist.php?submit=".$_action."&amp;ActID=$ActID".$linksup);
			//include ($links);
			$bdisplay .="<tr><td align=\"center\" colspan=\"3\">";
			$bdisplay .="</form> <tr><td align=\"center\" colspan=\"3\">";
              //   $bdisplay .="<hr width=\"320\" size=\"1 px\" background-color=\"#f5e3a1\" align=\"center\">";
              //  defaultmemberbuttons();
		//$bdisplay .=$button->button;
		$bdisplay .="</td></tr></table>";
               unset($updatestring);
            }  
	    $bdisplay .="</table>";
	    $this->bdisplay=$bdisplay;
        } 
}

?>
