<?php 
SESSION_START();
?>
<LINK REL=stylesheet HREF="http://www.louisvillemusicnews.net/test/defaultformcss.css" TYPE="text/css">
<?
function dbconnection($dbhost,$dbusername,$dbpassword,$dbname)
{
global $connection4;
$connection4=@mysql_connect("localhost","louisvil","ADW7FSxg") or die("couldn't connect to host.");
$db=@mysql_select_db("louisvillemusic2",$connection4) or die("Couldn't select database.");
}
$connection=dbconnection("localhost","louisvil","ADW7FSxg","louisvillemusic2");

$keyfield=mediaemailid;
IF(!isset($_POST["action"]))
{
$connection;
$sqlmediaemail="SELECT mediaemail.mediaemailid, mediaemail.businessname, mediaemail.businessid, mediaemail.contactname, mediaemail.title, mediaemail.emailaddress FROM mediaemail WHERE 1 LIMIT 0,1";
$result=@mysql_query($sqlmediaemail) or die ("Couldn't do the mediaemail  query.");
$thisfetch=@mysql_fetch_array($result);

$thisrecord=$thisfetch["mediaemailid"];
session_register("thisrecord");
$mediaemailid=$thisfetch["mediaemailid"];
$mediaemailidlen=strlen($thisfetch["mediaemailid"]);
$mediaemailidcolor="Blue";
$mediaemailidsuf="1";
session_register("mediaemailid");

$businessname=$thisfetch["businessname"];
$businessnamelen=strlen($thisfetch["businessname"]);
$businessnamecolor="Blue";
$businessnamesuf="1";
session_register("businessname");

$businessid=$thisfetch["businessid"];
$businessidlen=strlen($thisfetch["businessid"]);
$businessidcolor="Blue";
$businessidsuf="1";
session_register("businessid");

$contactname=$thisfetch["contactname"];
$contactnamelen=strlen($thisfetch["contactname"]);
$contactnamecolor="Blue";
$contactnamesuf="1";
session_register("contactname");

$title=$thisfetch["title"];
$titlelen=strlen($thisfetch["title"]);
$titlecolor="Blue";
$titlesuf="1";
session_register("title");

$emailaddress=$thisfetch["emailaddress"];
$emailaddresslen=strlen($thisfetch["emailaddress"]);
$emailaddresscolor="Blue";
$emailaddresssuf="1";
session_register("emailaddress");

 
   if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
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
?><FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TR><TD>
<TR><TD class="td1">Mediaemailid :</td><TD class="td2"><input type="text" name="mediaemailid<?PHP echo $mediaemailidsuf;?>" value="<?PHP echo $mediaemailid;?>"  style="color:<?PHP echo $mediaemailidcolor;?>" size="<?PHP echo $mediaemailidlen;?> "  READONLY></td></tr>
<TR><TD class="td1">Businessname :</td><TD class="td2"><input type="text" name="businessname<?PHP echo $businessnamesuf;?>" value="<?PHP echo $businessname;?>"  style="color:<?PHP echo $businessnamecolor;?>" size="<?PHP echo $businessnamelen;?> "></td><TR>
<TR><TD class="td1">Businessid :</td><TD class="td2"><input type="text" name="businessid<?PHP echo $businessidsuf;?>" value="<?PHP echo $businessid;?>"  style="color:<?PHP echo $businessidcolor;?>" size="<?PHP echo $businessidlen;?> "></td><TR>
<TR><TD class="td1">Contactname :</td><TD class="td2"><input type="text" name="contactname<?PHP echo $contactnamesuf;?>" value="<?PHP echo $contactname;?>"  style="color:<?PHP echo $contactnamecolor;?>" size="<?PHP echo $contactnamelen;?> "></td><TR>
<TR><TD class="td1">Title :</td><TD class="td2"><input type="text" name="title<?PHP echo $titlesuf;?>" value="<?PHP echo $title;?>"  style="color:<?PHP echo $titlecolor;?>" size="<?PHP echo $titlelen;?> "></td><TR>
<TR><TD class="td1">Emailaddress :</td><TD class="td2"><input type="text" name="emailaddress<?PHP echo $emailaddresssuf;?>" value="<?PHP echo $emailaddress;?>"  style="color:<?PHP echo $emailaddresscolor;?>" size="<?PHP echo $emailaddresslen;?> "></td><TR>
<TR><TD colspan="2" align="Center"><input type="submit" name="submit" value="Update">&nbsp;<input type="submit" name="submit" value="New">&nbsp;<input type="submit" name="" value="Cancel">&nbsp;<input type="submit" name="submit" value="List"></td></tr></table></form><?PHP 
}
ELSE{//submit exists
IF ($_action=="Update")
{
 
    if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
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
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TH class="thdr" colspan="2"><I>Items In Red Have Been Changed.</i></TH><TR><TD class="td1">Mediaemailid :</td><TD class="td2"><input type="text" name="mediaemailid<?PHP echo $mediaemailidsuf;?>" value="<?PHP echo $mediaemailid;?>"  style="color:<?PHP echo $mediaemailidcolor;?>" size="<?PHP echo $mediaemailidlen;?> " READONLY></td></tr>
<TR><TD class="td1">Businessname :</td><TD class="td2"><input type="text" name="businessname<?PHP echo $businessnamesuf;?>" value="<?PHP echo $businessname;?>"  style="color:<?PHP echo $businessnamecolor;?>" size="<?PHP echo $businessnamelen;?> "></td></tr>
<TR><TD class="td1">Businessid :</td><TD class="td2"><input type="text" name="businessid<?PHP echo $businessidsuf;?>" value="<?PHP echo $businessid;?>"  style="color:<?PHP echo $businessidcolor;?>" size="<?PHP echo $businessidlen;?> "></td></tr>
<TR><TD class="td1">Contactname :</td><TD class="td2"><input type="text" name="contactname<?PHP echo $contactnamesuf;?>" value="<?PHP echo $contactname;?>"  style="color:<?PHP echo $contactnamecolor;?>" size="<?PHP echo $contactnamelen;?> "></td></tr>
<TR><TD class="td1">Title :</td><TD class="td2"><input type="text" name="title<?PHP echo $titlesuf;?>" value="<?PHP echo $title;?>"  style="color:<?PHP echo $titlecolor;?>" size="<?PHP echo $titlelen;?> "></td></tr>
<TR><TD class="td1">Emailaddress :</td><TD class="td2"><input type="text" name="emailaddress<?PHP echo $emailaddresssuf;?>" value="<?PHP echo $emailaddress;?>"  style="color:<?PHP echo $emailaddresscolor;?>" size="<?PHP echo $emailaddresslen;?> "></td></tr>
<TR><TD align="Center" colspan="2">
<input type="submit" name="submit" value="Accept">&nbsp;<input type="submit" name="submit" value="Update">
&nbsp;<input type="reset" name="<?PHP $PHP_SELF;?> " value="Reset">&nbsp;<input type="submit" name="" value="Cancel"></td></tr></table></form><?
}ELSEIF
($_action=="Accept")
{
$sqlmediaemail="SELECT mediaemail.mediaemailid, mediaemail.businessname, mediaemail.businessid, mediaemail.contactname, mediaemail.title, mediaemail.emailaddress FROM mediaemail WHERE 1 LIMIT 0,1";
$result=@mysql_query($sqlmediaemail) or die ("Couldn't do the mediaemail  query.");
$thisfetch=@mysql_fetch_array($result);

$mediaemailid=$thisfetch["mediaemailid"];
$mediaemailidlen=strlen($thisfetch["mediaemailid"]);
$mediaemailidcolor="Blue";
$businessname=$thisfetch["businessname"];
$businessnamelen=strlen($thisfetch["businessname"]);
$businessnamecolor="Blue";
$businessid=$thisfetch["businessid"];
$businessidlen=strlen($thisfetch["businessid"]);
$businessidcolor="Blue";
$contactname=$thisfetch["contactname"];
$contactnamelen=strlen($thisfetch["contactname"]);
$contactnamecolor="Blue";
$title=$thisfetch["title"];
$titlelen=strlen($thisfetch["title"]);
$titlecolor="Blue";
$emailaddress=$thisfetch["emailaddress"];
$emailaddresslen=strlen($thisfetch["emailaddress"]);
$emailaddresscolor="Blue";
 
    if ($_GET)
{
reset ($_GET);
   while (list ($key, $val) = each ($_GET )) 
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
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TH class="thdr" colspan="2"><I>Are You Sure You Want to Change These Items?</i></TH>
<TR><TD>


<TR><TD class="td1">Mediaemailid :</td><TD class="td2"><input type="text" name="mediaemailid<?PHP echo $mediaemailidsuf;?>" value="<?PHP echo $mediaemailid;?>"  style="color:<?PHP echo $mediaemailidcolor;?>" size="<?PHP echo $mediaemailidlen;?> " READONLY ></td></tr>
<TR><TD class="td1">Businessname :</td><TD class="td2"><input type="text" name="businessname<?PHP echo $businessnamesuf;?>" value="<?PHP echo $businessname;?>"  style="color:<?PHP echo $businessnamecolor;?>" size="<?PHP echo $businessnamelen;?> " ></td></tr>
<TR><TD class="td1">Businessid :</td><TD class="td2"><input type="text" name="businessid<?PHP echo $businessidsuf;?>" value="<?PHP echo $businessid;?>"  style="color:<?PHP echo $businessidcolor;?>" size="<?PHP echo $businessidlen;?> " ></td></tr>
<TR><TD class="td1">Contactname :</td><TD class="td2"><input type="text" name="contactname<?PHP echo $contactnamesuf;?>" value="<?PHP echo $contactname;?>"  style="color:<?PHP echo $contactnamecolor;?>" size="<?PHP echo $contactnamelen;?> " ></td></tr>
<TR><TD class="td1">Title :</td><TD class="td2"><input type="text" name="title<?PHP echo $titlesuf;?>" value="<?PHP echo $title;?>"  style="color:<?PHP echo $titlecolor;?>" size="<?PHP echo $titlelen;?> " ></td></tr>
<TR><TD class="td1">Emailaddress :</td><TD class="td2"><input type="text" name="emailaddress<?PHP echo $emailaddresssuf;?>" value="<?PHP echo $emailaddress;?>"  style="color:<?PHP echo $emailaddresscolor;?>" size="<?PHP echo $emailaddresslen;?> " ></td></tr>
<TR><TD colspan="2" align="center">
<input type="submit" name="submit" value="Final Accept">&nbsp;<input type="submit" name="" value="Cancel"></td></tr></table></form><?}
ELSEIF ($_action=="Final Accept")
{
   If ($_GET)
   {
   reset($_GET);
   $getcount=count($_GET); 
   $i=0;
    while (list ($key, $val) = each ($_GET))
      {
      $getkey=substr(strrev($key),0,1);
	  $keylen=strlen($key);
	  $shortstring=substr($key,0,($keylen-1));
	$val=addslashes($val);
         IF ($getkey=="2")
         {
             if($i==($getcount-2))
			 {
			 $updates[$i]=" ".$shortstring."="."'".$val."'";
			 $updatearray=array_merge($updatearray,$updates);
			 			 break;
			 }
			 ELSE
			 {
			 $updates[$i]=" ".$shortstring."="."'".$val."'";
 			 $updatearray=array_merge($updatearray,$updates);
			 $i=++$i;
			 }
          }
          if ($getkey=="1")
         {
         }

		  $i=++$i;
       }
       }
$updatestring=implode(",",$updates);
$update1="Update mediaemail SET ";
$updatetag=" WHERE mediaemailid=$thisrecord";
$wholestring=$update1.$updatestring.$updatetag;
$result=@mysql_query($wholestring) or die("couldn't run update table query.");


$connection;
$sqlmediaemail="SELECT mediaemail.mediaemailid, mediaemail.businessname, mediaemail.businessid, mediaemail.contactname, mediaemail.title, mediaemail.emailaddress FROM mediaemail WHERE  mediaemailid='$thisrecord' LIMIT 0,1";
$result=@mysql_query($sqlmediaemail) or die ("Couldn't do the mediaemail  query.");
$thisfetch=@mysql_fetch_array($result);

$mediaemailid=$thisfetch["mediaemailid"];
$mediaemailidlen=strlen($thisfetch["mediaemailid"]);
$mediaemailidcolor="Blue";
$mediaemailidsuf="1";
session_register("mediaemailid");

$businessname=$thisfetch["businessname"];
$businessnamelen=strlen($thisfetch["businessname"]);
$businessnamecolor="Blue";
$businessnamesuf="1";
session_register("businessname");

$businessid=$thisfetch["businessid"];
$businessidlen=strlen($thisfetch["businessid"]);
$businessidcolor="Blue";
$businessidsuf="1";
session_register("businessid");

$contactname=$thisfetch["contactname"];
$contactnamelen=strlen($thisfetch["contactname"]);
$contactnamecolor="Blue";
$contactnamesuf="1";
session_register("contactname");

$title=$thisfetch["title"];
$titlelen=strlen($thisfetch["title"]);
$titlecolor="Blue";
$titlesuf="1";
session_register("title");

$emailaddress=$thisfetch["emailaddress"];
$emailaddresslen=strlen($thisfetch["emailaddress"]);
$emailaddresscolor="Blue";
$emailaddresssuf="1";
session_register("emailaddress");

?><FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TH class="thdr" colspan="2">The record has been updated.</th>
<TR><TD class="td1">Mediaemailid :</td><TD class="td2"><input type="text" name="mediaemailid<?PHP echo $mediaemailidsuf;?>" value="<?PHP echo $mediaemailid;?>"  style="color:<?PHP echo $mediaemailidcolor;?>" size="<?PHP echo $mediaemailidlen;?> "  READONLY></td></tr>
<TR><TD class="td1">Businessname :</td><TD class="td2"><input type="text" name="businessname<?PHP echo $businessnamesuf;?>" value="<?PHP echo $businessname;?>"  style="color:<?PHP echo $businessnamecolor;?>" size="<?PHP echo $businessnamelen;?> "></td><TR>
<TR><TD class="td1">Businessid :</td><TD class="td2"><input type="text" name="businessid<?PHP echo $businessidsuf;?>" value="<?PHP echo $businessid;?>"  style="color:<?PHP echo $businessidcolor;?>" size="<?PHP echo $businessidlen;?> "></td><TR>
<TR><TD class="td1">Contactname :</td><TD class="td2"><input type="text" name="contactname<?PHP echo $contactnamesuf;?>" value="<?PHP echo $contactname;?>"  style="color:<?PHP echo $contactnamecolor;?>" size="<?PHP echo $contactnamelen;?> "></td><TR>
<TR><TD class="td1">Title :</td><TD class="td2"><input type="text" name="title<?PHP echo $titlesuf;?>" value="<?PHP echo $title;?>"  style="color:<?PHP echo $titlecolor;?>" size="<?PHP echo $titlelen;?> "></td><TR>
<TR><TD class="td1">Emailaddress :</td><TD class="td2"><input type="text" name="emailaddress<?PHP echo $emailaddresssuf;?>" value="<?PHP echo $emailaddress;?>"  style="color:<?PHP echo $emailaddresscolor;?>" size="<?PHP echo $emailaddresslen;?> "></td><TR>
<TR><TD colspan="2" align="Center"><input type="submit" name="submit" value="New">&nbsp;<input type="submit" name="" value="Cancel">&nbsp;<input type="submit" name="submit" value="List"></td></tr></table></form><?
}
ELSEIF ($_action=="New")
{
?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TH class="thdr" colspan="2">Add A New Record to mediaemail</th>

<TR><TD align="tdl">Businessname :</td><TD align="tdr"><input type="text" name="businessname<?PHP echo $businessname;?>" value=""  style="color:<?PHP echo $businessnamecolor;?>" size="27"></td></tr>
<TR><TD align="tdl">Businessid :</td><TD align="tdr"><input type="text" name="businessid<?PHP echo $businessid;?>" value=""  style="color:<?PHP echo $businessidcolor;?>" size="4"></td></tr>
<TR><TD align="tdl">Contactname :</td><TD align="tdr"><input type="text" name="contactname<?PHP echo $contactname;?>" value=""  style="color:<?PHP echo $contactnamecolor;?>" size="13"></td></tr>
<TR><TD align="tdl">Title :</td><TD align="tdr"><input type="text" name="title<?PHP echo $title;?>" value=""  style="color:<?PHP echo $titlecolor;?>" size="15"></td></tr>
<TR><TD align="tdl">Emailaddress :</td><TD align="tdr"><input type="text" name="emailaddress<?PHP echo $emailaddress;?>" value=""  style="color:<?PHP echo $emailaddresscolor;?>" size="27"></td></tr>
<tr><TD align ="center" colspan="2"><input type="submit" name="submit" value="Add">
&nbsp;<input type="reset" name="<?PHP $PHP_SELF;?> " value="Reset">&nbsp;<input type="submit" name="submit" value="List">
</td></tr>
</table></form>
<?
}
ELSEIF ($_action=="Add")
{
$connection;
$sqlcols="Show columns FROM mediaemail";
$result=@mysql_query($sqlcols) or die("couldn't execute first table query.");
$countcols=@mysql_num_rows($result);
$fields=@mysql_fetch_array($result);
$insertstr1="INSERT into mediaemail VALUES (";
for ($i=1; $i<$countcols; $i++) 
{
$values .="'', ";
}
$values .="'' ";
$closer=")";
$insertstr1=$insertstr1.$values.$closer;
$newrec=@mysql_query($insertstr1) or die ("Couldn't do the mediaemail query.");
$lastid=mysql_insert_id();
   If ($_GET)
   {
   reset($_GET);
   $getcount=count($_GET); 
   $i=0;
    while (list ($key, $val) = each ($_GET))
      {
	  $keylen=strlen($key);
         {
             if($i==($getcount-1))
			 {
			 $updates[$i]=" ".$key."="."'".$val."'";
			 $updatearray=array_merge($updatearray,$updates);
			 			 break;
			 }
			 ELSE
			 {
			 $updates[$i]=" ".$key."="."'".$val."'";
 			 $updatearray=array_merge($updatearray,$updates);
			 $i=++$i;
			 }
          }

		  $i=++$i;
       }
       }
$updatestring=implode(",",$updates);
echo $updatestring;
$update1="Update mediaemail SET ";
$updatetag=" WHERE mediaemailid=$lastid LIMIT 0, 1";
$wholestring=$update1.$updatestring.$updatetag;
$result=@mysql_query($wholestring) or die("couldn't run update table query.");

}
ELSEIF ($_action=="List")
{
    if ($listend)
    {
     $liststart=$listend;
     $listend=$liststart+30;
     }
     ELSE     { $liststart=0;
      $listend=30;
     }
  $connection;
$sqlcols="Show columns FROM mediaemail";
$result=@mysql_query($sqlcols) or die("couldn't execute first table query.");
$countcols=@mysql_num_rows($result);
$fields=@mysql_fetch_array($result);
$i=0;
?><table class="tablebody" border="1"><TD class="thdr" colspan="2">Select 'Edit' for individual Record</TH><TR><TD></td><?
       DO
       {
       echo "<TD>";
       print $fields["Field"];
       $field.$i=$fields["Field"];
       $i=++$i;
       echo "</td>";
       }
       WHILE ($fields=@mysql_fetch_array($result));
echo "</tr>";
echo "<tr>";
$sql="SELECT  mediaemailid,  businessname,  businessid,  contactname,  title,  emailaddress FROM mediaemail  LIMIT ";
$sql .=$liststart;
$sql .=", ";
$sql .=$listend;
$result=@mysql_query($sql) or die("couldn't select this list query.");
$thisfetch=@mysql_fetch_array($result);
      DO
      {
       echo "<TR>";
?><TD><a href="<?PHP echo $PHP_SELF;?>?submit=Edit&thisid=<?PHP echo $thisfetch['mediaemailid']; ?>">Edit</a></td>
<?PHP           for ($i=0; $i<$countcols; $i++) 
          {
           echo "<TD>";
       if ($thisfetch[$field.$i]=="")
      {
       echo "&nbsp";
       }
       ELSE
        {
          print  $thisfetch[$field.$i];
         }
          echo "</td>";
           }
 echo "</tr>";
      }
WHILE ($thisfetch=@mysql_fetch_array($result));
echo "</tr>";
echo "<tr>";
?></td></tr>
<tr><Td align="center" colspan="<?PHP echo $i;?>">
<button OnClick="window.location='<?PHP echo $PHP_SELF; ?>?submit=List&listend=<?PHP echo $listend; ?>'" style="background-color: "gray"><font color="black">Next 30 </button>&nbsp;
<button OnClick="window.location='<?PHP echo $PHP_SELF ?>'" style="background-color: "gray"><font color="black">Return</button>
</td></tr></table>
<?}
ELSEIF ($_action=="Edit")
{
$connection;
$sqlmediaemail="SELECT *  FROM mediaemail WHERE mediaemailid='$thisid' LIMIT 0,1";
$result=@mysql_query($sqlmediaemail) or die ("Couldn't do the mediaemail  query.");
$thisfetch=@mysql_fetch_array($result);

$thisrecord=$thisfetch["mediaemailid"];
session_register("thisrecord");
$mediaemailid=$thisfetch["mediaemailid"];
$mediaemailidlen=strlen($thisfetch["mediaemailid"]);
$mediaemailidcolor="Blue";
$mediaemailidsuf="1";
session_register("mediaemailid");

$businessname=$thisfetch["businessname"];
$businessnamelen=strlen($thisfetch["businessname"]);
$businessnamecolor="Blue";
$businessnamesuf="1";
session_register("businessname");

$businessid=$thisfetch["businessid"];
$businessidlen=strlen($thisfetch["businessid"]);
$businessidcolor="Blue";
$businessidsuf="1";
session_register("businessid");

$contactname=$thisfetch["contactname"];
$contactnamelen=strlen($thisfetch["contactname"]);
$contactnamecolor="Blue";
$contactnamesuf="1";
session_register("contactname");

$title=$thisfetch["title"];
$titlelen=strlen($thisfetch["title"]);
$titlecolor="Blue";
$titlesuf="1";
session_register("title");

$emailaddress=$thisfetch["emailaddress"];
$emailaddresslen=strlen($thisfetch["emailaddress"]);
$emailaddresscolor="Blue";
$emailaddresssuf="1";
session_register("emailaddress");

?>
<FORM action="<?PHP echo $PHP_SELF;?>" method="GET"><TABLE class="tablebody"><TR><TD>
<TR><TD class="td1">Mediaemailid :</td><TD class="td2"><input type="text" name="mediaemailid<?PHP echo $mediaemailidsuf;?>" value="<?PHP echo $mediaemailid;?>"  style="color:<?PHP echo $mediaemailidcolor;?>" size="<?PHP echo $mediaemailidlen;?> "  READONLY></td></tr>
<TR><TD class="td1">Businessname :</td><TD class="td2"><input type="text" name="businessname<?PHP echo $businessnamesuf;?>" value="<?PHP echo $businessname;?>"  style="color:<?PHP echo $businessnamecolor;?>" size="<?PHP echo $businessnamelen;?> "></td><TR>
<TR><TD class="td1">Businessid :</td><TD class="td2"><input type="text" name="businessid<?PHP echo $businessidsuf;?>" value="<?PHP echo $businessid;?>"  style="color:<?PHP echo $businessidcolor;?>" size="<?PHP echo $businessidlen;?> "></td><TR>
<TR><TD class="td1">Contactname :</td><TD class="td2"><input type="text" name="contactname<?PHP echo $contactnamesuf;?>" value="<?PHP echo $contactname;?>"  style="color:<?PHP echo $contactnamecolor;?>" size="<?PHP echo $contactnamelen;?> "></td><TR>
<TR><TD class="td1">Title :</td><TD class="td2"><input type="text" name="title<?PHP echo $titlesuf;?>" value="<?PHP echo $title;?>"  style="color:<?PHP echo $titlecolor;?>" size="<?PHP echo $titlelen;?> "></td><TR>
<TR><TD class="td1">Emailaddress :</td><TD class="td2"><input type="text" name="emailaddress<?PHP echo $emailaddresssuf;?>" value="<?PHP echo $emailaddress;?>"  style="color:<?PHP echo $emailaddresscolor;?>" size="<?PHP echo $emailaddresslen;?> "></td><TR>
<TR><TD colspan="2" align="Center"><input type="submit" name="submit" value="Update">&nbsp;<input type="submit" name="submit" value="New">&nbsp;<input type="submit" name="" value="Cancel">&nbsp;<input type="submit" name="submit" value="List"></td></tr></table></form><?PHP 
}
}
?>