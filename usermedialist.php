<?php
session_start();
include("/inks/LMhdrw.inc");
$usermedia="SELECT usermedia.header, mediaemail.emailaddress, mediaemail.businessname, mediaemail.mediaemailid FROM usermedia 
LEFT JOIN mediaemail 
ON usermedia.mediaemailid=mediaemail.mediaemailid WHERE usermedia.userid='$user_id'";
$media=@mysql_query($usermedia,$connection4) OR DIE ("Could not run the media email query.");
$medialist=@mysql_fetch_array($media);
?>
<!--- <FORM action ="<?// echo $PHP_SELF;?>"> -->
<table border="1" width="580" align="center"><TH colspan="3" align="center">Current Media List </th>
<TR><TD align="center"><b>Send</b></td><td align="center"><b>Media Name</b></td><td align="center"><b>Email Address</b></td></tr>

<?
DO
{
printf ("<TR><TD align=\"center\"><input type=\"checkbox\" name=\"thisemail\" value=\"%s\" checked></td><TD>%s</td><td>%s</td></tr>", $medialist["mediaemailid"], $medialist["businessname"],$medialist["emailaddress"] );
}
WHILE ($medialist=@mysql_fetch_array($media));
?>
</table>
<!--</form> -->
