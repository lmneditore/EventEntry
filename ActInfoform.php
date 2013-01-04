<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<?PHP if ($_action=="Enter")
{?>
<table>
<form action="<?PHP "$PHP_SELF"?>" method="POST">
<tr><td align="right">Act Name: </td><td><input type="text" name="actname" value="<?PHP echo $actname; ?>" size="60"></td></tr>
<tr><td align="right">Act Email: </td><td><input type="text" name="actemail" value="<?PHP echo $actemail; ?>" size="75"></td></tr>
<tr><td align="right">Act Webaddress: </td><TD><input type="text" name="acturl" value="<?PHP echo $acturl; ?>" size="75"></td></tr>
<TR><TD align="right">Contact Phone: </td><td><input type="text" name="actphone" value="<?PHP echo $actphone; ?>" size="12"></td></tr>
<TR><TD align="right">Contact First Name: </td><TD><input type="text" name="fname" value="<?PHP echo $fname; ?>" size="25"></td></tr>
<tr><td align="right">Contact Last Name: </td><TD><input type="text" name="lname" value="<?PHP echo $lname; ?>" size="25" maxlength="40"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Accept"></td></tr>


</form>
</table>
<?PHP 
}
ELSEIF ($_action=="Accept")
{
   
    echo "insert the data into the datatable.";
   
}
ELSE
{?>
<table>
<form action="<?PHP "$PHP_SELF"?>" method="POST">

<tr><td align="right">Act Name: </td><td><input type="text" name="actname" value="Enter the complete act name here" size="60"></td></tr>
<tr><td align="right">Act Email: </td><td><input type="text" name="actemail" value="Enter the email to be used for communications from this site." size="75"></td></tr>
<tr><td align="right">Act Webaddress: </td><TD><input type="text" name="acturl" value="Enter the act's web address to be posted on this site." size="75"></td></tr>
<TR><TD align="right">Contact Phone: </td><td><input type="text" name="actphone" value="Enter telephone to reach this act" size="12"></td></tr>
<TR><TD align="right">Contact First Name: </td><TD><input type="text" name="fname" value="First Name" size="25"></td></tr>
<tr><td align="right">Contact Last Name: </td><TD><input type="text" name="lname" value="Last Name" size="25" maxlength="40"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Enter"></td></tr>
</td></tr>

</form>
</table>
<?PHP }?>
</body>
</html>
