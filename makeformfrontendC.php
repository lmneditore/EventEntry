<?PHP
session_start();
$method="GET";
if (!$stylesheet)
{
$stylesheet="http://www.louisvillemusicnews.net/test/defaultformcss.css";
}
?>
<LINK REL=stylesheet HREF="<?PHP echo $stylesheet;?>" TYPE="text/css">
<?function dbconnection($dbhost,$dbusername,$dbpassword,$dbname)
{
global $connection4;
$connection4=@mysql_connect($dbhost,$dbusername,$dbpassword) or die("couldn't connect to Host.");
$db=@mysql_select_db($dbname) or die ("Couldn't select Database.");
}
if (!isset($_POST["action"]))
{
$_action="Clear Session Variables";
}



IF ($_action=="Clear Session Variables") //  -----------------------------------Start of !submit ---------- ------------
{
session_unregister("dbhost");
session_unregister("dbusername");
session_unregister("dbpassword");
session_unregister("dbname");
session_unregister("tablename");
?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET">
<TABLE border="1" class="tablebody">
<TH class="thdr" colspan="2">Form For Creating An Input and Revision Form Based On Specific Table</th>
<TR><TD class="td1">Database HostName: </td><TD class="td2"><Input type="text" name="dbhost" value="localhost"> </td></tr>
<TR><TD class="td1">DB Username: </td><TD class="td2"><Input type="text" name="dbusername" value="louisvil"> </td></tr>
<TR><TD class="td1">DB Password: </td><TD class="td2"><Input type="password" name="dbpassword" value="ADW7FSxg"> </td></tr>
<TR><TD class="td1">Database Name: </td><TD class="td2"><Input type="text" name="dbname" value="louisvillemusic_com"> </td></tr>
<tr><td COLSPAN="2" align="center"><input type="submit" name="submit" value="Select Table"></td></tr>
</form>
<tr><TD class="td1"><b>Clear Session Variables</b></td><TD class="td2"><button OnClick="window.location='http://www.louisvillemusicnews.net/test/makeformfrontendC.php?submit=Clear Session Variables'" style="background-color: "gray" ><font color="black">Clear Session Variables</button></td></tr>



<?php
}
ELSEIF ($_action=="Select Table")
{

session_register("dbhost");
session_register("dbusername");
session_register("dbpassword");
session_register("dbname");
dbconnection($dbhost,$dbusername,$dbpassword,$dbname);
$sql="SHOW Tables";
$result=@mysql_query($sql) or die("couldn't show table list .");
$tablelist=@mysql_fetch_array($result);
$counttables=@mysql_num_rows($tablelist);
?>
<FORM action="<?PHP $PHP_SELF;?>">
<input type ="hidden" value="<?PHP echo $dbusername;?>">
<input type ="hidden" value="<?PHP echo $dbhost;?>">
<input type ="hidden" value="<?PHP echo $dbpassword;?>">
<input type ="hidden" value="<?PHP echo $dbname;?>">
<select name="tablename" size="<?PHP echo $counttables; ?>">
<?
Do
{

$tablelistphrase="Tables_in_";
$tablelistphrase .=$dbname;
echo $tablelistphrase;
$thistable=$tablelist[$tablelistphrase];
echo "<option value=\"".$thistable."\">".$thistable."</option>\n";
}
WHILE ($tablelist=@mysql_fetch_array($result));
echo "</select>";
?>
</select>
<input type="submit" name="submit" value="Create Form">

<?
echo "</form>";
}//  -----------------------------------!Not submit Else  ---------- ------------
ELSEIF ($_action=="Create Form")// -------------Start of $_action ------------------
{
session_register("tablename");
dbconnection($dbhost,$dbusername,$dbpassword,$dbname);
// DETERMINE IF THERE IS AN PRIMARY & AUTOINCREMENTED FIELD ------------------------>

$sqlndx="DESCRIBE $tablename";
$result=@mysql_query($sqlndx) or die("couldn't execute first index query for ".$tablename."");
$ndxes=@mysql_fetch_array($result);
DO
{
    IF ($ndxes["Key"]=="PRI");
   {
    $primaryfield=$ndxes["Field"];
    session_register("primaryfield");
    }
    ELSEIF (!$ndxes)
    {
    $IDfieldwarning="This table has no primary field. Check to ensure that the ID field cannot be modified";
    }
}
//CHECK TO SEE IF PRIMARY FIELD IS AUTOINCREMENTED.
WHILE ($ndxes=@mysql_fetch_array($result));

$sql="SHOW TABLE Status";
$result=@mysql_query($sql,$connection4) or die ("Couldn't show table status.");
$status=@mysql_fetch_array($result);
DO
{
    if ($status["Name"]==$tablename)//Select table 
    {
            IF ($status["Auto_increment"]>0)// table has an auto-increment field
            {
                $sql="SHOW INDEX FROM '$tablename'";
                $ndxresult=@mysql_query($sql,$connection4) or die ("Not able to show indices from". $tablename."");
                $indices=@mysql_fetch_array($ndxresult);
				$numindices=count($indices);
				$ndx=0
					for ($i=0; $i<$numindices; $i++) 
					{
						if ($indicies["Non_unique"])
						{
						$ndx++;
						}
					}
                DO
                {    if ($indices["Non_unique"]==0)
                    {
                    $autofield=$indices["Key_name"];
						IF ($primaryfield==$autofield)
						{
						$upfield=$primaryfield;
						}
						ELSE
						{
						$npfield=$primaryfield;
                        }
                    }
                }
                WHILE ($indices=@mysql_fetch_array($ndxresult));
            }
            ELSE // status["Auto_increment"] is NULL (May still be auto_incremented)
            {
                $sql="SHOW INDEX FROM '$tablename'";
                $ndxresult=@mysql_query($sql,$connection4) or die ("Not able to show indices from". $tablename."");
                $indices=@mysql_fetch_array($ndxresult);
                DO
                {
                    if ($indices["Non_unique"]==0)
                    {
                    $ufield=$indices["Key_name"];// If there is an unique field, give it a variable name and insert a test record
                    $sqlcols="Show columns FROM $tablename";
                    $colresult=@mysql_query($sqlcols) or die("couldn't execute first table query.");
                    $countcols=@mysql_num_rows($colresult);
                    $fields=@mysql_fetch_array($result);//construct an insertion string for a new record
                    $insertstr1="INSERT into $tablename VALUES (";
                    for ($i=1; $i<$countcols; $i++)
                    {
                    $values .="'', ";
                    }
                    $values .="'' ";
                    $closer=")";
                    $insertstr1=$insertstr1.$values.$closer;
                    $newrec=@mysql_query($insertstr1) or die ("Couldn't do the $tablename query.");// insert a new, empty record
                    $lastid=mysql_insert_id();
                        if ($lastid>0)
                        {
                        $autofield=$ufield;
                        }
                    }
                    ELSE// If there isn't an unique field, the table isn't an autoincremented.
                    {
                    $ufield="None";
                    }
                }
                WHILE ($indices=@mysql_fetch_array($ndxresult));
            }
        }
    }
}
WHILE ($status=@mysql_fetch_array($result));
//----------------------------------------------------

dbconnection($dbhost,$dbusername,$dbpassword,$dbname);


$sqlcols="Show columns FROM $tablename";
$result=@mysql_query($sqlcols) or die("couldn't execute first table query.");
$countcols=@mysql_num_rows($result);
$fields=@mysql_fetch_array($result);

?>
<FORM action ="<?PHP echo $PHP_SELF;?>" method="GET">

<TABLE class="tablebody"><TH class="thdr" colspan="2">Select Fields to include in new form</th>
<?

DO
{

IF ($fields["Field"]==$primaryfield)
{
echo "<TR><TD class=\"td1\"><input type=\"radio\" name=\"".$fields["Field"]."\"  value=\"Y\" CHECKED></td><TD class=\"tdr\">".$fields["Field"]." : </td></tr>";
}
ELSE
{
echo "<TR><TD class=\"td1\"><input type=\"radio\" name=\"".$fields["Field"]."\"  value=\"Y\"></td><TD class=\"tdr\">".$fields["Field"]." : </td></tr>";
}
}
WHILE ($fields=@mysql_fetch_array($result));


?>

</table>
<input type="submit" name="submit" value="Select Fields">
</form>

<?}
ELSEIF ($_action=="Select Fields")// -------------$_action continues ------------------
{


  if ($_GET)
  { 

 // echo $newfields;
  $fieldlist=array();
   reset($_GET);
     while (list ($key, $val) = each ($_GET)) 
     {
     $fieldlist=array_merge($fieldlist,$key);
	 session_register("fieldlist");
     }
  }
$tablename1=$tablename."1";
$newarray=array("Create TEMPORARY TABLE $tablename1 SELECT ");
$newfields=count($fieldlist);


for ($i=0; $i<($newfields); $i++) 
{
       if ($i==($newfields-1))
	   {
	   }
	    ELSEIF ($i==($newfields-2))
       {
        array_push($newarray," ".$fieldlist[$i]." FROM $tablename");
       }
	   	   ELSE
	   {
       array_push($newarray, " ".$fieldlist[$i].", ");
	  
	   }
}
$newtable=implode("", $newarray);
session_register("newtable");
dbconnection($dbhost,$dbusername,$dbpassword,$dbname);
$result=@mysql_query($newtable) or die("couldn't execute first new table query.");
$connection=dbconnection($dbhost,$dbusername,$dbpassword,$dbname);
echo $connection;
echo "<?php \n";
ECHO "SESSION_START();\n";
echo "?>\n";
echo "<LINK REL=stylesheet HREF=\"$stylesheet\" TYPE=\"text/css\">\n";
echo "<?\n";
echo "function dbconnection(\$dbhost,\$dbusername,\$dbpassword,\$dbname)\n";
echo "{\n";
echo "global \$connection4;\n";
echo "\$connection4=@mysql_connect(\"".$dbhost."\",\"".$dbusername."\",\"".$dbpassword."\") or die(\"couldn't connect to host.\");\n";
echo "\$db=@mysql_select_db(\"".$dbname."\",\$connection4) or die(\"Couldn't select database.\");\n";
echo "}\n";
echo "\$connection=dbconnection(\"".$dbhost."\",\"".$dbusername."\",\"".$dbpassword."\",\"".$dbname."\");\n";


$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute second table query.");
$countcols=@mysql_num_rows($result);
$thesecols1=@mysql_fetch_array($result);


echo "\n";
// begin code for form 
echo "\$keyfield=$primaryfield;\n";
echo "IF(!\$_action)\n"; //*******************Start of Form !isset($_POST["action"]) *****
echo "{\n";


echo $connection;
echo "\$connection;\n";
echo "\$sql".$tablename."=\"SELECT ";
$i=0;
DO
{
if ($i<$countcols)
 {
	if ($i==$countcols-1)
	{
    echo $tablename.".".$thesecols1["Field"];
	++$i;
	}
	ELSE
	{
     echo $tablename.".".$thesecols1["Field"].", ";
       ++$i;
     }
 }
}
While ($thesecols1=@mysql_fetch_array($result));

   echo " FROM ".$tablename." WHERE 1 LIMIT 0,1\";\n" ;

   echo "\$result=@mysql_query(\$sql".$tablename.", \$connection4) or die (\"Couldn't do the ".$tablename."  query.\");\n";
   echo "\$thisfetch=@mysql_fetch_array(\$result);\n";
 echo "\n";
 
 echo "\$thisrecord=\$thisfetch[\"".$primaryfield."\"];\n";
 echo "session_register(\"thisrecord\");\n";

   $sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols2=@mysql_fetch_array($result);
   DO
   {
   echo "\$".$thesecols2["Field"]."=\$thisfetch[\"".$thesecols2["Field"]."\"];\n";

   echo "\$".$thesecols2["Field"]."len=strlen(\$thisfetch[\"".$thesecols2["Field"]."\"]);\n";
echo "\$".$thesecols2["Field"]."color=\"Blue\";\n";
echo "\$".$thesecols2["Field"]."suf=\"1\";\n";

ECHO "session_register(\"".$thesecols2["Field"]."\");\n";
echo "\n";
   }
   WHILE ($thesecols2=@mysql_fetch_array($result));

  ?> 
   if ($_<?php echo $method;?>)
{
reset ($_<?PHP echo $method.");\n";?>
   while (list ($key, $val) = each ($_<?PHP echo $method;?> )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $thiskeylen=$$thiskeylength;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylength=$thiskeylen;
		   $$thiskeysuf="2";

           }

           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="red";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}
<?
echo "?>"; 
?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TR><TD>
<?PHP 

$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols3=@mysql_fetch_array($result);
DO
{
if ($thesecols3["Field"]==$primaryfield)
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"  READONLY></td></tr>\n";
}
ELSE
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"></td><TR>\n";
}
}
WHILE ($thesecols3=@mysql_fetch_array($result));


echo "<TR><TD colspan=\"2\" align=\"Center\"><input type=\"submit\" name=\"submit\" value=\"Update\">";
echo "&nbsp;<input type=\"submit\" name=\"submit\" value=\"New\">";
echo "&nbsp;<input type=\"submit\" name=\"\" value=\"Cancel\">";
echo "&nbsp;<input type=\"submit\" name=\"submit\" value=\"List\">";
echo "</td></tr></table></form>";
echo "<?PHP ";
echo "\n}\n";
echo "ELSE";


echo "{//submit exists\n";
echo "IF (\$_action==\"Update\")\n"; //*******************Update of Form $_action *****
echo "{\n";
 ?>
 
    if ($_<?php echo $method;?>)
{
reset ($_<?PHP echo $method.");\n";?>
   while (list ($key, $val) = each ($_<?PHP echo $method;?> )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $thiskeylen=$$thiskeylength;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylength=$thiskeylen;
		   $$thiskeysuf="2";
           }

           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="red";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}
?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TH class="thdr" colspan="2"><I>Items In Red Have Been Changed.</i></TH><?PHP 
$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols=@mysql_fetch_array($result);
DO
{
if ($thesecols["Field"]==$primaryfield)
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols["Field"]."<?PHP echo $".$thesecols["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols["Field"]."len;?> \" READONLY></td></tr>\n";
}
ELSE
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols["Field"]."<?PHP echo $".$thesecols["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols["Field"]."len;?> \"></td></tr>\n";
}
}
WHILE ($thesecols=@mysql_fetch_array($result));
?>
<TR><TD align="Center" colspan="2">
<?PHP echo "<input type=\"submit\" name=\"submit\" value=\"Accept\">&nbsp;<input type=\"submit\" name=\"submit\" value=\"Update\">\n";
echo "&nbsp;<input type=\"reset\" name=\"<?PHP \$PHP_SELF;?> \" value=\"Reset\">";
echo "&nbsp;<input type=\"submit\" name=\"\" value=\"Cancel\">";
echo "</td></tr></table></form>";
echo "<?";


echo "\n}";
echo "ELSEIF\n";
echo "(\$_action==\"Accept\")\n"; //*******************Form Accept $_action *****
echo "{\n";


echo $connection;
$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$countcols=@mysql_num_rows($result);
echo $connection;
echo "\$sql".$tablename."=\"SELECT ";
$i=0;
DO
{
if ($i<=$countcols)
{
    if ($i<$countcols)
    {
        if ($i==0)
		{
		++$i;
		}
		ELSE
		{
         echo $tablename.".".$thesecols["Field"].", ";
       ++$i;
        }
    }
	ELSE 
    {
	if ($i==$countcols)
	{
    echo $tablename.".".$thesecols["Field"];
	}
    }
 }
}
While ($thesecols=@mysql_fetch_array($result));

   echo " FROM ".$tablename." WHERE 1 LIMIT 0,1\";\n" ;

   echo "\$result=@mysql_query(\$sql".$tablename.", \$connection4) or die (\"Couldn't do the ".$tablename."  query.\");\n";
   echo "\$thisfetch=@mysql_fetch_array(\$result);\n";
 echo "\n";

   $sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols=@mysql_fetch_array($result);
   DO
   {
   echo "\$".$thesecols["Field"]."=\$thisfetch[\"".$thesecols["Field"]."\"];\n";

   echo "\$".$thesecols["Field"]."len=strlen(\$thisfetch[\"".$thesecols["Field"]."\"]);\n";
    echo "\$".$thesecols["Field"]."color=\"Blue\";\n";

   }
   WHILE ($thesecols=@mysql_fetch_array($result));
  ?> 
    if ($_<?php echo $method;?>)
{
reset ($_<?PHP echo $method.");\n";?>
   while (list ($key, $val) = each ($_<?PHP echo $method;?> )) 
   {
      $thiskeylen=strlen($val);
      $thiskeyval=$val;
      $thiskeyname1=$key;
	  $newkeylen=strlen($thiskeyname1)-1;
      $thiskeyname=substr($key,0,$newkeylen);
      $thiskeycolor=$thiskeyname."color";
      $thiskeylength=$thiskeyname."len";
	  $thiskeysuf=$thiskeyname."suf";
	 
           if ($$thiskeyname1==$$thiskeyname)
		   {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $thiskeylen=$$thiskeylength;
           $$thiskeysuf="1";
           }
           ELSE
           {
           $$thiskeyname=$$thiskeyname1;
           $$thiskeycolor="red";
           $$thiskeylength=$thiskeylen;
		   $$thiskeysuf="2";

           }
           if($thiskeylen==0)
           {$thiskeylen=29;
		   }
           if ($thiskeyval=="")
           {
           $textcolor="blue";
           $$thiskeycolor=$textcolor;
           $$thiskeylength=$thiskeylen;
           }
		
   }
}

?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TH class="thdr" colspan="2"><I>Are You Sure You Want to Change These Items?</i></TH>
<TR><TD>


<?PHP 
$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols=@mysql_fetch_array($result);
DO
{
    if ($thesecols["Field"]==$primaryfield)
    {
    echo "<TR><TD class=\"td1\">".ucfirst($thesecols["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols["Field"]."<?PHP echo $".$thesecols["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols["Field"]."len;?> \" READONLY ></td></tr>\n";
    }
    ELSE
    {
     echo "<TR><TD class=\"td1\">".ucfirst($thesecols["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols["Field"]."<?PHP echo $".$thesecols["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols["Field"]."len;?> \" ></td></tr>\n";
     }
}
WHILE ($thesecols=@mysql_fetch_array($result));
?>
<TR><TD colspan="2" align="center">
<?PHP echo "<input type=\"submit\" name=\"submit\" value=\"Final Accept\">";
echo "&nbsp;<input type=\"submit\" name=\"\" value=\"Cancel\">";
echo "</td></tr></table></form>";


echo "<?}\n";
echo "ELSEIF (\$_action==\"Final Accept\")\n"; //*******************Form Final Accept $_action 
// THIS SECTION CREATES THE TABLE UPDATE CODE
echo "{\n";


echo "   If (\$_$method)\n";
echo"   {\n";
echo"   reset(\$_$method);\n";
echo"   \$getcount=count(\$_$method); \n";
echo"   \$i=0;\n";
echo"    while (list (\$key, \$val) = each (\$_$method))\n";
echo"      {\n";
echo"      \$getkey=substr(strrev(\$key),0,1);\n";
echo"	  \$keylen=strlen(\$key);\n";
echo"	  \$shortstring=substr(\$key,0,(\$keylen-1));\n";
echo"	\$val=addslashes(\$val);\n";
echo"         IF (\$getkey==\"2\")\n";
echo"         {\n";
echo"             if(\$i==(\$getcount-2))\n";
echo"			 {\n";
echo"			 \$updates[\$i]=\" \".\$shortstring.\"=\".\"'\".\$val.\"'\";\n";
echo"			 \$updatearray=array_merge(\$updatearray,\$updates);\n";
echo"			 			 break;\n";
echo"			 }\n";
echo"			 ELSE\n";
echo"			 {\n";
echo"			 \$updates[\$i]=\" \".\$shortstring.\"=\".\"'\".\$val.\"'\";\n";
echo" 			 \$updatearray=array_merge(\$updatearray,\$updates);\n";
echo"			 \$i=++\$i;\n";
echo"			 }\n";
echo"          }\n";
echo"          if (\$getkey==\"1\")\n";
echo"         {\n";
echo"         }\n";
echo"\n";
echo"		  \$i=++\$i;\n";
echo"       }\n";
echo"       }\n";
echo"\$updatestring=implode(\",\",\$updates);\n";
echo"\$update1=\"Update $tablename SET \";\n";
echo "\$updatetag=\" WHERE $primaryfield=\$thisrecord\";\n";
echo"\$wholestring=\$update1.\$updatestring.\$updatetag;\n";
echo"\$result=@mysql_query(\$wholestring, \$connection4) or die(\"couldn't run update table query.\");\n";
echo"\n";
//THE TABLE UPDATE CODE IS COMPLETED HERE

$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute second table query.");
$countcols=@mysql_num_rows($result);
$thesecols1=@mysql_fetch_array($result);


echo "\n";
// begin code for form

echo $connection;
echo "\$connection;\n";
echo "\$sql".$tablename."=\"SELECT ";
$i=0;
DO
{
if ($i<$countcols)
 {
	if ($i==$countcols-1)
	{
    echo $tablename.".".$thesecols1["Field"];
	++$i;
	}
	ELSE
	{
     echo $tablename.".".$thesecols1["Field"].", ";
       ++$i;
     }
 }
}
While ($thesecols1=@mysql_fetch_array($result));

   echo " FROM ".$tablename." WHERE  $primaryfield='\$thisrecord' LIMIT 0,1\";\n" ;

   echo "\$result=@mysql_query(\$sql".$tablename.", \$connection4) or die (\"Couldn't do the ".$tablename."  query.\");\n";
   echo "\$thisfetch=@mysql_fetch_array(\$result);\n";
 echo "\n";

   $sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols2=@mysql_fetch_array($result);
   DO
   {
   echo "\$".$thesecols2["Field"]."=\$thisfetch[\"".$thesecols2["Field"]."\"];\n";

   echo "\$".$thesecols2["Field"]."len=strlen(\$thisfetch[\"".$thesecols2["Field"]."\"]);\n";
echo "\$".$thesecols2["Field"]."color=\"Blue\";\n";
echo "\$".$thesecols2["Field"]."suf=\"1\";\n";

ECHO "session_register(\"".$thesecols2["Field"]."\");\n";
echo "\n";
   }
   WHILE ($thesecols2=@mysql_fetch_array($result));
echo "?>"; 
?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TH class="thdr" colspan="2">The record has been updated.</th>
<?PHP 

$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols3=@mysql_fetch_array($result);
DO
{
if ($thesecols3["Field"]==$primaryfield)
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"  READONLY></td></tr>\n";
}
ELSE
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"></td><TR>\n";
}
}
WHILE ($thesecols3=@mysql_fetch_array($result));


echo "<TR><TD colspan=\"2\" align=\"Center\"><input type=\"submit\" name=\"submit\" value=\"New\">";
echo "&nbsp;<input type=\"submit\" name=\"\" value=\"Cancel\">";
echo "&nbsp;<input type=\"submit\" name=\"submit\" value=\"List\">";
echo "</td></tr></table></form><?\n";


echo "}\n";//this is the next to last bracket for the completed form
echo "ELSEIF (\$_action==\"New\")\n";
echo "{\n";
echo "?>\n";
$connection;

$result = @mysql_query("select * from $tablename1")
    or die("Query failed: " . mysql_error());
/* get column metadata */
?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TH class="thdr" colspan="2">Add A New Record to <?PHP echo $tablename; ?></th>

<?
$i = 0;
while ($i < @mysql_num_fields($result)) 
{
    $meta = mysql_fetch_field($result);
    if (!$meta) 
    {
        echo "No information available<br />\n";
    }
	ELSEIF ($meta->name==$primaryfield)
	{
	// omit id field for new record only
    }
	ELSE
	{
	echo "<TR><TD align=\"tdl\">".ucfirst($meta->name)." :</td><TD align=\"tdr\"><input type=\"text\" name=\"".$meta->name."<?PHP echo $".$meta->name.";?>\" value=\"\"  style=\"color:<?PHP echo $".$meta->name."color;?>\" size=\"".$meta->max_length."\"></td></tr>\n";

    }
    $i++;
}
@mysql_free_result($result);
?>
<tr><TD align ="center" colspan="2"><input type="submit" name="submit" value="Add">
<?php echo "&nbsp;<input type=\"reset\" name=\"<?PHP \$PHP_SELF;?> \" value=\"Reset\">";?>
&nbsp;<input type="submit" name="submit" value="List">
</td></tr>
</table></form>
<?PHP 
echo "<?\n";
echo "}\n";
echo "ELSEIF (\$_action==\"Add\")\n";
echo "{\n";
echo "\$connection;\n";
echo "\$sqlndx=\"Show INDEX FROM $tablename\";\n";
echo "\$result=@mysql_query(\$sqlndx, \$connection4) or die(\"couldn't execute first table query.\");\n";
echo "\$sqlcols=\"Show columns FROM $tablename\";\n";
echo "\$result=@mysql_query(\$sqlcols, \$connection4) or die(\"couldn't execute first table query.\");\n";
echo "\$countcols=@mysql_num_rows(\$result);\n";
echo "\$fields=@mysql_fetch_array(\$result);\n";
//construct an insertion string for a new record
echo "\$insertstr1=\"INSERT into $tablename VALUES (\";\n";
echo "for (\$i=1; \$i<\$countcols; \$i++) \n";
echo "{\n";
echo "\$values .=\"'', \";\n";
echo "}\n";
echo "\$values .=\"'' \";\n";
echo "\$closer=\")\";\n";
echo "\$insertstr1=\$insertstr1.\$values.\$closer;\n";
echo "\$newrec=@mysql_query(\$insertstr1, \$connection4) or die (\"Couldn't do the $tablename query.\");\n";
// insert a new, empty record
echo "\$lastid=mysql_insert_id();\n";
// Get the id of the last inserted record
echo "   If (\$_$method)\n";
echo"   {\n";
echo"   reset(\$_$method);\n";
echo"   \$getcount=count(\$_$method); \n";
echo"   \$i=0;\n";
echo"    while (list (\$key, \$val) = each (\$_$method))\n";
echo"      {\n";
echo"	  \$keylen=strlen(\$key);\n";
//echo"         IF (\$getkey==\"2\")\n";
echo"         {\n";
echo"             if(\$i==(\$getcount-1))\n";
echo"			 {\n";
echo"			 \$updates[\$i]=\" \".\$key.\"=\".\"'\".\$val.\"'\";\n";
echo"			 \$updatearray=array_merge(\$updatearray,\$updates);\n";
echo"			 			 break;\n";
echo"			 }\n";
echo"			 ELSE\n";
echo"			 {\n";
echo"			 \$updates[\$i]=\" \".\$key.\"=\".\"'\".\$val.\"'\";\n";
echo" 			 \$updatearray=array_merge(\$updatearray,\$updates);\n";
echo"			 \$i=++\$i;\n";
echo"			 }\n";
echo"          }\n";
//echo"          if (\$getkey==\"1\")\n";
//echo"         {\n";
//echo"         }\n";
echo"\n";
echo"		  \$i=++\$i;\n";
echo"       }\n";
echo"       }\n";
echo"\$updatestring=implode(\",\",\$updates);\n";

echo "echo \$updatestring;\n";
echo"\$update1=\"Update $tablename SET \";\n";
echo "\$updatetag=\" WHERE $primaryfield=\$lastid LIMIT 0, 1\";\n";
echo"\$wholestring=\$update1.\$updatestring.\$updatetag;\n";
echo"\$result=@mysql_query(\$wholestring, \$connection4) or die(\"couldn't run update table query.\");\n";
echo"\n";

// ----------------------------------------------------------
echo "}\n";// 
echo "ELSEIF (\$_action==\"List\")\n";
echo "{\n";
// ----------------------------------------------------------

$repl="Create TEMPORARY TABLE ";
$repl .=$tablename;
$repl .=" Select".
$fieldlist1=str_replace($repl,"",$newtable);
$fieldlist1=substr($fieldlist1,2,(strlen($fieldlist1)));
echo "    if (\$listend)\n";
echo "    {\n";
echo "     \$liststart=\$listend;\n";
echo "     \$listend=\$liststart+30;\n";
echo "     }\n";
echo "     ELSE";
echo "     { \$liststart=0;\n";
echo "      \$listend=30;\n";
echo "     }\n";
echo "  \$connection;\n";
echo "\$sqlcols=\"Show columns FROM $tablename\";\n";
echo "\$result=@mysql_query(\$sqlcols, \$connection4) or die(\"couldn't execute first table query.\");\n";
echo "\$countcols=@mysql_num_rows(\$result);\n";
echo "\$fields=@mysql_fetch_array(\$result);\n";
echo "\$i=0;\n";
echo "?>";

// This section creates the table header with field names listed
echo "<table class=\"tablebody\" border=\"1\">";
echo "<TD class=\"thdr\" colspan=\"2\">Select 'Edit' for individual Record</TH><TR>";

//if there is a primary (ID) field, insert an empty table data box in the header
if ($primaryfield)
{
echo "<TD></td>";
}

echo "<?\n";
echo "       DO\n";
echo "       {\n";
echo "       echo \"<TD>\";\n";
echo "       print \$fields[\"Field\"];\n";
echo "       \$field.\$i=\$fields[\"Field\"];\n";
echo "       \$i=++\$i;\n";
echo "       echo \"</td>\";\n";
echo "       }\n";
echo "       WHILE (\$fields=@mysql_fetch_array(\$result));\n";
echo "echo \"</tr>\";\n";
echo "echo \"<tr>\";\n";

// This is builds the sql string with the limits attached
echo "\$sql=\"$fieldlist1  LIMIT \";\n";
echo "\$sql .=\$liststart;\n";
echo "\$sql .=\", \";\n";
echo "\$sql .=\$listend;\n";
// This is builds the sql string with the limits attached

//This section builds the list
echo "\$result=@mysql_query(\$sql, \$connection4) or die(\"couldn't select this list query.\");\n";
echo "\$thisfetch=@mysql_fetch_array(\$result);\n";
echo "      DO\n";
echo "      {\n";
echo "       echo \"<TR>\";\n";
IF ($primaryfield)
       {
echo "?><TD><a href=\"<?PHP echo \$PHP_SELF;?>?submit=Edit&thisid=<?PHP echo \$thisfetch['$primaryfield']; ?>\">";
echo "Edit</a></td>\n<?";
       }
echo "           for (\$i=0; \$i<\$countcols; \$i++) \n";
echo "          {\n";
echo "           echo \"<TD>\";\n";
echo "       if (\$thisfetch[\$field.\$i]==\"\")\n";
echo "      {\n";
echo "       echo \"&nbsp\";\n";
echo "       }\n";
echo "       ELSE\n";
echo "        {\n";
echo "          print  \$thisfetch[\$field.\$i];\n";
echo "         }\n";
echo "          echo \"</td>\";\n";
echo "           }\n";
echo " echo \"</tr>\";\n";
echo "      }\n";
echo "WHILE (\$thisfetch=@mysql_fetch_array(\$result));\n";

echo "echo \"</tr>\";\n";
echo "echo \"<tr>\";\n";

echo "?>";
echo "</td></tr>\n";
echo "<tr><Td align=\"center\" colspan=\"<?PHP echo \$i;?>\">\n";
echo "<button OnClick=\"window.location='<?PHP echo \$PHP_SELF; ?>?submit=List&listend=<?PHP echo \$listend; ?>'\" style=\"background-color: \"gray\"><font color=\"black\">Next 30 </button>&nbsp;\n";
echo "<button OnClick=\"window.location='<?PHP echo \$PHP_SELF ?>'\" style=\"background-color: \"gray\"><font color=\"black\">Return</button>\n";
echo "</td></tr></table>\n";
echo "<?";
echo "}\n";
// ----------------------------------------------------------
echo "ELSEIF (\$_action==\"Edit\")\n";
// ----------------------------------------------------------
echo "{\n";

echo $connection;
echo "\$connection;\n";
echo "\$sql".$tablename."=\"SELECT * ";
echo " FROM $tablename WHERE $primaryfield='\$thisid' LIMIT 0,1\";\n" ;

   echo "\$result=@mysql_query(\$sql".$tablename.", \$connection4) or die (\"Couldn't do the ".$tablename."  query.\");\n";
   echo "\$thisfetch=@mysql_fetch_array(\$result);\n";
 echo "\n";
 
 echo "\$thisrecord=\$thisfetch[\"".$primaryfield."\"];\n";
 echo "session_register(\"thisrecord\");\n";

   $sqlcols="Show columns FROM $tablename";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols2=@mysql_fetch_array($result);
   DO
   {
   echo "\$".$thesecols2["Field"]."=\$thisfetch[\"".$thesecols2["Field"]."\"];\n";

   echo "\$".$thesecols2["Field"]."len=strlen(\$thisfetch[\"".$thesecols2["Field"]."\"]);\n";
echo "\$".$thesecols2["Field"]."color=\"Blue\";\n";
echo "\$".$thesecols2["Field"]."suf=\"1\";\n";

ECHO "session_register(\"".$thesecols2["Field"]."\");\n";
echo "\n";
   }
   WHILE ($thesecols2=@mysql_fetch_array($result));
echo "?>\n";
?>
<FORM action="<?PHP echo "<?PHP echo \$PHP_SELF;?>\" method=\"".$method."\">"; ?>
<TABLE class="tablebody"><TR><TD>
<?PHP 

$sqlcols="Show columns FROM $tablename1";
$result=@mysql_query($sqlcols) or die("couldn't execute table query.");
$thesecols3=@mysql_fetch_array($result);
DO
{
if ($thesecols3["Field"]==$primaryfield)
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"  READONLY></td></tr>\n";
}
ELSE
{
echo "<TR><TD class=\"td1\">".ucfirst($thesecols3["Field"])." :</td><TD class=\"td2\"><input type=\"text\" name=\"".$thesecols3["Field"]."<?PHP echo $".$thesecols3["Field"]."suf;?>\" value=\"<?PHP echo $".$thesecols3["Field"].";?>\"  style=\"color:<?PHP echo $".$thesecols3["Field"]."color;?>\" size=\"<?PHP echo $".$thesecols3["Field"]."len;?> \"></td><TR>\n";
}
}
WHILE ($thesecols3=@mysql_fetch_array($result));


echo "<TR><TD colspan=\"2\" align=\"Center\"><input type=\"submit\" name=\"submit\" value=\"Update\">";
echo "&nbsp;<input type=\"submit\" name=\"submit\" value=\"New\">";
echo "&nbsp;<input type=\"submit\" name=\"\" value=\"Cancel\">";
echo "&nbsp;<input type=\"submit\" name=\"submit\" value=\"List\">";
echo "</td></tr></table></form>";
echo "<?PHP ";
echo "\n}\n";


echo "}\n";
session_unregister("tablename");
session_unregister("primaryfield");
session_unregister("dbname");
session_unregister("dbpassword");
session_unregister("dbhost");
session_unregister("dbusername");
 echo "?>";
}// //  -----------------------------------End of ! $_action ---------- ------------

?>
